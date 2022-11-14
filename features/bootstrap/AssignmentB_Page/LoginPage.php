<?php

namespace AssignmentB_Page;

use Behat\Mink\Exception\ElementNotFoundException;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class LoginPage extends Page
{
    protected $path = '/en/user/login';

    /**
     * @throws ElementNotFoundException
     */
    public function iLoginUsingAdminCredentials()
    {
        $this->fillField('edit-name', 'umami_DDEVuname_aj');
        $this->fillField('edit-pass', 'Qrqr1234@');
        $this->pressButton('Log in');
        sleep(2);
        $this->find('css','a.site-logo')->click();
        sleep(2);
    }

}