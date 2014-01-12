<?php

namespace SegundoUso\BehatBundle\Context;

use Behat\Behat\Context\Step\Given;
use Behat\Behat\Context\Step\Then;
use Behat\Behat\Context\Step\When;
use Behat\Behat\Exception\PendingException;
use Behat\CommonContexts\SymfonyMailerContext;
use Behat\CommonContexts\WebApiContext;
use Behat\Gherkin\Node\TableNode;
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
    public function __construct(array $parameters)
    {
        $this->useContext('data', new DataContext());
        $this->useContext('email', new SymfonyMailerContext());
        $this->useContext('api', new WebApiContext($parameters['base_url'], null));
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
     * @Given /^I am logged in as administrator$/
     */
    public function iAmLoggedInAsAdministrator()
    {
        $this->iAmLoggedInAsRole('ROLE_ADMIN', 'admin_login');
    }

    /**
     * @Given /^I am logged in as user$/
     */
    public function iAmLoggedInAsUser()
    {
        $this->iAmLoggedInAsRole('ROLE_USER', 'fos_user_security_login');
    }

    /**
     * @Given /^I am logged in as "([^"]*)" with password "([^"]*)"$/
     */
    public function iAmLoggedInAs($username, $password)
    {
        $this->getSession()->visit($this->generateUrl('fos_user_security_login'), array(), true);

        $this->fillField('_username', $username);
        $this->fillField('_password', $password);
        $this->pressButton('_submit');
    }


    /**
     * Create user and login with given role.
     *
     * @param string $role
     */
    private function iAmLoggedInAsRole($role, $route)
    {
        $this->getSubContext('data')->thereIsUser('pepe', 'pepe@pepe.com', 'pepe', $role);
        $this->getSession()->visit($this->generateUrl($route), array(), true);

        $this->fillField('_username', 'pepe');
        $this->fillField('_password', 'pepe');
        $this->pressButton('_submit');
    }

    /**
     * @Given /^I am on my ads page$/
     */
    public function iAmOnMyAdsPage()
    {
        return new Then('I am on "/cuenta/mis-anuncios"');
    }

    /**
     * @Given /^I am on my favorite ads page$/
     */
    public function iAmOnMyFavoriteAdsPage()
    {
        return new Then('I am on "/cuenta/mis-favoritos"');
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
            new When('I select "Barcelona" from "ad_municipality"'),
            new When('I fill in "ad_location" with "Barcelona"'),
            new When('I fill in "ad_description" with "Es muy bonita"'),
            new When('I select "Muebles" from "ad_category"'),
            new When('I fill in "ad_advertiser" with "dev@segundouso.org"'),
            new When('I press "FLAG_send-new-ad-form"'),
        );
    }

    /**
     * @When /^The form should not ask me for an email$/
     */
    public function theFormShouldNotAskMeForEmail()
    {
        return new Given('I should not see a "#ad_advertiser" element');
    }

    /**
     * @When /^I fill the form$/
     */
    public function iFillTheForm()
    {
        return array(
            new When('I fill in "ad_title" with "Taula"'),
            new When('I select "Barcelona" from "ad_municipality"'),
            new When('I fill in "ad_location" with "Barcelona"'),
            new When('I fill in "ad_description" with "Es muy bonita"'),
            new When('I select "Muebles" from "ad_category"'),
        );
    }

    /**
     * @When /^I send the form$/
     */
    public function iSendTheForm()
    {
        return new When('I press "FLAG_send-new-ad-form"');
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
     * @Given /^I am on the ad edit page "([^"]*)"$/
     */
    public function iAmOnTheEditPage($pid)
    {
        return new Given('I am on "/anuncios/editar/' . $pid . '"');
    }

    /**
     * @Given /^I am on the ad edit page with:$/
     */
    public function iAmOnTheAdEditPageWith(TableNode $table)
    {
        foreach ($table->getHash() as $data) {
            return new Given('I am on "/anuncios/editar/' . $data['pid'] . '/' . $data['token'] . '"');
        }
    }


    /**
     * @When /^I change the title to "([^"]*)"$/
     */
    public function iChangeTheTitleTo($title)
    {
        return array(
            new When('I fill in "ad_title" with "'.$title.'"'),
            new When('I press "FLAG_send-edit-ad"'),
        );
    }

    /**
     * @Given /^the title field should contains "([^"]*)"$/
     */
    public function iTitleFieldShouldContain($value)
    {
        new Then('the "ad_title" field should contain "'.$value.'"');
    }

    /**
     * @Given /^I am on the ad delete page with:$/
     */
    public function iAmOnTheAdDeletePageWith(TableNode $table)
    {
        foreach ($table->getHash() as $data) {
            return new Given('I am on "/anuncios/eliminar/' . $data['pid'] . '/' . $data['token'] . '"');
        }
    }

    /**
     * @When /^I confirm to delete the ad$/
     */
    public function iConfirmToDeleteTheAd()
    {
        return new When('I press "FLAG_delete-ad"');
    }

    /**
     * @When /^I search for "([^"]*)"$/
     */
    public function iSearchFor($term)
    {
        return array(
            new When('I fill in "FLAG_search-input" with "'.$term.'"'),
            new When('I press "FLAG_search-button"'),
        );
    }

    /**
     * @Given /^I am on the marked ads page$/
     */
    public function iAmOnTheMarkedAdsPage()
    {
        $this->getSession()->visit($this->generateUrl('segundo_uso_fraudulent_ads'), array(), true);
    }

    /**
     * @Then /^I should see ad "([^"]*)" marked (\d+) times$/
     */
    public function iShouldSeeAdMarkedTimes($adTitle, $count)
    {
        return array(
            new Then('I should see text matching "'.$adTitle.'"'),
            new Then('the ".FLAG_count-cell" element should contain "'.$count.'"'),
        );
    }

    /**
     * @When /^I delete ad "([^"]*)"$/
     */
    public function iDeleteAd($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I click "([^"]*)" near "([^"]*)"$/
     * @When /^I press "([^"]*)" near "([^"]*)"$/
     */
    public function iClickNear($button, $value)
    {
        $tr = $this->getSession()->getPage()->find('css',
            sprintf('table tbody tr:contains("%s")', $value)
        );

        if (null === $tr) {
            throw new ExpectationException(sprintf('Table row with value "%s" does not exist', $value), $this->getSession());
        }

        $locator = sprintf('button:contains("%s")', $button);

        if ($tr->has('css', $locator)) {
            $tr->find('css', $locator)->press();
        } else {
            $tr->clickLink($button);
        }
    }

    /**
     * @When /^I click "([^"]*)" button$/
     */
    public function iClickButton($text)
    {
        $this->pressButton($text);
    }

    /**
     * @Then /^the button has changed its text to "([^"]*)"$/
     */
    public function theButtonHasChangedItsTextTo($text)
    {
        $this->assertPageContainsText($text);
    }

    /**
     * @Given /^I am browsing "([^"]*)"$/
     */
    public function iAmBrowsing($municipality)
    {
        $this->selectOption('municipality', $municipality);
    }

    /**
     * @When /^I fill the signup form as "([^"]*)"$/
     */
    public function iFillTheSignupForm($username)
    {
        $this->fillField('fos_user_registration_form_username', $username);
        $this->fillField('fos_user_registration_form_email', 'javier.seixas@gmail.com');
        $this->fillField('fos_user_registration_form_plainPassword_first', '1234');
        $this->fillField('fos_user_registration_form_plainPassword_second', '1234');
    }

    /**
     * @When /^I fill the form with:$/
     */
    public function iFillTheFormWith(TableNode $table)
    {
        $loginData = $table->getRowsHash();

        print_r($loginData);

        $this->fillField('fos_user_registration_form_username', $loginData['username']);
        $this->fillField('fos_user_registration_form_email', $loginData['email']);
        $this->fillField('fos_user_registration_form_plainPassword_first', $loginData['password']);
        $this->fillField('fos_user_registration_form_plainPassword_second', $loginData['confirm']);
    }



    /**
     * Generate url.
     *
     * @param string  $route
     * @param array   $parameters
     * @param Boolean $absolute
     *
     * @return string
     */
    private function generateUrl($route, array $parameters = array(), $absolute = false)
    {
        $path = $this->getService('router')->generate($route, $parameters, $absolute);

        return sprintf('%s%s', $this->getMinkParameter('base_url'), $path);
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