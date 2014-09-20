<?php


Route::get('/views/{name}', function($name) {
    $view_path = 'templates.' . $name;

    if (View::exists($view_path)) {
        return View::make($view_path);
    }

    App::abort(404);
});


Route::get('building-blocs', 'NewsletterController@buildingBlocs');
Route::get('image-left-text', 'NewsletterController@imageLeftText');
Route::get('image-right-text', 'NewsletterController@imageRightText');
Route::get('image-text', 'NewsletterController@imageText');
Route::get('image', 'NewsletterController@image');

Route::get('convert', 'NewsletterController@convert');
Route::get('build', 'NewsletterController@build');
Route::post('build', 'NewsletterController@build');
Route::post('upload', 'NewsletterController@upload');
Route::get('upload', 'NewsletterController@upload');
Route::get('html', 'NewsletterController@html');
Route::resource('/', 'NewsletterController');


