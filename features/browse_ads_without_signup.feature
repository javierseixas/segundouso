Feature: Browse ads without signing up
    In order to be able to find goods
    As a visitor
    I need to list them

    Background:
        Given I am on the homepage
          And there are the following categories:
            | name              |
            | Muebles           |
            | Electrodomésticos |
            | Menaje            |
          And there are the following ads:
            | title             | category    |
            | Mesa de billar    | Muebles     |
            | Mecedora          | Muebles     |
           # TODO Fix the problem why it doesn't find any security token
#          And I should not be logged in


    Scenario: I want browse the ads for a category that has ads
         When I select the category "Muebles"
         Then I should see "Mecedora"
          And I should see there 2 ads

    Scenario: I browse a category which doesn't have ads
         When I select the category "Menaje"
         Then I should see "No hay anuncios publicados"