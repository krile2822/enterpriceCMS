<?php

namespace CMS\PayPal\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;
use CMS\PayPal\Order;
use CMS\admin\Page;
use CMS\Front\EmailAfterTransactionForOwner;
use CMS\Front\EmailAfterTransactionForUser;
use Mail;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PayPalController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $credentials = Order::getPayPalCredentials();
        // setup PayPal api context
        // $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($credentials['client_id'], $credentials['secret']));
        
        $this->_api_context->setConfig(app()->config->get('paypal.settings'));
    }

    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPayment(Request $request)
    {
        
        $order = new Order;
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $quantity = $request['quantity'];
        $total = $request['quantity'] * 15;
        
        $item_1 = new Item();
        $item_1->setName('Item 1') // item name
            ->setCurrency('USD')
            ->setQuantity($quantity)
            ->setPrice('15'); // unit price
        
        // add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));
                
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }
        foreach($payment->getLinks() as $link) {
            
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // add payment ID to session
        $payment_id = $payment->getId();
        Session::put('paypal_payment_id', $payment_id);
        
        // calculate cost
        $amount = $request['price'] * $request['quantity'];
        $shipping = 10;
        $total = $amount + $shipping;
        
        // save transaction into database
        $order->name = $request['name'];
        $order->last_name = $request['last-name'];
        $order->company = $request['company'];
        $order->address = $request['address'];
        $order->city = $request['city'];
        $order->zip = $request['zip'];
        $order->country = $request['country'];
        $order->email = $request['email-address'];
        $order->phone = $request['phone'];
        $order->quantity = $request['quantity'];
        $order->unit_price = $request['price'];
        $order->amount = $request['amount'];
        $order->shipping = $shipping;
        $order->total = $total;
        $order->payment_id = $payment_id;
        $order->save();
        
        
        if(isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }
        $status = 'failed';
        $page = Page::where('title_en', 'Home')->first();
        return view('front::elementy.elements.thanks', compact(['status', 'page']));
        // return Redirect::route('original.route')
        //    ->with('error', 'Unknown error occurred');
    }

    public function getPaymentStatus()
    {
       
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');
        
        $order = Order::where('payment_id', $payment_id)->first();
        
        // clear the session payment ID
        Session::forget('paypal_payment_id');
        
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            $status = 'failed';
        $page = Page::where('title_en', 'Home')->first();
        return view('front::elementy.elements.thanks', compact(['status', 'page']));
            //return Redirect::route('original.route')
            //    ->with('error', 'Payment failed');
        }
        
        $payment = Payment::get($payment_id, $this->_api_context);
        // PaymentExecution object includes information necessary 
        // to execute a PayPal account payment. 
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        
        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
        
        if ($order) {
            if ($result->getState() == 'approved') { // payment made
                $order->approved = 1;
                $order->result = $result;
                $order->save();
                $status = 'success';
                $page = Page::where('title_en', 'Home')->first();
                $user = $order->email;
                //Mail::to($user)->send(new EmailAfterTransactionForUser($order));
                //Mail::to('megamin@web.dev.icbtech.rs')->send(new EmailAfterTransactionForOwner($order));
                // return view('front::elementy.elements.thanks', compact(['status', 'page']));
                Session::flash('message', 'Success');
                return view('PayPal::paypal-redirect-page');
            }
        }
        
        $status = 'failed';
        $page = Page::where('title_en', 'Home')->first();
        // return view('front::elementy.elements.thanks', compact(['status', 'page']));
        Session::flash('message', 'Error');
        return view('PayPal::paypal-redirect-page');
    }
}

