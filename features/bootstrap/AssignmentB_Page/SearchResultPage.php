<?php

namespace AssignmentB_Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;
use Webmozart\PathUtil\Path;

class SearchResultPage extends Page
{
    protected $path = '/en/search/node';

    public function searchResultHeaderVerify():string
    {
        $getResultHeader = $this->find('css', 'h1.page-title')->getText();
        $getResultList = $this->findAll('css', 'div.item-list');

     //   $noResultHeader = $this->find('css', 'h1.page-title')->getText();

        if($getResultHeader === "Search")
        {
            $getError = $this->find('css', 'span.messages__item')->getText();
            print_r("Inside SearchResultPage...if \n");
           // print_r("$getError \n");
            return ($getError);
        }
        else
        {
            print_r("Inside SearchResultPage...else \n");
           // print_r($getResultHeader);
            return ($getResultHeader);
        }

    }

    public function searchResultVerify()
    {
        $getResultHeader = $this->find('css', 'h1.page-title')->getText();
        $getResultLists = $this->findAll('xpath', "//ol[@class='search-results node_search-results']/li/div/p/strong");
        $test = "123";
        foreach ($getResultLists as $getResultList)
        {
            $test = $getResultList->getText();
            //print_r($test);
        }
        return $test;
    }

}