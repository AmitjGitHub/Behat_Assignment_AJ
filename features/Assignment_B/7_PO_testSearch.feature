Feature: As an anonymous user
  In order to search for different content on umami site
  user is able to perform search activity on the site


  @api @test1
  Scenario: To test Search Using the Behat Page Object extension
    Given I visited "homepage"
    And I wait 2 seconds
    And search for "food"
    And I wait 2 seconds
    Then I should see "Search for food" in the header and food in result item list
    And I search for ""
    And I wait 2 seconds
    Then I should see error message as "Please enter some keywords."



