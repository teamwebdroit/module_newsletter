<?php

Route::get('contact', 'HomeController@contact');
Route::get('recueil', 'HomeController@recueil');

/**
 * Pages
 */
Route::get('convert', 'NewsletterController@convert');
Route::get('html', 'NewsletterController@html');
Route::get('test', 'NewsletterController@test');
Route::get('convert', 'NewsletterController@convert');
Route::get('campagne', 'NewsletterController@campagne');
Route::resource('/', 'NewsletterController');

Route::get('post', 'ArretController@index');
Route::get('listed', 'ArretController@listed');

/**
 * Templates for js
 */
Route::get('building-blocs', 'TemplateController@buildingBlocs');
Route::get('image-left-text', 'TemplateController@imageLeftText');
Route::get('image-right-text', 'TemplateController@imageRightText');
Route::get('image-text', 'TemplateController@imageText');
Route::get('image', 'TemplateController@image');
Route::get('text', 'TemplateController@text');
Route::get('arret', 'TemplateController@arret');
Route::get('post-text', 'TemplateController@postText');

/**
 * Upload routes
 */
Route::post('uploadJS', 'UploadController@uploadJS');

/**
 * API
 */
Route::get('building', 'NewsletterApiController@building');
Route::post('sorting', 'NewsletterApiController@sorting');
Route::post('process', 'NewsletterApiController@process');
Route::get('arrets', 'ArretController@arrets');
Route::get('preparedArrets/{selected?}', 'ArretController@preparedArrets');
Route::get('categories', 'ArretController@categories');
Route::get('arrets/{id}', 'NewsletterApiController@simple');