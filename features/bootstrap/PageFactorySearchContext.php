<?php

use Behat\Behat\Context\Context;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;
use AssignmentB_Page\HomePage;
use AssignmentB_Page\SearchResultPage;
use AssignmentB_Page\LoginPage;
use AssignmentB_Page\ArticleNodePage;


class PageFactorySearchContext extends PageObjectContext implements Context
{
    private $homepage;
    private $searchresultpage;
    private $loginpage;
    private $articlenodepage;

    public function __construct(HomePage $homepage, SearchResultPage $searchresultpage, LoginPage $loginPage, ArticleNodePage $articlenodepage)
    {
        $this->homepage = $homepage;
        $this->searchresultpage = $searchresultpage;
        $this->loginpage = $loginPage;
        $this->articlenodepage = $articlenodepage;
    }

//    /**
//     * @Given /^(?:|I )visited Homepage$/
//     */
//    public function iVisitedThePage()
//    {
//        $this->homepage->open();
//       // $this->getPage(homepage::class)->open(array('Lang' => 'en'));
//
//    }

    /**
     *  @Given I visited :arg1
     */
    public function iVisited($pageName)
    {
        if (!isset($this->$pageName)) {
            throw new \RuntimeException(sprintf('Unrecognised page: "%s".', $pageName));
        }

        $this->$pageName->open();
    }

    /**
     * @Given /^(?:|I )search for "([^"]*)"$/
     */
    public function iSearchFor($keyword)
    {
       // $this->getPage(homepage::class)->isOpen(array('Lang' => 'en')); //We can use this syntax when we define Any parameters to the open() method in the Homepage.php file
       // $this->getPage(homepage::class)->searchTheKeyword($keyword);    //This syntax can be used if we want to use PageFactory method to pen the page
       $this->homepage->searchTheKeyword($keyword);                       //This syntax can be used if we directly want to open the page using page object

    }
//

    /**
     * @Then /^I should see "([^"]*)" in the header and food in result item list$/
     */
    public function iShouldSeeInTheHeaderAndFoodInResultItemList($arg1)
    {
        $actualMsg = $this->getPage(searchresultpage::class)->searchResultHeaderVerify();
        if ($actualMsg === $arg1)
        {
            echo "\nInside context...food...if\n";
            echo "Search result header: $actualMsg\n";

            $ResultItemList = $this->getPage(searchresultpage::class)->searchResultVerify();
            echo "Search result item list contains the searched keyword: $ResultItemList";
        }
        else
        {
            echo "\nInside context...food... else\n";
            echo $actualMsg;
        }
    }

    /**
     * @Then /^I should see error message as "([^"]*)"$/
     */
    public function iShouldSeeErrorMessageAs($arg1)
    {
        $actualMsg = $this->getPage(searchresultpage::class)->searchResultHeaderVerify(); //We can EITHER use page factory getPage method to get the page and use the methods available on searchresultpage::class
    //  $actualMsg = $this->searchresultpage->searchResultHeaderVerify();    // OR we can also use the page object extension method to open the page and go to the methods of the class searchresultpage

        if ($actualMsg === $arg1)
        {
            echo "\nInside context...if\n";
            echo "Search Result Header Error Message: $actualMsg";
        }
        else
        {
            echo "\nInside context... else\n";
            echo "Search Result Header Error Message is not matched: $actualMsg";
        }
    }

    /**
     * @Given /^I create content as:$/
     */
    public function iCreateContentAs(\Behat\Gherkin\Node\TableNode $table)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I am on "([^"]*)" and login with admin user credentials$/
     */
    public function iAmOnAndLoginWithUserCredentials($pageName)
    {
        $this->homepage->findLink("Log in")->click();
        $this->loginpage->iLoginUsingAdminCredentials();
        sleep(5);
    }

    /**
     * @Then /^I should be able to see "([^"]*)"$/
     */
    public function iShouldBeAbleToSee($arg1)
    {
        $actualOutput = $this->homepage->iShouldBeAbleToSeeTheContent($arg1);
        assert($actualOutput === $arg1);
    }

    /**
     * @Given /^I fill "([^"]*)" with "([^"]*)"$/
     */
    public function iFillWith($field, $fieldValue)
    {
        $this->articlenodepage->filltheFieldwith($field, $fieldValue);
    }

    /**
     * @Given /^I fill body with "([^"]*)"$/
     */
    public function iFillBodyWith($bodyValue)
    {
        $this->articlenodepage->iFillBodyWith($bodyValue);
    }

    /**
     * @Given /^I select lang dropdown "([^"]*)"$/
     */
    public function iSelectLangDropdown($arg1)
    {
        $this->articlenodepage->iSelectLangDD($arg1);
    }

    /**
     * @Given /^I open the select media dialog$/
     */
    public function iOpenTheSelectMediaDialog()
    {
        $this->articlenodepage->find('css','#edit-field-media-image-open-button')->click();

    }

    /**
     * @Given /^I Attach file$/
     */
    public function iAttachFile()
    {
        $element = $this->getElement('Add file');
        $element -> attachFile(getcwd() . '/asset/Pic/test1.jpg');
    }

    /**
     * @Given /^I select "([^"]*)"$/
     */
    public function iSelect($arg1)
    {
        $this->articlenodepage->selectStatus($arg1);
    }


}