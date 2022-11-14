#behat
#language: en
Feature: As an Administrator user
  In order to test the search and advanced search feature
  Admin user should be able to perform search as well advanced search activity

  Background:
    Given I am on "/user/login"
    And I wait 2 seconds
    When I login with admin user credentials
    Then I should see "umami_DDEVuname_aj" in the "drupal_header"
    And I wait 2 seconds
    And I am on the homepage
    And search section should be present on FE
    And I wait 2 seconds

 Scenario Outline: Search
   When I go to "<url>"
   And now language should be selected "<as>"
   And I search for the keyword "food" and press "<searchButton>"
   Then the title of the page is "<title>"
   Examples:
     | url | as |searchButton | title |
     | https://my-d9umami-site.ddev.site/en | English |Search | Search for food \| Drupal |
     | https://my-d9umami-site.ddev.site/es | Spanish |Buscar | Buscar por food \| Drupal |

   @a
 Scenario Outline: Advanced Search
     When I go to "<url>"
     And I Click on "<AdvSearch>"
     And I wait 2 seconds
     And I fill in "<search>" with "<key>"
     And I check the box "<Type>"
     And I check the box "<Lang>"
     And I wait 2 seconds
     And I click on the "Advanced search"
     And I wait 2 seconds
     Then I should see "<text>" in the "div.item-list" element
     Examples:
       | url | AdvSearch | search | key | Type | Lang |text |
       | https://my-d9umami-site.ddev.site/en/search/node | edit-advanced | edit-phrase | Vegan chocolate and nut | edit-type-recipe | edit-language-en |Vegan chocolate and nut|
       | https://my-d9umami-site.ddev.site/es/search/node | edit-advanced | edit-phrase | es la comida más        | edit-type-recipe | edit-language-es |es la comida más|

