Feature: Manage the ads I created without sign up
    In order update or delete my ads
    As a visitor-advertiser
    I need to be able to edit the data of the ad or delete it

    Background:
        Given there are the following categories:
            | name              |
            | Muebles           |
          And there are the following municipalities:
            | name              |
            | Barcelona         |
          And there are the following ads:
            | title             | category    | pid  | token | municipality |
            | Mesa de billar    | Muebles     | 1234 | abcd  | barcelona    |
# TODO Fix the problem why it doesn't find any security token
#          And I should not be logged in


    Scenario: I access the edit form and edit an ad successfully
        Given I am on the ad edit page with:
            | pid  | token |
            | 1234 | abcd  |
         When I change the title to "Futbolín"
         Then I should see "Tu anuncio se ha editado correctamente"
          And the title field should contains "Futbolín"

    Scenario: I can't access to edit an advert if I don't have the correct token
        Given I am on the ad edit page with:
            | pid  | token |
            | 1234 | efgh  |
         Then I should see "No es posible acceder"

    Scenario: I access the delete confirmation page and delete an ad successfully
        Given I am on the ad delete page with:
            | pid  | token |
            | 1234 | abcd  |
         When I confirm to delete the ad
         Then I should see "Tu anuncio se ha eliminado correctamente"
