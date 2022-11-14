#behat
#language: en
Feature: As an anonymous user
  In order to send the Website feedback
  user should be able to send message via '/en/contact' page

  Background:
    Given I am on the homepage

  Scenario Outline: For both the languages (English and Spanish), test the Contact form (/contact)
    When I follow "<lang>"
  #  And I wait 2 seconds
    And I follow "<Contact Form>"
    And I wait 2 seconds
    Then the title is "Website feedback | Drupal"
    When I enter following details
    | Your name | Your email address | Subject | Message | Su nombre |Su dirección de correo electrónico | Asunto | Mensaje |
    | AmitJain | amit.jain@axelerant.com | EnglishSub | EnglishMessage | Spanish | amit.jain@axelerant.com | SpanishSubj | SpanishMessage |
    And I wait 2 seconds
    Examples:
      | lang     |  Contact Form |
      | English  |  Contact |
      | Spanish  |  Contacto |
    
    Scenario: To check for the validation message if mandatory fields are empty
      When I follow "Contact"
      Then I should see error message as "Please fill in this field." if I click on send message without fill the form
      And I wait 2 seconds


