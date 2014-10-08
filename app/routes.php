<?php

/**
 * Pages
 */
Route::get('convert', 'NewsletterController@convert');
Route::get('html', 'NewsletterController@html');
Route::get('test', 'NewsletterController@test');
Route::get('convert', 'NewsletterController@convert');
Route::get('date', 'ArretController@index');
Route::get('campagne', 'NewsletterController@campagne');
Route::resource('/', 'NewsletterController');

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
Route::get('arrets', 'NewsletterApiController@all');
Route::get('arrets/{id}', 'NewsletterApiController@simple');