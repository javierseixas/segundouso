Feature: Create an ad being user
    In order to be able to offer things
    As a user
    I need to create an ads

    Background:
        Given I am on the homepage
          And there are the following municipalities:
            | name              |
            | Barcelona         |
            | Sant Boi          |
          And there are the following categories:
            | name              |
            | Muebles           |
            | Electrodomésticos |
            | Menaje            |
          And I am logged in as user


    Scenario: I create an ad successfully from the home
         When I click the new ad button
         Then I am on the new ad form page
        Given The form should not ask me for an email
         When I fill the form
          And I send the form
#        There is not possible run this test with sahi
#         Then email with subject "Confirmación de anuncio en SegundoUso.org" should have been sent
          And I get on a confirmation page

#    Scenario: I confirm the ad successfully
#        Given I am on the confirmation page
#         When I click the confirmation button
#         Then I see the confirmation page