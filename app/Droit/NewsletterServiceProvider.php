<?php namespace Droit;

/**
 * Service provider for newsletter
 */

use Illuminate\Support\ServiceProvider;

use Droit\Newsletter\Entities\Newsletter_contents as Newsletter_contents;
use Droit\Newsletter\Entities\Newsletter_types as Newsletter_types;
use Droit\Newsletter\Entities\Newsletter_campagnes as Newsletter_campagnes;

/**
 *  NewsletterServiceProvider
 */
class NewsletterServiceProvider extends ServiceProvider {

	/**
	 * Register binding interface to implementation 
	 */
    public function register()
    {         	
		$this->registerContentService();

        $this->registerTypesService();

        $this->registerCampagneService();

        $this->registerCampagneWorkerService();
    }

	/**
	 * Newsletter Content service
	 */     
    protected function registerContentService(){
    
	    $this->app->bind('Droit\Newsletter\Repo\NewsletterContentInterface', function()
        {
            return new \Droit\Newsletter\Repo\NewsletterContentEloquent( new Newsletter_contents );
        });        
    }

    /**
     * Newsletter Types service
     */
    protected function registerTypesService(){

        $this->app->bind('Droit\Newsletter\Repo\NewsletterTypesInterface', function()
        {
            return new \Droit\Newsletter\Repo\NewsletterTypesEloquent( new Newsletter_types );
        });
    }


    /**
     * Newsletter Types service
     */
    protected function registerCampagneService(){

        $this->app->bind('Droit\Newsletter\Repo\NewsletterCampagneInterface', function()
        {
            return new \Droit\Newsletter\Repo\NewsletterCampagneEloquent( new Newsletter_campagnes );
        });
    }

    /**
     * Newsletter Campagne worker
     */
    protected function registerCampagneWorkerService(){

        $this->app->bind('Droit\Newsletter\Worker\CampagneInterface', function()
        {
            return new \Droit\Newsletter\Worker\CampagneWorker(
                \App::make('Droit\Newsletter\Repo\NewsletterContentInterface'),
                \App::make('Droit\Content\Repo\ArretInterface')
            );
        });
    }

}