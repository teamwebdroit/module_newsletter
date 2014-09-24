<?php namespace Droit;
/**
 * Service provider for common tasks
 */

use Illuminate\Support\ServiceProvider;
use Droit\Arret\Entities\Arret as Arret;

/**
 *  DroitServiceProvider
 */
class DroitServiceProvider extends ServiceProvider {

	/**
	 * Register binding interface to implementation 
	 */
    public function register()
    {         	
		$this->registerArretService();
    }

	/**
	 * Arret
	 */     
    protected function registerArretService(){
    
	    $this->app->bind('Droit\Arret\Repo\ArretInterface', function()
        {
            return new \Droit\Arret\Repo\ArretEloquent( new Arret );
        });        
    }

}