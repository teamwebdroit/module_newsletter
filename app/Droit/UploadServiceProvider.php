<?php namespace Droit;

/**
 * Service provider for common tasks
 */

use Illuminate\Support\ServiceProvider;

/**
 *  DroitServiceProvider
 */
class UploadServiceProvider extends ServiceProvider
{

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
    protected function registerUploadService()
    {
    
        $this->app->bind('Droit\Service\Worker\UploadInterface', function () {
        
            return new \Droit\Service\Worker\UploadWorker();
        });
    }
}
