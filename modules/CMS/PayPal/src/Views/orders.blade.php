@extends ('admin::admin.layouts.master')

@section('css')
<!-- <link rel="stylesheet" type="text/css" href="/css/ga-embed.css"> -->
@endsection

@section ('content')
<?php $orders = CMS\PayPal\Order::getOrdersWithPaginator();?>
<section class="content-header">
      <h1>
        List of orders
        <small>(transactions)</small>
      </h1>
</section>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
                    <div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12">
            <table id="example2" class="table table-bordered table dataTable" role="grid" style='text-align: center;'>
                <thead>
                <tr role="row">
                    <th  style="text-align: center;" rowspan="1" colspan="1">Buyer</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Company</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Address</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">E-mail</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Phone</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Price</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Quantity</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Shippig</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Total</th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Approved by <i class="fa fa-paypal"></i></th>
                    <th  style="text-align: center;" rowspan="1" colspan="1">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                <tr role="row" class="odd" id="{{ $order->id }}">
                  <td>{{ $order->name . ' ' . $order->last_name }}</td>
                  <td>{{ $order->company }}</td>
                  <td>{{ $order->address . ',' . $order->city . ' ' .$order->zip}}</td>
                  <td>{{ $order->email }}</td>
                  <td>{{ $order->phone }}</td>
                  <td>${{ $order->unit_price }}</td>
                  <td>{{ $order->quantity }}</td>
                  <td>${{ $order->shipping }}</td>
                  <td>${{ $order->total }}</td>
                  @if ( $order->approved == 1)
                  <td>
                      <a id="get_result" href='#result'><span class="label label-success" style="font-size:80%;" data-toggle="modal" data-target="#result_modal">Approved</span></a>
                  </td>
                  @else 
                  <td><span class="label label-danger" style="font-size:80%;">Denied</span></td>
                  @endif
                    <td>
                        <select id="{{$order->id}}" class="status">
                            @if ($order->status == 'New')
                            <option selected="selected">New</option>
                            <option>Rejected</option>
                            <option>Done</option>
                            @elseif ($order->status == 'Rejected')
                            <option>New</option>
                            <option selected="selected">Rejected</option>
                            <option>Done</option>
                            @else
                            <option>New</option>
                            <option>Rejected</option>
                            <option selected="selected">Done</option>
                            @endif
                        </select>
                    </td>
                </tr>
                @endforeach
                
                </tbody>
<!--                <tfoot>
                <tr><th rowspan="1" colspan="1">Rendering engine</th>
                    <th rowspan="1" colspan="1">Browser</th>
                    <th rowspan="1" colspan="1">Platform(s)</th>
                    <th rowspan="1" colspan="1">Engine version</th>
                    <th rowspan="1" colspan="1">CSS grade</th></tr>
                </tfoot>-->
              </table>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="dataTables_paginate paging_simple_numbers" style="text-align:right">
                              {{ $orders->links() }}
                          </div>
                        
                      </div>
                  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>


<div id="result_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:70%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Order details</h4>
      </div>
      <div class="modal-body">
        <pre id="json_result"></pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Okay</button>
      </div>
    </div>

  </div>
</div>

<script>
    $(function() {
        var token = '{{ Session::token() }}';
        $('[data-toggle="tooltip"]').tooltip();   
        
        $( ".status" ).change(function() {
            var status = $(this).find(":selected").text();
            var id = $(this).attr('id');

            $.ajax({
                method: 'POST',
                url: '{{ route('status.change') }}',
                data: {id: id, status: status, _token: token}
            }).done(function(msg) {
                if (msg['message'] != 'success') {
                    alert('Something went wrong, please try again later');
                }
            });
        });
        
        $('#result_modal').on('show.bs.modal', function(event) {
            var id = $(event.relatedTarget).closest('tr').attr('id');
            $('#json_result').load( "{{ route('get.order.result') }}", {id:id, _token:token });
            
//            $.ajax({
//                method: 'POST',
//                url: '{{ route('get.order.result') }}',
//                data: {id: id, _token: token}
//            }).done(function(msg) {
//                $('#json_result').text(msg['result']);
//            });
        });
    });
</script>
@endsection
