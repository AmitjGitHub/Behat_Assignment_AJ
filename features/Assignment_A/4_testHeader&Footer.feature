#behat
#language: en
Feature: As an anonymous user
  In order to navigate to respective header and footer links
  user should be able to see header and footer with its components

  Background:
    Given I am on the homepage

  Scenario Outline:
    When I go to "<Page>"
    And I should see "<Log-in>" in the "header" region
    And I should see "English" in the "header" region
    And I should see "Spanish" in the "header" region
    And I should see "<Search>" in the "header" region
      |Menu1 | Menu2 | Menu3 | logo |
      |Home | Articles | Recipes | Home |
    And I wait 2 seconds
    And I should see "Recipe collections" in the "footer1" region
    And I should see "Contact" in the "footer2" region
    And I should see "<Terms>" in the "footer3" region
    Examples:
      | Page | Log-in | Search | Terms |
      | /en | Log in | Search  |Terms & Conditions |
      | /es | Iniciar sesión | Buscar  | Términos y Condiciones |
      | /en/contact | Log in | Search  |Terms & Conditions      |
      | /en/search/node | Log in |Search  |Terms & Conditions   |
