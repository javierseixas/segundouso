Feature: Manage favorite ads
    In order save the ads I like more
    As a user
    I need to be able to mark and unmark ads and visualize them

    Background:
        Given there are following users:
            | username          | email       | password |
            | user              | u@email.com | abcd     |
            | user2             | a@email.com | efgh     |
        And there are the following categories:
            | name              |
            | Muebles           |
        And there are the following municipalities:
            | name              |
            | Barcelona         |
        And there are the following ads:
            | title             | category    | pid  | token | municipality | username |
            | Mesa de billar    | Muebles     | 1234 | abcd  | barcelona    | user     |
            | Estanteria        | Muebles     | 5678 | hijk  | barcelona    | user     |

    Scenario: I mark an ad as favorite
        Given I am logged in as "user2" with password "efgh"
          And I am on the ad details page for ad "1234"
         When I press "Marcar anuncio como favorito"
            # TODO change this accessing from ui using javascript
          And I am on my favorite ads page
         Then I should see "Mesa de billar"

    Scenario: I mark an ad as favorite and then I unmark it
        Given I am logged in as "user2" with password "efgh"
          And I am on the ad details page for ad "1234"
         When I press "Marcar anuncio como favorito"
            # TODO change this accessing from ui using javascript
          And I am on my favorite ads page
         Then I should see "Mesa de billar"
         When I click "Favorito" near "Mesa de billar"
        Given I reload the page
         Then I should not see "Mesa de billar"

