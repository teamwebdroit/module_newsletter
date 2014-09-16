<?php

Route::get('convert', 'NewsletterController@convert');
Route::get('build', 'NewsletterController@build');
Route::post('build', 'NewsletterController@build');
Route::get('test', 'NewsletterController@test');
Route::get('html', 'NewsletterController@html');
Route::resource('/', 'NewsletterController');

Route::resource('upload', 'UploadController');

