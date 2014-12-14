<?php

\Validator::extend('emailconfirmed', function($attribute, $value, $parameters)
{
    $email = \DB::table('newsletter_users')->where('email','=',$value)->first();

    if($email)
    {
        return ( !starts_with($email->activated_at, '0000') ? true : false);
    }
    else
    {
        return true;
    }
});
