<?php

/**
 * Site pages
 */
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::get('contact', 'HomeController@contact');
Route::post('sendMessage', 'HomeController@sendMessage');
Route::get('jurisprudence', 'HomeController@jurisprudence');
Route::get('newsletters/{id?}', 'HomeController@newsletters');

/**
 * Newsletter
 */
Route::get('html', 'NewsletterController@html');
Route::get('test', 'NewsletterController@test');
Route::get('convert', 'HomeController@convert');
Route::get('campagne', 'NewsletterController@campagne');
Route::get('gobuild', 'NewsletterController@index');

/**
 * Templates for js
 */
Route::get('building-blocs', 'TemplateController@buildingBlocs');
Route::get('post-text', 'TemplateController@postText');

    /**
     * Templates for js creation
     */
    Route::get('image-left-text', 'TemplateController@imageLeftText');
    Route::get('image-right-text', 'TemplateController@imageRightText');
    Route::get('image-text', 'TemplateController@imageText');
    Route::get('image', 'TemplateController@image');
    Route::get('text', 'TemplateController@text');
    Route::get('arret', 'TemplateController@arret');

    /**
     * Templates for js edit
     */
    Route::get('image-left-text-edit', 'TemplateController@imageLeftTextEdit');
    Route::get('image-right-text-edit', 'TemplateController@imageRightTextEdit');
    Route::get('image-text-edit', 'TemplateController@imageTextEdit');
    Route::get('image-edit', 'TemplateController@imageEdit');
    Route::get('text-edit', 'TemplateController@textEdit');
    Route::get('arret-edit', 'TemplateController@arretEdit');

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
Route::post('edit', 'NewsletterApiController@edit');
Route::post('remove', 'NewsletterApiController@remove');

Route::get('preparedArrets/{selected?}', 'NewsletterApiController@preparedArrets');
Route::get('preparedAnnees', 'NewsletterApiController@preparedAnnees');
Route::get('prepareCampagne/{id}', 'NewsletterApiController@prepareCampagne');

Route::get('arrets/{id}', 'NewsletterApiController@simple');
Route::get('arrets', 'ArretController@arrets');
Route::get('categories', 'CategorieController@categories');


/**
 * Newsletter inscription routes
 */
Route::get('inscription/activation/{token}', 'InscriptionController@activation');
Route::post('inscription/resend', 'InscriptionController@resend');
Route::resource('inscription', 'InscriptionController');

/**
 * Admin routes
 */
Route::group(array('prefix' => 'admin'), function()
{
    Route::get('dashboard', 'AdminController@index');
    Route::resource('arret', 'ArretController');

    Route::resource('categorie', 'CategorieController');

    Route::get('campagne/compose', 'CampagneController@compose');
    Route::get('campagne/view/{id}', 'CampagneController@view');
    Route::resource('campagne', 'CampagneController');

    Route::resource('abonne', 'AbonneController');

    Route::match(array('GET', 'POST'), 'categorie/arretsExists', array('uses' => 'CategorieController@arretsExists'));
    Route::match(array('GET', 'POST'), 'search', array('uses' => 'SearchController@index'));
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