<?php

require_once dirname(__FILE__) . '/../../vendor/autoload.php';

class UserSubscriptionTest extends PHPUnit_Extensions_Selenium2TestCase {

    public function setUp() {
        parent::setUp();
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://shalomsoftware.com.au/pm/');
        $this->setBrowser('firefox');
        
        
        //$this->setSeleniumServerRequestsTimeout(10000);
    }

    public function onNotSuccessfulTest($exception) {
        $filedata = $this->currentScreenshot();
        $file = dirname(__FILE__) . '/../../testfails/' . basename(get_class($this)) . '.png';
        file_put_contents($file, $filedata);

        parent::onNotSuccessfulTest($exception);
    }

    public function testIncorrectLogin() {
        //$this->timeouts()->implicitWait(25000);
        $this->url('http://shalomsoftware.com.au/pm/index.php/user/login');
        $this->assertEquals("Shalom Software Project Management Tool - Login", $this->title(), 'something wrong!!');

        $this->byName('UserLogin[username]')->value('admin');
        $this->byName('UserLogin[password]')->value('test$123');
        

        $this->waitForPageReload(function () {
            $this->byName('yt0')->click();
        }, 5000);        

        $this->assertContains("Password is incorrect", $this->source());
    }
    
    
    function waitForPageReload($navigate_f, $timeout) {

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
