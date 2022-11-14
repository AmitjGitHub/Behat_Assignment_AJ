#behat
#language: en
Feature: As an Administrator user
  In order to test the default Content moderation permissions set on /admin/people/permissions.
  Admin user should be able to see and verify the moderation state for any content type

  Background:
    Given I am on "/user/login"
    And I wait 2 seconds
    When I login with admin user credentials
    # Given I am logged in as a user with the administrator role
    Then I should see "umami_DDEVuname_aj" in the "drupal_header"
    And I wait 2 seconds
    And print the MyAccount and AccountName

  @api
  Scenario:
    And "page" content:
    | title      | body |
    | TestBasicPage  | testContent |
    And I wait 2 seconds
    When I go to "admin/content"
    Then I should see "TestBasicPage"
    And I wait 2 seconds
    And I click "Edit" in the "TestBasicPage" row
    And I wait 2 seconds
    And I select "Draft" from "edit-moderation-state-0-state"
    And I press "Save"
    And I wait 4 seconds
    Then I should see the success message "Basic page TestBasicPage has been updated."

    And I click "Edit" in the "TestBasicPage" row
    And I wait 2 seconds
    And I select "Published" from "edit-moderation-state-0-state"
    And I press "Save"
    And I wait 2 seconds
    Then I should see the success message "Basic page TestBasicPage has been updated."