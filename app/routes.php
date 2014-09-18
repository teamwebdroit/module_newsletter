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

Route::get('convert', 'NewsletterController@convert');
Route::get('build', 'NewsletterController@build');
Route::post('build', 'NewsletterController@build');
Route::get('test', 'NewsletterController@test');
Route::get('html', 'NewsletterController@html');
Route::resource('/', 'NewsletterController');

Route::resource('upload', 'UploadController');

