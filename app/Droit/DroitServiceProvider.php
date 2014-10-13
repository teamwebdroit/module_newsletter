<?php namespace Droit;
/**
 * Service provider for common tasks
 */

use Illuminate\Support\ServiceProvider;
use Droit\Content\Entities\Arret as Arret;
use Droit\Content\Entities\Analyse as Analyse;
use Droit\Categorie\Entities\Categories as Categorie;


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
        $this->registerAnalyseService();
        $this->registerCategorieService();
    }

	/**
	 * Arret
	 */     
    protected function registerArretService(){
    
	    $this->app->bind('Droit\Content\Repo\ArretInterface', function()
        {
            return new \Droit\Content\Repo\ArretEloquent( new Arret );
        });        
    }

    /**
     * Analyse
     */
    protected function registerAnalyseService(){

        $this->app->bind('Droit\Content\Repo\AnalyseInterface', function()
        {
            return new \Droit\Content\Repo\AnalyseEloquent( new Analyse );
        });
    }

    /**
     * Categorie
     */
    protected function registerCategorieService(){

        $this->app->bind('Droit\Categorie\Repo\CategorieInterface', function()
        {
            return new \Droit\Categorie\Repo\CategorieEloquent( new Categorie );
        });
    }
}