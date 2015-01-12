<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

require_once( dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/vendor/autoload.php' );
require_once( dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/vendor/phpunit/phpunit/src/Framework/Assert/Functions.php' );


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext
{

    /**
     * The Guzzle HTTP Response.
     */
    protected $session;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $driver        = new \Behat\Mink\Driver\GoutteDriver();
        $this->session = new \Behat\Mink\Session($driver);
        $this->session->start();
    }

    /**
     * @static
     * @beforeSuite
     */
    public static function bootstrapLaravel()
    {
        $unitTesting     = true;
        $testEnvironment = 'local';

        $app = require_once __DIR__ . '/../../../../bootstrap/start.php';
        $app->boot();
    }

    /**
     * @AfterFeature
     */
    public static function prepare($scope)
    {
        $arret = new \Droit\Content\Entities\Arret;
        $arret = $arret->where('reference','=','TEST_A234')->get();
        if(!$arret->isEmpty())
        {
            $arret = $arret->first();
            $arret->delete();
        }

        $analyse = new \Droit\Content\Entities\Analyse;
        $analyse = $analyse->where('authors','=','TEST_ANALYSE_A234')->get();
        if(!$analyse->isEmpty())
        {
            $analyse = $analyse->first();
            $analyse->delete();
        }

        $content = new \Droit\Content\Entities\Content;
        $content = $content->where('titre','=','TEST_Contenu')->get();
        if(!$content->isEmpty())
        {
            $content = $content->first();
            $content->delete();
        }
    }

    /**
     * @When /^I am on the "([^"]*)" page$/
     */
    public function iAmOnThePage($arg1)
    {
        $this->visit($arg1);
    }

    /**
     * @Then /^I see "([^"]*)"$/
     */
    public function iSee($arg1)
    {
        $this->assertPageNotContainsText($arg1);
    }

    /**
     * @When /^I click the "([^"]*)" button$/
     */
    public function iClickTheButton($arg1)
    {
        $this->clickLink("Ajouter");
    }

    /**
     * @Given /^I fill out the form to create a new arret$/
     */
    public function iFillOutTheFormToCreateANewArret()
    {
        $this->fillField('reference', 'TEST_A234');
        $this->fillField('pub_date', '2015-01-05');
        $this->attachFileToField('file', 'Fichier_test.pdf');
        $this->fillField('abstract', 'Un arrets de test');
        $this->fillField('pub_text', 'un peu de texte pour le petit test');
        $this->fillField('categories[]', 75);
        $this->pressButton("Envoyer");
    }

    /**
     * @Then /^I should see the new created arret "([^"]*)"$/
     */
    public function iShouldSeeTheNewCreatedArret2($arg1)
    {
        $this->assertPageContainsText($arg1);
    }


    /**
     * @Given /^I fill out the form to create a new analyse$/
     */
    public function iFillOutTheFormToCreateANewAnalyse()
    {
        $this->fillField('authors', 'TEST_ANALYSE_A234');
        $this->fillField('pub_date', '2015-01-05');
        $this->attachFileToField('file', 'Fichier_test.pdf');
        $this->fillField('abstract', 'Un arrets de test');
        $this->fillField('categories[]', 75);
        $this->fillField('arrets[]', 818);

        $this->pressButton("Envoyer");
    }

    /**
     * @Given /^I fill out the form to create a new contenu$/
     */
    public function iFillOutTheFormToCreateANewContenu()
    {
        $this->fillField('titre', 'TEST_Contenu');
        $this->fillField('contenu', 'Lorem ipsum');
        $this->attachFileToField('file', 'image.jpg');
        $this->fillField('url', 'http://www.designpond.ch');
        $this->fillField('type', 'pub');
        $this->fillField('position', 'sidebar');

        $this->pressButton("Envoyer");
    }

    /**
     * @Given /^I fill out the form to create a new categorie$/
     */
    public function iFillOutTheFormToCreateANewCategorie()
    {
        $this->fillField('title', 'TEST_categorie');
        $this->attachFileToField('file', 'image.jpg');

        $this->pressButton("Envoyer");
    }


    /**
     * @Then /^I should see "([^"]*)" a new analyse$/
     */
    public function iShouldSeeANewAnalyse($arg1)
    {
        $this->assertPageContainsText($arg1);
    }


}
