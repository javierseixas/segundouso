Feature: Manage the ads I created being registered user
    In order update or delete my ads
    As a user
    I need to be able to edit the data of the ad or delete it

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



    Scenario: I have ads and I see them
        Given I am logged in as "user" with password "abcd"
            # TODO change this accessing from ui using javascript
          And I am on my ads page
         Then I should see "Mesa de billar"
          And I should see there 2 ads

    Scenario: I don't have ads so I don't see any
        Given I am logged in as "user2" with password "efgh"
            # TODO change this accessing from ui using javascript
          And I am on my ads page
         Then I should not see "Mesa de billar"
          And I should see there 0 ads

    Scenario: I edit and ad successfully
        Given I am logged in as "user" with password "abcd"
            # TODO change this accessing from ui using javascript
          And I am on my ads page
          And I click "Editar" near "Mesa de billar"
         When I change the title to "Futbolín"
         Then I should see "Tu anuncio se ha editado correctamente"
          And the title field should contains "Futbolín"

    Scenario: I access the delete confirmation page and delete an ad successfully
        Given I am logged in as "user" with password "abcd"
            # TODO change this accessing from ui using javascript
          And I am on my ads page
          And I click "Eliminar" near "Mesa de billar"
         When I confirm to delete the ad
         Then I should see "Tu anuncio se ha eliminado correctamente"
