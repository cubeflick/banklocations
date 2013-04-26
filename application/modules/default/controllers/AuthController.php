<?php 

class AuthController extends App_Controller_BaseController
{

	public function init() {
		parent::init();
		$this->Model = new Default_Model_Default();
	}
	
	
	public function loginAction()
	{
		$validators = array();
		$db = $this->_getParam('_db');
		
        $objRequest = $this->getRequest();
        if ($objRequest->isPost()) {
        	
        	$inputData = new Zend_Filter_Input($this->filters, $validators,$objRequest->getPost());
        	$data = $inputData->getEscaped();
			
			$adapter = new Zend_Auth_Adapter_DbTable(
					$db,
					'users',
					'username',
					'password',
					'MD5(?)'
			);
			
			$adapter->setIdentity($data['username']);
			$adapter->setCredential($data['password']);

			$auth   = Zend_Auth::getInstance();
			$result = $auth->authenticate($adapter);
			
			if ($result->isValid()) {
				$this->_redirect('admin/dashboard');
			}else{
				$this->_redirect('login');
			}
			
		}
					
	}
	
	public function logoutAction()
	{	
		$auth   = Zend_Auth::getInstance();
		$auth->clearIdentity();
		$this->_redirect('login');
	}	
}