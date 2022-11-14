#behat
#language: en
Feature: As an Administrator user
  In order to create/edit the Article content
  Admin user should have the access for Article Content Type (Node Page).

  Background:
    Given I am on "/user/login"
    And I wait 2 seconds
    When I login with admin user credentials
    Then I should see the link "Manage" in the "drupal_header" region
    Then I should see "Log out" in the "ul.menu-account" element

  @api
  Scenario:
    And I am on the homepage
    And I follow "Structure"
    And I wait 2 seconds
    And I follow "Content types"
    And I wait 2 seconds
    Then I should see "Article" in the "td.menu-label" element
    And I go to "/en/admin/content"
    And I click on add content
    And I follow "Article"
    And I am viewing an "article" content:
      | title | TestArticle   |
      | body  | A placeholder |
    And I wait 2 seconds
    When I go to "admin/content"
    Then I should see "TestArticle"
    And I wait 2 seconds
    And I click "Edit" in the "TestArticle" row
    And I wait 2 seconds
    And I select "Published" from "edit-moderation-state-0-state"
    And I press "Save"
    And I wait 2 seconds
    And I click "TestArticle" in the "TestArticle" row
    And I wait 2 seconds
    Then I should see "TestArticle" in the "div.region-content" element
    And I wait 1 seconds
