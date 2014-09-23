<?php namespace Droit;

/**
 * Service provider for newsletter
 */

use Illuminate\Support\ServiceProvider;

use Droit\Newsletter\Entities\Newsletter_contents as Newsletter_contents;
use Droit\Newsletter\Entities\Newsletter_types as Newsletter_types;

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

}