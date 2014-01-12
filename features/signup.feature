Feature: Signup becoming a registered user
    As a visitor
    I need to signup
    In order to create my own account

    Background:
        Given I am on the homepage

#    Scenario: I signup successfully
#        Given I follow "Registrarse"
#         When I fill the signup form as "javier"
#          And I press "Registrarse"
#         Then I should see "tu cuenta está ahora confirmada"
#          And I should see "Felicidades javier"

    Scenario: I cannot signup because I put two different passwords
        Given I follow "Registrarse"
         When I fill the form with:
            | username | javier          |
            | email    | javier@hola.com |
            | password | 1234            |
            | confirm  | 5678            |
          And I press "Registrarse"
         Then I should see "Las dos contraseñas no coinciden"


