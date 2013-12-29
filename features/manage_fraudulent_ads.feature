Feature: Manage the ads marked as fraudulent
    In order to delete the ads marked as fraudulent
    As a administrator
    I need to be visualize the ads marked as fraudulent and delete them


    Background:
        Given I am logged in as administrator
          And there are the following municipalities:
            | name              |
            | Barcelona         |
          And there are the following categories:
            | name              |
            | Muebles           |
            | Electrodomésticos |
            | Menaje            |
          And there are the following ads:
            | title             | category    | municipality | marks |
            | Mesa de billar    | Muebles     | barcelona    | 3     |
            | Mecedora          | Muebles     | barcelona    | 0     |


    Scenario: Viewing the ads with marks
        Given I am on the marked ads page
         Then I should see ad "Mesa de billar" marked 3 times
          And I should not see text matching "Mecedora"


    Scenario: Deleting marked ad
        Given I am on the marked ads page
         When I click "Eliminar" near "Mesa de billar"
         Then I should not see text matching "Mesa de billar"