Feature: Contact advertiser regarding an intersting ad
    In order contact advertiser
    As a visitor
    I need to be able to contact him

    Background:
        Given there are the following categories:
            | name              |
            | Muebles           |
          And there are the following ads:
            | title             | category    | pid  |
            | Mesa de billar    | Muebles     | 1234 |
          And I am on the ad details page for ad "1234"
# TODO Fix the problem why it doesn't find any security token
#          And I should not be logged in


    Scenario: I contact and advertiser through the contact form successfully
        Given I fill the contact form with my data
         Then I should see "Se ha enviado"
