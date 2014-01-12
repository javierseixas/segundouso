Feature: Browse ads without signing up
    In order to be able to find goods
    As a visitor
    I need to list them

    Background:
        Given I am on the homepage
          And there are the following municipalities:
            | name              |
            | Barcelona         |
            | Valencia          |
            | Palma             |
          And there are the following categories:
            | name              |
            | Muebles           |
            | Electrodomésticos |
            | Menaje            |
          And there are the following ads:
            | title             | category    | municipality |
            | Mesa de billar    | Muebles     | barcelona    |
            | Mecedora          | Muebles     | barcelona    |
            | Estanteria        | Muebles     | palma        |
           # TODO Fix the problem why it doesn't find any security token
#          And I should not be logged in


    Scenario: I want browse the ads for a category that has ads
         When I select the category "Muebles"
         Then I should see "Mecedora"
          And I should see there 2 ads

    Scenario: I browse a category which doesn't have ads
         When I select the category "Menaje"
         Then I should see "No hay anuncios publicados"

    Scenario: I browse ads for another city which do have them
        Given I am browsing "Palma"
         When I select the category "Muebles"
         Then I should see "Estanteria"

    Scenario: I browse a city without ads
        Given I am browsing "Valencia"
         When I select the category "Muebles"
         Then I should see "No hay anuncios publicados"

    # TODO this scenario
    Scenario: I browse a category and I only see ads non deleted