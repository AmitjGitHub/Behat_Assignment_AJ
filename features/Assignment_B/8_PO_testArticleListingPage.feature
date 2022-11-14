#behat
#language: en
Feature: As an Administrator user
  In order to create/edit the Article listing page
  Admin user should have the access for Article Content Type (Node Page).

  Background:
    Given I visited "homepage"
    When I am on "login" and login with admin user credentials
    Then I should be able to see "umami_DDEVuname_aj"
  
#  Scenario:
#  And I wait 5 seconds

  @api @test1
  Scenario Outline:
    When I go to "<url>"
   # And I create content for "<lang>":
    And I fill "title[0][value]" with "<title>"
    And I fill body with "<body>"
    And I select lang dropdown "<langDD>"
    And I fill "edit-field-tags-target-id" with "<tags>"
#    And I open the select media dialog
#    And I Attach file
    #And I attach the file "test1.jpg" to "edit-upload--59gQv6MjPkE"

    And I select "draft"
    And I wait 2 seconds
    And I press "<Save>"
    When I go to "admin/content"
    Then I should see "<title>"
#
#    Given "article" content:
#      | title | moderation_state | languagecode|
#      | new article | published   | en         |
#      | espanyol article | published   | es         |
    Examples:
      | url | lang | title | body | langDD | tags | Save |
      | /en/node/add/article | en | new article | english body | English | Cocktail party | Save |
      | /es/node/add/article | es | espanyol article | espanyol body | Spanish | Carrots | Guardar |
    
    @test2
    Scenario:
      When I go to "/en"
      And I wait 5 seconds


