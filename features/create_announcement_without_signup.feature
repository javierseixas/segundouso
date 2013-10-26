Feature: Create an announcement without signing up
    In order to be able to offer my goods
    As a visitor
    I need to create an announcement without needing to sign up

    Background:
        Given I am on the homepage
          And I should not be logged


    Scenario: I create an announcement successfully from the home
        Given I click the new announcement button
         When I am on the new announcement form page
         When I choose a category
         When I fill the form
         When I send the form
         Then I get on a confirmation page


    Scenario: I receive an email to confirm my announcement


    Scenario: I confirm the announcement successfully
        Given I am on the confirmation page
         When I click the confirmation button
         Then I see the confirmation page