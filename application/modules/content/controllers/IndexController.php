<?php

class Content_IndexController extends App_Controller_Modules_Content_ContentbaseController {

    public function init() {
        parent::init();
        $this->DefaultModel = new Default_Model_Default();        
    }

    public function indexAction() {
        $this->view->PageHead = "About Us";
    }
    public function aboutusAction() {
        $this->view->PageHead = "About Us";
    }
    public function contactusAction() {
        $this->view->PageHead = "Contact Us";
    }
    public function privacypolicyAction() {
        $this->view->PageHead = "Privacy Policy";
    }
    public function termsandconditionAction() {
        $this->view->PageHead = "Terms and Condition";
    }
    public function helpadnfaqAction() {
        $this->view->PageHead = "Help and FAQs";
        $this->view->navId = 'help';
    }
    public function servicesAction() {
        $this->view->PageHead = "Help and FAQs";
    }
}