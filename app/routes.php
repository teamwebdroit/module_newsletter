<?php

/**
 * Site pages
 */
Route::get('recueil', 'HomeController@recueil');
Route::get('contact', 'HomeController@contact');
Route::get('jurisprudence', 'HomeController@jurisprudence');

/**
 * Newsletter
 */
Route::get('convert', 'NewsletterController@convert');
Route::get('html', 'NewsletterController@html');
Route::get('test', 'NewsletterController@test');
Route::get('convert', 'NewsletterController@convert');
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
Route::get('preparedArrets/{selected?}', 'NewsletterApiController@preparedArrets');
Route::get('preparedAnnees', 'NewsletterApiController@preparedAnnees');
Route::get('arrets/{id}', 'NewsletterApiController@simple');
Route::get('arrets', 'ArretController@arrets');
Route::get('categories', 'CategorieController@categories');

/**
 * Admin routes
 */
Route::group(array('prefix' => 'admin'), function()
{
    Route::get('dashboard', 'AdminController@index');
    Route::resource('arret', 'ArretController');
    Route::resource('categorie', 'CategorieController');

    Route::get('search', array('uses'  => 'SearchController@index'));
    Route::post('search', array('uses' => 'SearchController@index'));
});


/**
 * LOG
 */
Event::listen('illuminate.query', function($query, $bindings, $time, $name)
{
    $data = compact('bindings', 'time', 'name');

    // Format binding data for sql insertion
    foreach ($bindings as $i => $binding)
    {
        if ($binding instanceof \DateTime)
        {
            $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
        }
        else if (is_string($binding))
        {
            $bindings[$i] = "'$binding'";
        }
    }

    // Insert bindings into query
    $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
    $query = vsprintf($query, $bindings);

    Log::info($query, $data);
});