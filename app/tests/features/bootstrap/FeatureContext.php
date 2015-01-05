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
     * The Guzzle HTTP Client.
     */
    protected $client;

    /**
     * The current resource
     */
    protected $resource;

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
        $this->fillField('file', 'Fichier_test.pdf');
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
        $this->assertPageNotContainsText($arg1);
    }


    /**
     * @Given /^I fill out the form to create a new analyse$/
     */
    public function iFillOutTheFormToCreateANewAnalyse()
    {
        $this->fillField('authors', 'TEST_ANALYSE_A234');
        $this->fillField('pub_date', '2015-01-05');
        $this->fillField('file', 'Fichier_test.pdf');
        $this->fillField('abstract', 'Un arrets de test');
        $this->fillField('categories[]', 75);
        $this->fillField('arrets[]', 835);

        $this->pressButton("Envoyer");
    }

    /**
     * @Then /^I should see "([^"]*)" a new analyse$/
     */
    public function iShouldSeeANewAnalyse($arg1)
    {
        $this->assertPageNotContainsText($arg1);
    }


}
