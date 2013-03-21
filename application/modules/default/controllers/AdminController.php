<?php

class AdminController extends App_Controller_BaseController {

    public function init() {
        parent::init();
        $this->Model = new Default_Model_Default();
    }

public function indexAction() {
        $validators = array();
        $objRequest = $this->getRequest();
        if ($objRequest->isPost()) {
            $inputData = new Zend_Filter_Input($this->filters, $validators,$objRequest->getPost());
            if ($inputData->isValid()) {
            	
            	$result = $this->Model->getValues();
                $data = $inputData->getEscaped();
                $dataInput = array();

                $dataInput['home_add'] = $data['home_add_script'];
                $dataInput['bottom_add'] = $data['bottom_add_script'];
                $dataInput['right_add'] = $data['right_add_script'];
                $dataInput['top_add'] = $data['top_add_script'];
                $dataInput['banner_add'] = $data['banner_add_script'];
                
                if (count($result) > 0)
                {
                $dataInput['id'] = $result[0]['id'];	
                }
                
                $eventId = $this->Model->saveValues($dataInput);
                
            } else {
				
            	
                $data = $objRequest->getPost();
                $this->view->actionErrors = $this->getValidatorErrors(
                $inputData->getMessages());
                return false;
            }
           
        }
        $result = $this->Model -> getValues();
        $this->view->Details = $result[0];
    }
}