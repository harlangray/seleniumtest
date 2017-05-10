<?php
require(dirname(__FILE__).'/'.'LoginSetup.php'); 
class ProjectTest extends LoginSetup {


    public function testCreate() {

        $this->login();
        $this->url('http://shalomsoftware.com.au/pm/index.php/project/create');
        $this->assertEquals("Shalom Software Project Management Tool - Create Project", $this->title(), 'something wrong!!');

//        $this->byId('Project_clientId')->selectOptionByValue('Alpha Medical');
        $this->select($this->byId('Project_clientId'))->selectOptionByLabel('Alpha Medical');
//        $this->byName('UserLogin[username]')->value('admin');
//        $this->byName('UserLogin[password]')->value('test$123');
        

        $this->waitForPageReload(function () {
            $this->byName('save')->click();
        }, 5000);        

        $this->assertContains("Project Name cannot be blank.", $this->source());
        
        
    }
}
