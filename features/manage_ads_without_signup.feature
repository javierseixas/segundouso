Feature: Manage the ads I created without sign up
    In order update or delete my ads
    As a visitor-advertiser
    I need to be able to edit the data of the ad or delete it

    Background:
        Given there are the following categories:
            | name              |
            | Muebles           |
          And there are the following ads:
            | title             | category    | pid  |
            | Mesa de billar    | Muebles     | 1234 |
# TODO Fix the problem why it doesn't find any security token
#          And I should not be logged in


    Scenario: I access the edit form and edit and ad successfully
        Given I am on the ad edit page "1234"
         When I change the title to "Futbolín"
         Then I should see "Tu anuncio se ha editado correctamente"
          And the title field should contains "Futbolín"

