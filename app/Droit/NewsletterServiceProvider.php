<?php namespace Droit;

/**
 * Service provider for newsletter
 */

use Illuminate\Support\ServiceProvider;

use Droit\Newsletter\Entities\Newsletter_contents as Newsletter_contents;

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
    }

	/**
	 * Content service
	 */     
    protected function registerContentService(){
    
	    $this->app->bind('Droit\Newsletter\Repo\NewsletterContentInterface', function()
        {
            return new \Droit\Newsletter\Repo\NewsletterContentEloquent( new Newsletter_contents );
        });        
    }

}