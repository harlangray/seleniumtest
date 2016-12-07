<?php
require_once 'vendor/autoload.php';
class UserSubscriptionTest extends PHPUnit_Extensions_Selenium2TestCase {

    public function setUp() {
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://localhost/seleniumtest/index.php');
        $this->setBrowser('firefox');
    }

    public function tearDown() {
        $this->stop();
    }

}
