<?php

    /**
     * Site pages
     */
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
    Route::get('contact', 'HomeController@contact');
    Route::get('colloque', 'HomeController@colloque');
    Route::get('auteur', 'HomeController@auteur');
    Route::post('sendMessage', 'HomeController@sendMessage');
    Route::get('jurisprudence', 'HomeController@jurisprudence');
    Route::get('newsletters/{id?}', 'HomeController@newsletters');

/**
 * Newsletter
 */
Route::get('campagne/{id}', 'CampagneController@view');
Route::get('unsubscribe', 'CampagneController@unsubscribe');

Route::get('inscription/activation/{token}', 'InscriptionController@activation');
Route::post('inscription/resend', 'InscriptionController@resend');
Route::post('inscription/unsubscribe', 'InscriptionController@unsubscribe');
Route::resource('inscription', 'InscriptionController');

Route::group(array('before' => array('auth')), function()
{
    /**
     * Upload routes
     */

    Route::post('uploadJS', 'UploadController@uploadJS');
    Route::post('uploadRedactor', 'UploadController@uploadRedactor');

    Route::get('imageJson/{id?}', ['uses' => 'UploadController@imageJson']);
    Route::get('fileJson/{id?}', ['uses' => 'UploadController@fileJson']);

    Route::post('uploadJquery', 'UploadController@uploadJquery');
    Route::post('sorting', 'CampagneController@sorting');
    Route::post('sortingGroup', 'CampagneController@sortingGroup');

});

Route::group(array('before' => array('admin','csrf')), function()
{
    /**
     * API
     */
    Route::post('process', 'CampagneController@addContent');
    Route::post('editContent', 'CampagneController@editContent');
    Route::post('remove', 'CampagneController@remove');

});

/*
 * AJAX
 */
Route::get('abonne/getAllAbos', 'AbonneController@getAllAbos');


Route::get('arrets/{id}', 'ArretController@simple');
Route::get('analyses/{id}', 'AnalyseController@simple');
Route::get('arrets', 'ArretController@arrets');
Route::get('categories', 'CategorieController@categories');

/**
 * Login routes
 */
Route::get('logout', 'LoginController@destroy');
Route::resource('login', 'LoginController');
Route::controller('password', 'RemindersController');

/**
 * Admin routes
 */
Route::group(array('prefix' => 'admin', 'before' => array('auth','admin')), function()
{
    Route::get('exemple', function()
    {
        $file = public_path(). '/files/exemple_import.xlsx';
        return \Response::download($file, 'exemple_import.xlsx');
    });

    Route::get('dashboard', 'AdminController@index');

    Route::resource('arret', 'ArretController');
    Route::resource('analyse', 'AnalyseController');
    Route::resource('categorie', 'CategorieController');
    Route::resource('contenu', 'ContentController');
    Route::resource('author', 'AuthorController');
    Route::get('file/scan', 'FileController@scan');
    Route::post('file/imageIsUsed', 'FileController@imageIsUsed');
    Route::post('file/addFolder', 'FileController@addFolder');
    Route::delete('file', 'FileController@destroy');
    Route::resource('file', 'FileController');

    Route::get('campagne/compose', 'CampagneController@compose');
    Route::get('campagne/view/{id}', 'CampagneController@view');
    Route::get('campagne/simple/{id}', 'CampagneController@simple');
    Route::resource('campagne', 'CampagneController');

    Route::resource('abonne', 'AbonneController');
    Route::resource('import', 'ImportController');

    Route::post('send/campagne', 'SendController@campagne');
    Route::post('send/test', 'SendController@test');
    Route::get('send/{id}', 'SendController@show');

    Route::resource('stats', 'StatsController');

    Route::match(array('GET', 'POST'), 'categorie/arretsExists', array('uses' => 'CategorieController@arretsExists'));
    Route::match(array('GET', 'POST'), 'search', array('uses' => 'SearchController@index'));
});


Route::get('testing', function()
{


    //echo ($send->removeContact('cindy11@bluewin.ch') ? 'removed' : 'error');
    //print_r($send->getSubscribers());

    //print_r($send->getListRecipient('cindy.leschaud@gmail.com'));
    /*   $faker = \Faker\Factory::create();

     foreach(range(1, 2) as $index)
     {
         $categories = array();

         $count = $faker->numberBetween(1, 4);

         for($i = 0; $i <= $count; $i++){
             $categories[] = $faker->numberBetween(62, 92);
         }

         $cour = $faker->randomElement(array('A','C','E'));
         $num  = $faker->randomDigit();
         $rand = $faker->randomNumber(3);
         $year = $faker->randomElement(array('2012','2013','2014'));

         $text = '<p>'.$faker->text(1200).'</p>';
         $text .= '<p>'.$faker->text(1200).'</p>';

         $ref  = $cour.''.$num.'_'.$rand.'/'.$year;

         $arret = [
             'pid'        => 195,
             'user_id'    => 1,
             'reference'  => $ref,
             'pub_date'   => $faker->dateTimeBetween('-3 years', 'now'),
             'abstract'   => $faker->text(200),
             'pub_text'   => $text,
             'categories' => count($categories),
             'file'       => 'Fichier_test.pdf',
             'created_at' => date('Y-m-d G:i:s'),
             'updated_at' => date('Y-m-d G:i:s')
         ];

         echo '<pre>';
         print_r($arret);
         echo '</pre>';

       $arret = \Droit\Content\Entities\Arret::create([
             'pid'        => 195,
             'user_id'    => 1,
             'reference'  => $ref,
             'pub_date'   => $faker->dateTimeBetween('-3 years', 'now'),
             'abstract'   => $faker->sentences(2),
             'pub_text'   => $faker->paragraph(3),
             'categories' => count($categories),
             'file'       => 'Fichier_test.pdf',
             'created_at' => date('Y-m-d G:i:s'),
             'updated_at' => date('Y-m-d G:i:s')
         ]);

        //$arret->arrets_categories()->sync($categories);

    }*/

    $arrets = new Droit\Content\Entities\Arret();

    $arrets = $arrets->with( array('arrets_analyses' => function($query)
            {
                $query->where('analyses.deleted', '=', 0);
            }))->orderBy('id', 'ASC')->take(10)->get();

    echo '<pre>';

    $new = $arrets->filter(function($item)
    {
        if (!$item->arrets_analyses->isEmpty()) {
            return true;
        }
    });

    print_r($new->take(5)->toArray());

    echo '</pre>';

});

Route::get('statscampagne', function()
{


    $csv    = public_path('files/test.csv');

    // echo file_get_contents($csv);exit;

    //$mailjet = \App::make('Droit\Newsletter\Worker\MailjetInterface');
   // $mailjet->setList(1545504); // testing list

    echo '<pre>';
    $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', 'file.xlsx');
    print_r($filename);
    echo '</pre>';

/*    $dataID = $mailjet->uploadCSVContactslistData(file_get_contents($csv));
    $result = $mailjet->importCSVContactslistData($dataID->ID);*/

    //$newsletter = new \Droit\Newsletter\Repo\NewsletterCampagneEloquent(new \Droit\Newsletter\Entities\Newsletter_campagnes);


    //$campagne   = $newsletter->find(12);

    //$sent = $send->sendCampagne($campagne->api_campagne_id);
    //$html = $send->html($campagne->id);
    //$sent = $send->setHtml($html,$campagne->api_campagne_id);
    //$id = $send->removeContact('pruntrut@yahoo.fr');
    //$sent = $send->addContactToList($id);
    //$sent = $mailjet->clickStatistics(120);
    //print_r($campagne);

});