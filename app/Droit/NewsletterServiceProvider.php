<?php namespace Droit;

/**
 * Service provider for newsletter
 */

use Illuminate\Support\ServiceProvider;

use Droit\Newsletter\Entities\Newsletter as Newsletter;
use Droit\Newsletter\Entities\Newsletter_contents as Newsletter_contents;
use Droit\Newsletter\Entities\Newsletter_types as Newsletter_types;
use Droit\Newsletter\Entities\Newsletter_campagnes as Newsletter_campagnes;
use Droit\Newsletter\Entities\Newsletter_users as Newsletter_users;
use Droit\Newsletter\Entities\Newsletter_subscriptions as Newsletter_subscriptions;

/**
 *  NewsletterServiceProvider
 */
class NewsletterServiceProvider extends ServiceProvider {

	/**
	 * Register binding interface to implementation 
	 */
    public function register()
    {
        $this->registerNewsletterService();
		$this->registerContentService();
        $this->registerTypesService();
        $this->registerCampagneService();
        $this->registerCampagneWorkerService();
        $this->registerMailjetWorkerService();
        $this->registerInscriptionService();
        $this->registerSubscribeService();
    }

    /**
     * Newsletter Content service
     */
    protected function registerNewsletterService(){

        $this->app->bind('Droit\Newsletter\Repo\NewsletterInterface', function()
        {
            return new \Droit\Newsletter\Repo\NewsletterEloquent( new Newsletter );
        });
    }

	/**
	 * Newsletter service
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
                \App::make('Droit\Newsletter\Repo\NewsletterCampagneInterface'),
                \App::make('Droit\Content\Repo\ArretInterface'),
                \App::make('Droit\Categorie\Repo\CategorieInterface'),
                \App::make('Droit\Content\Repo\GroupeInterface')
            );
        });
    }

    /**
     * Newsletter Mailjet API worker
     */
    protected function registerMailjetWorkerService(){

        $this->app->bind('Droit\Newsletter\Worker\MailjetInterface', function()
        {
            return new \Droit\Newsletter\Worker\MailjetWorker();
        });
    }

    /**
     * Newsletter user abo service
     */
    protected function registerInscriptionService(){

        $this->app->bind('Droit\Newsletter\Repo\NewsletterUserInterface', function()
        {
            return new \Droit\Newsletter\Repo\NewsletterUserEloquent( new Newsletter_users );
        });
    }

    /**
     * Newsletter user abo service
     */
    protected function registerSubscribeService(){

        $this->app->bind('Droit\Newsletter\Repo\NewsletterSubscriptionInterface', function()
        {
            return new \Droit\Newsletter\Repo\NewsletterSubscriptionEloquent( new Newsletter_subscriptions );
        });
    }

}