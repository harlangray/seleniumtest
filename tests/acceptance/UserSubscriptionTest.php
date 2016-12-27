<?php
require_once dirname(__FILE__) . '/../../vendor/autoload.php';
class UserSubscriptionTest extends PHPUnit_Extensions_Selenium2TestCase {

    public function setUp() {
        parent::setUp();
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://localhost/cwckids/web/user/login');
        $this->setBrowser('firefox');
        //$this->setSeleniumServerRequestsTimeout(10000);
    }

   
public function onNotSuccessfulTest($exception)
{
    $filedata   = $this->currentScreenshot();
    $file       = dirname(__FILE__) . '/../../testfails/' . basename(get_class($this)) . '.png';
    file_put_contents($file, $filedata);

    parent::onNotSuccessfulTest($exception);
}
  
    
public function testFormSubmissionWithUsername()
{
    //$this->timeouts()->implicitWait(25000);
    $this->url('http://localhost/cwckids/web/user/login');
    $this->assertEquals("Sign in", $this->title(), 'something wrong!!');
    
    $this->byName('login-form[login]')->value('admin');
    $this->byName('login-form[password]')->value('Psalm@4610');
    //$this->byt('button')->click();
    $this->byId('login-form')->submit();

    //$this->timeouts()->implicitWait(10000);
    sleep(3);
    
    $this->assertEquals("CWC Children's Ministry", $this->title(), 'something wrong!!');
}    
}
