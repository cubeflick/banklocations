<?php

class AdminController extends App_Controller_BaseController {

    public function init() {
        parent::init();
        $this->Model = new Default_Model_Default();
    }

	public function indexAction() {
		
		
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
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
		}
		else
		{
			$this->_redirect('login');
		}	
		
		

        $result = $this->Model -> getValues();
        $this->view->Details = $result[0];
    }
    
    
    public function metatagAction() {
    	$validators = array();
    	$objRequest = $this->getRequest();
    	
    	$referer = $objRequest->getHeader('referer');
    	if($referer == $this->constant->HOSTPATH."admin/metatag/manage")
    	{
    	$id = $objRequest->getParam('id');
        $id = explode('_', $id);
        $records = $this->Model->getallMetatagValues(array('id'=> $id[0]));
        $this->view->value = $records[0];
    	}
    	

    	if ($objRequest->isPost()) {
    		$inputData = new Zend_Filter_Input($this->filters, $validators,$objRequest->getPost());
    		if ($inputData->isValid()) {
    			 
    			$result = $this->Model->getallMetaValues();
    			$data = $inputData->getEscaped();
    			$dataInput = array();
    
    			$dataInput['page_url'] = $data['page_url'];
    			$dataInput['title'] = $data['title'];
    			$dataInput['keywords'] = $data['keywords'];
    			$dataInput['description'] = $data['description'];
    			
    
    			
    			$eventId = $this->Model->saveMetaValues($dataInput);
    
    		} else {
    
    			 
    			$data = $objRequest->getPost();
    			$this->view->actionErrors = $this->getValidatorErrors(
    					$inputData->getMessages());
    			return false;
    		}
    		 
    	}
    	
    	
    	
    }
    
    public function manageAction() {
    	
    	$this->view->Records = $this->Model->getMetatagValues();
    
    }
    public function metatagdeleteAction() {
    	
    	$objRequest = $this->getRequest();
    	$id = $objRequest->getParam('id');
    	$id = explode('_', $id);
    	$this->Model->metatagdelete($id[0]);
    	$this->view->Records = $this->Model->getMetatagValues();
    	$this->_redirect('admin/metatag/manage');
    	
    }
    
    
    
}