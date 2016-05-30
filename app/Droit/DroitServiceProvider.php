<?php namespace Droit;

/**
 * Service provider for common tasks
 */

use Illuminate\Support\ServiceProvider;
use Droit\Content\Entities\Arret as Arret;
use Droit\Content\Entities\Analyse as Analyse;
use Droit\Categorie\Entities\Categories as Categorie;
use Droit\Content\Entities\Content as Content;
use Droit\Content\Entities\Groupe as Groupe;
use Droit\Author\Entities\Author as Author;

/**
 *  DroitServiceProvider
 */
class DroitServiceProvider extends ServiceProvider
{

    /**
     * Register binding interface to implementation
     */
    public function register()
    {
        $this->registerArretService();
        $this->registerAnalyseService();
        $this->registerCategorieService();
        $this->registerContentService();
        $this->registerGroupeService();
        $this->registerSearchService();
        $this->registerAuthorService();
    }

    /**
     * Arret
     */
    protected function registerArretService()
    {
    
        $this->app->bind('Droit\Content\Repo\ArretInterface', function () {
        
            return new \Droit\Content\Repo\ArretEloquent(new Arret);
        });
    }

    /**
     * Analyse
     */
    protected function registerAnalyseService()
    {

        $this->app->bind('Droit\Content\Repo\AnalyseInterface', function () {
        
            return new \Droit\Content\Repo\AnalyseEloquent(new Analyse);
        });
    }

    /**
     * Author
     */
    protected function registerAuthorService()
    {

        $this->app->bind('Droit\Author\Repo\AuthorInterface', function () {
        
            return new \Droit\Author\Repo\AuthorEloquent(new Author);
        });
    }

    /**
     * Categorie
     */
    protected function registerCategorieService()
    {

        $this->app->bind('Droit\Categorie\Repo\CategorieInterface', function () {
        
            return new \Droit\Categorie\Repo\CategorieEloquent(new Categorie);
        });
    }

    /**
     * Content
     */
    protected function registerContentService()
    {

        $this->app->bind('Droit\Content\Repo\ContentInterface', function () {
        
            return new \Droit\Content\Repo\ContentEloquent(new Content);
        });
    }

    /**
     * Groupe
     */
    protected function registerGroupeService()
    {

        $this->app->bind('Droit\Content\Repo\GroupeInterface', function () {
        
            return new \Droit\Content\Repo\GroupeEloquent(new Groupe);
        });
    }

    /**
     * Search service
     */
    protected function registerSearchService()
    {

        $this->app->bind('Droit\Service\Worker\SearchInterface', function () {
        
            return new \Droit\Service\Worker\SearchEloquent(
                new Arret,
                new Categorie
            );
        });
    }
}
