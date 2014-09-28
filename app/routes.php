<?php


Route::get('/views/{name}', function($name) {
    $view_path = 'templates.' . $name;

    if (View::exists($view_path)) {
        return View::make($view_path);
    }

    App::abort(404);
});

/**
 * Templates for js
 */
Route::get('building-blocs', 'NewsletterController@buildingBlocs');
Route::get('image-left-text', 'NewsletterController@imageLeftText');
Route::get('image-right-text', 'NewsletterController@imageRightText');
Route::get('image-text', 'NewsletterController@imageText');
Route::get('image', 'NewsletterController@image');
Route::get('text', 'NewsletterController@text');
Route::get('arret', 'NewsletterController@arret');
Route::post('process', 'NewsletterController@process');

/**
 * Uplaod routes
 */
Route::post('upload', 'NewsletterController@upload');
Route::get('upload', 'NewsletterController@upload');

/**
 * Pages
 */
Route::get('convert', 'NewsletterController@convert');
Route::get('build', 'NewsletterController@build');
Route::post('build', 'NewsletterController@build');
Route::get('html', 'NewsletterController@html');
Route::get('date', 'ArretController@index');
Route::get('arret/{id}', 'ArretController@show');
Route::get('campagne', 'NewsletterController@campagne');
Route::resource('/', 'NewsletterController');

/**
 * API
 */
Route::get('building', 'NewsletterController@building');
Route::post('sorting', 'NewsletterController@sorting');
Route::get('arrets', 'ArretController@all');
Route::get('arrets/{id}', 'ArretController@simple');