<?php

\Validator::extend('unconfirmed', function($attribute, $value, $parameters)
{
    $email = DB::table('newsletter_users')->where($attribute,'=',$value)->first();

    if(!$email)
    {
        return true;
    }
    else if($email && $email->activated_at == '0000-00-00')
    {
         return false;
    }
    else
    {
       return false;
    }

});