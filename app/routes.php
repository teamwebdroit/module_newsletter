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

Route::get('test', 'NewsletterController@test');// test
Route::get('convert', 'HomeController@convert');// test
Route::get('campagne', 'NewsletterController@campagne');// test
Route::get('gobuild', 'NewsletterController@index');// test

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
Route::post('uploadRedactor', 'UploadController@uploadRedactor');

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

    Route::get('html/{id}', 'NewsletterController@html');
    Route::post('send/campagne', 'SendController@campagne');
    Route::post('send/test', 'SendController@test');
    Route::get('send/{id}', 'SendController@show');
    //Route::get('send/statistiques/{id}', 'SendController@statistiques');

    //Route::get('stats/chartDoughnut/{id}', 'StatsController@chartDoughnut');

    Route::resource('stats', 'StatsController');

    Route::match(array('GET', 'POST'), 'categorie/arretsExists', array('uses' => 'CategorieController@arretsExists'));
    Route::match(array('GET', 'POST'), 'search', array('uses' => 'SearchController@index'));
});

Route::get('testing', function()
{

    $send = new \Droit\Newsletter\Worker\CampagneWorker(
        \App::make('Droit\Newsletter\Repo\NewsletterContentInterface'),
        \App::make('Droit\Newsletter\Repo\NewsletterCampagneInterface'),
        \App::make('Droit\Content\Repo\ArretInterface')
    );

    //echo ($send->removeContact('cindy11@bluewin.ch') ? 'removed' : 'error');
    print_r($send->getSubscribers());

});

Route::get('setHmtlCampagne', function()
{

    $send = new \Droit\Newsletter\Worker\CampagneWorker(
        \App::make('Droit\Newsletter\Repo\NewsletterContentInterface'),
        \App::make('Droit\Newsletter\Repo\NewsletterCampagneInterface'),
        \App::make('Droit\Content\Repo\ArretInterface')
    );

    $newsletter = new \Droit\Newsletter\Repo\NewsletterCampagneEloquent(new \Droit\Newsletter\Entities\Newsletter_campagnes);

    $campagne   = $newsletter->find(4);

    //$sent = $send->sendCampagne($campagne->api_campagne_id);
    $html = $send->html($campagne->id);
    $sent = $send->setHtml($html,$campagne->api_campagne_id);
    //$id = $send->removeContact('pruntrut@yahoo.fr');
    //$sent = $send->addContactToList($id);
    //$sent = $send->createCampagne($campagne);
    //print_r($campagne);
    print_r($sent);

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