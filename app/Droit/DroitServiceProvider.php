<?php 
/**
 * Service provider for common tasks
 */
 
namespace Droit;

use Illuminate\Support\ServiceProvider;

/**
 *  DroitServiceProvider
 */
class DroitServiceProvider extends ServiceProvider {

	/**
	 * Register binding interface to implementation 
	 */
    public function register()
    {         	
		$this->registerUploadService();	
    }

	/**
	 * Upload service
	 */     
    protected function registerUploadService(){
    
	    $this->app->bind('Droit\Service\Worker\UploadInterface', function()
        {
            return new \Droit\Service\Worker\UploadWorker();
        });        
    }

}