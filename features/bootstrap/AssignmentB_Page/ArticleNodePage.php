<?php

namespace AssignmentB_Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class ArticleNodePage extends Page
{
    protected $path = '/en/node/add/article';

    public function filltheFieldwith($field, $value)
    {
        $this->fillField($field, $value);
    }


    public function iFillBodyWith($arg1)
    {
        //$page = $this->getPage();
        try {
            $this->getDriver()->switchToIFrame(0);
            $this->find('css', 'body.cke_editable')->setValue($arg1);
            $this->getDriver()->switchToIFrame(null);
            sleep(1);
        } catch (\Behat\Mink\Exception\UnsupportedDriverActionException $e) {
            throw new \Exception("UnsupportedDriverActionException");
        } catch (\Behat\Mink\Exception\DriverException $e) {
            throw new \Exception("DriverException");
        }
    }

    public function iSelectLangDD($arg1)
    {
        $status_dropdown = $this->find('css', '#edit-langcode-0-value');
        $status_dropdown->selectOption($arg1);
        sleep(1);

    }

    public function selectStatus($status)
    {
        $status_dropdown = $this->find('css', '#edit-moderation-state-0-state');
        $status_dropdown->selectOption($status);
    }

}
