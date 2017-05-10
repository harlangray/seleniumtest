<?php

require_once dirname(__FILE__) . '/../../vendor/autoload.php';

class LoginSetup extends PHPUnit_Extensions_Selenium2TestCase {

    public function setUp() {
        parent::setUp();
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://shalomsoftware.com.au/pm/');
        $this->setBrowser('firefox');
    }

    public function tearDown(){
        $this->stop();
    }

    public function onNotSuccessfulTest($exception) {
        $filedata = $this->currentScreenshot();
        $file = dirname(__FILE__) . '/../../testfails/' . basename(get_class($this)) . '.png';
        file_put_contents($file, $filedata);

        parent::onNotSuccessfulTest($exception);
    }

    public function login() {
        $this->url('http://shalomsoftware.com.au/pm/index.php/user/login');
        $this->byName('UserLogin[username]')->value('harlan');
        $this->byName('UserLogin[password]')->value('sinky7');


        $this->waitForPageReload(function () {
            $this->byName('yt0')->click();
        }, 5000);
    }

    public function waitForPageReload($navigate_f, $timeout) {

        $id = $this->byCssSelector('body')->getId();

//        echo 'Before>>>' . $id . '<<<';

        call_user_func($navigate_f);
        $this->waitUntil(function () use ($id) {
            $html = $this->byCssSelector('body');
            if ($html->getId() != $id)
                return TRUE;
        }, $timeout);
    }

}
