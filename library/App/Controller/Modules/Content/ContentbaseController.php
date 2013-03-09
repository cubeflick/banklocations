<?php
class App_Controller_Modules_Content_ContentbaseController extends App_Controller_BaseController
{
    public function init() {
        parent::init();
    }

    public function indexAction() {
        $this->view->leftsidebar = 'index';
        $this->view->SectionHeading = "Content Management";
    }    
}
?>
