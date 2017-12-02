<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{ trans('translate.verify_your_account') }}</h2>
        <?php
                $locale = App::getLocale();
            ?>
        <div>
            {{ trans('translate.thanks_for_creating_account') }}
            {{ trans('translate.please_follow_the') }}
            <a href="{{ URL::to($locale.'/register/verify/' . $confirmation_code) }}"> link </a> {{ trans('translate.to_verify_your_account') }}
            <br/>
        </div>
    </body>
</html>
