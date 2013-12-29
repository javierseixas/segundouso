Feature: Search ads by text
    In order to be able to find goods
    As a visitor
    I need search them by text

    Background:
        Given I am on the homepage
        And there are the following municipalities:
            | name              |
            | Barcelona         |
        And there are the following categories:
            | name              |
            | Muebles           |
            | Electrodomésticos |
            | Menaje            |
        And there are the following ads:
            | title             | category    | municipality |
            | Mesa de billar    | Muebles     | barcelona    |
            | Mecedora          | Muebles     | barcelona    |


    Scenario: I search for items and I find
        When I search for "billar"
        Then I should see "Mesa de billar"
        And I should see there 1 ads


    Scenario: I search for items and I find
        When I search for "hervidor"
        Then I should see "No hay anuncios publicados"