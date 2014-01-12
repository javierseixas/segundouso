Feature: Marks ad as fraudulent
    As a visitor or registered user
    I need to be able to mark ads as fraudulent
    In order to help administrators to manage the site

    Background:
        Given there are the following categories:
            | name              |
            | Muebles           |
          And there are the following municipalities:
            | name              |
            | Barcelona         |
          And there are the following ads:
            | title             | category    | pid  | municipality |
            | Mesa de billar    | Muebles     | 1234 | barcelona    |
            # TODO Fix: this statement gives problems on sahi because of the use of cookies
          And I am on the ad details page for ad "1234"
            # TODO Fix the problem why it doesn't find any security token


    Scenario: I mark an ad as fraudlent sucessfully
         When I click "Avisar" button
         Then the button has changed its text to "Avisado"