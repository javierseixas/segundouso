Feature: Create an ad without signing up
    In order to be able to offer my goods
    As a visitor
    I need to create an ad without needing to sign up

    Background:
        Given I am on the homepage
          And there are the following categories:
            | name              |
            | Muebles           |
            | Electrodomésticos |
            | Menaje            |
           # TODO Fix the problem why it doesn't find any security token
#          And I should not be logged in


    Scenario: I create an ad successfully from the home
         When I click the new ad button
         Then I am on the new ad form page
         When I fill and send the form
#        There is not possible run this test with sahi
#         Then email with subject "Confirmación de anuncio en SegundoUso.org" should have been sent
          And I get on a confirmation page

    Scenario: I confirm the ad successfully
        Given I am on the confirmation page
         When I click the confirmation button
         Then I see the confirmation page