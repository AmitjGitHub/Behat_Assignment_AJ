<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\TranslatableContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
#use Behat\MinkExtension\Context\MinkContext;
use Drupal\DrupalExtension\Context\MinkContext;
#use AssignmentB_Page\HomePage;
#use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, TranslatableContext
{

    //private $homePage;

    //Here in FeatureContext.php, I comment the expression used for assignment B which is related to Page Object
    //And for ass. B I've created another context file 'PageFactorySearchContext' and also added this in behat.yml context

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()   //HomePage $homePage)
    {
       // $this->HOMEPAGE = $homePage;
    }


    /**
     * @When /^I click on \'([^\']*)\' icon$/
     */
    public function iClickOnIcon($arg1)
    {
        $page = $this->getSession()->getPage();
        $page->find('css', "i[class='fab fa-facebook-f']")->click();
    }


    /**
     * @Given /^I wait (\d+) seconds$/
     */
    public function iWaitSeconds($arg1)
    {
        sleep(seconds: $arg1);
    }

    /**
     * @Then /^the title is "([^"]*)"$/
     * @throws Exception
     */
    public function theTitleIs($arg1)
    {
        $title = $this->getSession()->evaluateScript("return document.title");
        if ($arg1 !== $title) {
            throw new Exception("expected title '$arg1', got '$title'");
        } else {
            echo $title;
        }
    }

    /**
     * @When I enter following details
     */
    public function iEnterFollowingDetails(TableNode $table)
    {
        $page = $this->getSession()->getPage();

        foreach ($table as $row) {
            //var_dump($row['Your name']);
            if ($page->find('css', 'li.en.is-active')) {
                $name = $row['Your name'];
                $mail = $row['Your email address'];
                $sub = $row['Subject'];
                $msg = $row['Message'];

                $page->find('css', '#edit-name')->setValue($name);
                $page->find('css', '#edit-mail')->setValue($mail);
                $page->find('css', '#edit-subject-0-value')->setValue($sub);
                $page->find('css', '#edit-message-0-value')->setValue($msg);
            } else if ($page->find('css', 'li.es.is-active')) {
                $name1 = $row['Su nombre'];
                $mail = $row['Su dirección de correo electrónico'];
                $sub = $row['Asunto'];
                $msg = $row['Mensaje'];

                $page->find('css', '#edit-name')->setValue($name1);
                $page->find('css', '#edit-mail')->setValue($mail);
                $page->find('css', '#edit-subject-0-value')->setValue($sub);
                $page->find('css', '#edit-message-0-value')->setValue($msg);
            }
        }
    }

//

    /**
     * @Then /^I should see error message as "([^"]*)" if I click on send message without fill the form$/
     * @throws Exception
     */
    public function iShouldSeeErrorMessageAs($arg1)
    {
        $page = $this->getSession()->getPage();
        $page->find('xpath', "//input[@value='Send message']")->click();
        // $msg = $page->find('css','#edit-name')->getAttribute('validationMessage');

        $validationMessage = $this->getSession()->evaluateScript("return document.querySelector('#edit-name').validationMessage");
        if ($validationMessage !== $arg1) {
            throw new Exception("expected validationMessage '$arg1', got '$validationMessage'");
        } else {
            echo $validationMessage;
        }

    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @When /^I login with admin user credentials$/
     */
    public function iLoginUsingValidCredentials()
    {
        $page = $this->getSession()->getPage();
        $page->fillField('edit-name', 'umami_DDEVuname_aj');
        $page->fillField('edit-pass', 'Qrqr1234@');
        $page->pressButton('Log in');
    }

    /**
     * @Given /^print the MyAccount and AccountName$/
     */
    public function printTheMyAccountAndAccountName()
    {
        $page = $this->getSession()->getPage();
        $accountName = $page->find('css', '#toolbar-item-user')->getText();
        $myAccount = $page->find('xpath', "//a[text()='My account']")->getText();
        echo "AccountName: ", $accountName, " menu-account__link: ", $myAccount;
    }

    /**
     * @Given /^I click on add content$/
     */
    public function iClickOnAddContent()
    {
        $page = $this->getSession()->getPage();
        $page->find('css', 'a.button--action')->click();

    }





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Given /^search section should be present on FE$/
     */
    public function searchSectionShouldBePresentOnFE()
    {
        $searchVisible = $this->getSession()->getPage()->find('css', '#search-block-form')->isVisible();
        if ($searchVisible) {
            echo "Background run: Search section is visible";
        } else {
            echo "Search section is not visible";
        }
    }


    /**
     * @Given /^I click on Spanish$/
     */
    public function iClickOnSpanish()
    {
        $this->getSession()->getPage()->find('xpath', "//ul[@class='links']/li[2]")->click();
    }


    /**
     * @Given /^I search for the keyword "([^"]*)" and press "([^"]*)"$/
     */
    public function iSearchForTheKeywordAndPress($arg1, $arg2)
    {
        $enteredValue = $this->getSession()->getPage()->find('css', '#edit-keys')->setValue("$arg1");
        $this->getSession()->getPage()->find('css', 'input.js-form-submit')->click();

//        $regex = "^(?=.*[a-zA-Z])(?=.*[0-9])[A-Za-z0-9]+$";
        if ($arg1 !== null && strlen($arg1) > 3 && $arg1 !== " ") {
            $searchResult = $this->getSession()->getPage()->find('css', 'div.item-list')->getText();
            //  echo "$searchResult";
            $noResult = "Your search yielded no results.";
            $noResultES = "Su búsqueda no produjo resultados";
            if ($searchResult == $noResult || $searchResult == $noResultES) {
                echo "The searched value $arg1 is not present on the result page";
            } else {
                echo "The searched value $arg1 is present on the result page";
            }
        } else {
            $expectedErrorMsg = "Please enter some keywords.";
            $errorMessage = $this->getSession()->getPage()->find('css', 'span.messages__item')->getText();
            if ($errorMessage == $expectedErrorMsg) {
                echo "Please enter valid keywords for search";
            } else {
                echo "Error";
            }
        }
    }

    /**
     * @Given /^now language should be selected "([^"]*)"$/
     */
    public function nowLanguageShouldBeSelected($arg1)
    {
        $expectedClass = "language-link is-active";
        $attributePath = $this->getSession()->getPage()->find('xpath', "//a[text()='English']");
        $actualClass = $attributePath->getAttribute("class");
        if ($actualClass == $expectedClass) {
            echo "The selected Lang is: Eng";
        } else {
            echo "The selected Lang is: Spanish";

        }
    }

    /**
     * @Then /^the title of the page is "([^"]*)"$/
     */
    public function theTitleOfThePageIs($arg1)
    {
        $title = $this->getSession()->evaluateScript("return document.title");
        if ($arg1 !== $title) {
            throw new Exception("expected title '$arg1', got '$title'");
        } else {
            echo $title;
        }

//        $title = $this->getSession()->getPage()->find('xpath',"//meta[@name='viewport']/../title");
//        $act = $title->getText();
//
////        $actualTitle = $title->getText();
////        if ($arg1 == $title)
////        {
////            echo "title matches: $actualTitle";
////        }
////        else
////        {
////            echo "title not matches, Expected: $arg1 and actual: $actualTitle";
////        }
    }

    /**
     * @When /^I Click on Advanced search$/
     */
    public function iClickOnAdvancedSearch()
    {
        $page = $this->getSession()->getPage()->find('css', '#edit-advanced');
        $page->click();
    }

    /**
     * @Then /^I should fill the following section with$/
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function iShouldFillTheFollowingSectionWith(TableNode $table)
    {
        $page = $this->getSession()->getPage();

        foreach ($table as $row) {
            $keyword = $row["Containing any of the words"];
            $type = $row["Only of the type(s)"];
            $lang = $row["Languages"];

            $page->find('css', '#edit-or')->setValue($keyword);
            $page->checkField('edit-type-article');
            $page->checkField('edit-language-en');
        }
    }

    /**
     * @Given /^I Click on "([^"]*)"$/
     */
    public function iClickOn($arg1)
    {
        $page = $this->getSession()->getPage()->find('css', '#edit-advanced');
        $page->click();
    }

    /**
     * @Given /^I click on the "([^"]*)"$/
     */
    public function iClickOnThe($arg1)
    {
        $page = $this->getSession()->getPage();
        $page->find('xpath', "(//input[@data-drupal-selector='edit-submit'])[3]")->click();
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////
///
//    /**
//    * @Given /^(?:|I )visited (?:|the )(?P<pageName>.*?)$/
//    */
//    public function iVisitedThe($pageName)
//    {
//        if (!isset($this->$pageName))
//            {
//            throw new \RuntimeException(sprintf('Unrecognised page: "%s".', $pageName));
//            }
//        $this->$pageName->open();
//    }
//
//    /**
//     * @Given search for the keyword :keyword
//     */
//    public function searchForTheKeyword($keyword)
//    {
//        $this->HOMEPAGE->searchTheKeyword($keyword);
//    }

}