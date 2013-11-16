<?php

namespace SegundoUso\BehatBundle\Context;

use Behat\Behat\Context\Step\Given;
use Behat\Behat\Context\Step\Then;
use Behat\Behat\Context\Step\When;
use Behat\Behat\Exception\PendingException;
use Behat\CommonContexts\SymfonyMailerContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

class WebContext extends MinkContext implements KernelAwareInterface
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->useContext('data', new DataContext());
        $this->useContext('email', new SymfonyMailerContext());
    }

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Then /^I should not be logged in$/
     */
    public function iShouldNotBeLoggedIn()
    {
        if ($this->getSecurityContext()->isGranted('ROLE_USER')) {
            throw new AuthenticationException('User was not expected to be logged in, but he is.');
        }
    }

    /**
     * @When /^I click the new ad button$/
     */
    public function iClickTheNewAdButton()
    {
        return new When('I follow "FLAG_new-ad"');
    }

    /**
     * @Then /^I am on the new ad form page$/
     */
    public function iAmOnTheNewAdFormPage()
    {
        return new Then('I should be on "/anuncio/crear"');
    }

    /**
     * @When /^I fill and send the form$/
     */
    public function iFillAndSendTheForm()
    {
        return array(
            new When('I fill in "ad_title" with "Taula"'),
            new When('I fill in "ad_location" with "Barcelona"'),
            new When('I fill in "ad_description" with "Es muy bonita"'),
            new When('I select "Muebles" from "ad_category"'),
            new When('I fill in "ad_advertiser" with "dev@segundouso.org"'),
            new When('I press "FLAG_send-new-ad-form"'),
        );
    }

    /**
     * @Then /^I get on a confirmation page$/
     */
    public function iGetOnAConfirmationPage()
    {
        return new Then('I should see an "#FLAG_waiting-confirmation" element');
    }

    /**
     * @Given /^I am on the confirmation page$/
     */
    public function iAmOnTheConfirmationPage()
    {
        throw new PendingException();
    }

    /**
     * @When /^I click the confirmation button$/
     */
    public function iClickTheConfirmationButton()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I see the confirmation page$/
     */
    public function iSeeTheConfirmationPage()
    {
        throw new PendingException();
    }

    /**
     * @Given /^I select the category "([^"]*)"$/
     */
    public function iSelectTheCategory($category)
    {
        return array(
            new When('I select "'.$category.'" from "categoryId"'),
            new When('I press "FLAG_search-ads"'),
        );
    }

    /**
     * @Then /^I am on the list page$/
     */
    public function iAmOnTheListPage()
    {
        return new Then('I should see an "#FLAG_ads-list" element');
    }

    /**
     * For example: I should see 10 ads.
     *
     * @Then /^I should see there (\d+) ads/
     */
    public function iShouldSeeThatMuchAds($amount)
    {
        $this->assertSession()->elementsCount('css', '.ad', $amount);
    }

    /**
     * @Given /^I am on the ad details page for ad "([^"]*)"$/
     */
    public function iAmOnTheAdDetailsPageForAd($pid)
    {
        return new Given('I am on "/anuncios/' . $pid . '"');
    }

    /**
     * @Given /^I fill the contact form with my data$/
     */
    public function iFillTheContactFormWithMyData()
    {
        return array(
            new When('I fill in "contact_advertiser_form_name" with "Javier"'),
            new When('I fill in "contact_advertiser_form_email" with "dev@segundouso.org"'),
            new When('I fill in "contact_advertiser_form_message" with "Estoy interesado"'),
            new When('I press "FLAG_send-ad-contact-form"'),
        );
    }






    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    private function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    private function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     * Get security context.
     *
     * @return SecurityContextInterface
     */
    private function getSecurityContext()
    {
        return $this->getContainer()->get('security.context');
    }

    /**
     * Get data context.
     *
     * @return DataContext
     */
    private function getDataContext()
    {
        return $this->getSubContext('data');
    }

    /**
     * Get current user instance.
     *
     * @return null|UserInterface
     */
    private function getUser()
    {
        $token = $this->getSecurityContext()->getToken();

        if (null === $token) {
            throw new \Exception('No token found in security context.');
        }

        return $token->getUser();
    }
}