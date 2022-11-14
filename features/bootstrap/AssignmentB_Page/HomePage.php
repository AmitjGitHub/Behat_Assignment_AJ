<?php

namespace AssignmentB_Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class HomePage extends Page
{
    protected $path = '/';
    // protected $path = '/{Lang}';

    //Then I should see "umami_DDEVuname_aj" in the "drupal_header"

    public function searchTheKeyword($keyword)
    {
        $searchSection = $this->find('css', '#edit-keys');
        $searchButton = $this->find('css', '#edit-submit');

        $this->fillField('edit-keys',$keyword);
      //  $this->findField('edit-keys')->setValue($keyword);   <=== For finding and filling the value in the search bar we can also use this expression
        $this->pressButton('edit-submit');

        if ($searchSection)
        {
            echo "Search section is visible, and searching for the keyword: $keyword";
            $searchSection->setValue($keyword);
            $searchButton->click();
        } else
        {
            echo "Search section is not visible";
        }
    }

    public function iShouldBeAbleToSeeTheContent($content)
    {
        if ($this->hasContent($content))
        {
            return $this->find('css', '#toolbar-item-user')->getText();;
        }
    }


}