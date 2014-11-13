<?php

\Validator::extend('unconfirmed', function($attribute, $value, $parameters)
{
    $email = DB::table('newsletter_users')->where($attribute,'=',$value)->first();

    if(!$email)
    {
        return true;
    }

    if($email && $email->activated_at)
    {
       return false;
    }
    else
    {
       return false;
    }

});