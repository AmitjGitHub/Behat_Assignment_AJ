#behat
#language: en
Feature: As an Administrator user
  In order to create/edit the Recipe listing Page
  Admin user should have the access for Recipe Content Type and also can create taxonomy terms.

  Background:
    Given I am on "/user/login"
    And I wait 2 seconds
    When I login with admin user credentials
    Then I should see the link "Manage" in the "drupal_header" region
    Then I should see "Log out" in the "ul.menu-account" element

  @api
  Scenario:
    Given "Tags" terms:
      | name    |
      | Tag one |
      | Tag two |
    Given "recipe_category" terms:
      | name    |
      | Recipe one |
      | Recipe two |
    When I go to "/en/admin/structure/taxonomy/manage/tags/overview"
    Then I should see "Tag one"
    When I go to "/en/admin/structure/taxonomy/manage/recipe_category/overview"
    And I should see "Recipe one"
    And I wait 2 seconds
    And "recipe" content:
      | title            |
      | My first recipe  |
      | My second recipe |
      | My third recipe  |
    And I wait 2 seconds
    When I go to "admin/content"
    Then I should see "My first recipe"
    And I click "My first recipe" in the "My first recipe" row