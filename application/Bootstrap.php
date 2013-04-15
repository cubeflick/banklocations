<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

   protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $configSection = 'production';
        Zend_Registry::set('configSection',$configSection);
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini',$configSection);
        Zend_Registry::set('config', $config);

        Zend_Controller_Action_HelperBroker::addPrefix('App_Controller_Action_Helper_');

        $acl = new App_Acl();
        $aclHelper = new App_Controller_Action_Helper_Acl(null, array('acl'=>$acl));
        Zend_Controller_Action_HelperBroker::addHelper($aclHelper);        
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();

        $router->addRoute(
        		'searchOfIndex', new Zend_Controller_Router_Route(':bank_name/:state_name/:district_name/:city_name', array('module'=>'default','controller'=>'index','action'=>'search','bank_name'=>'','state_name'=>'','district_name'=>'','city_name'=>''))
        );
        $router->addRoute(
        		'indexOfHome', new Zend_Controller_Router_Route('/', array('module'=>'default','controller'=>'index','action'=>'index'))
        );
        $router->addRoute(
            'detailOfIndex', new Zend_Controller_Router_Route('/detail/:id', array('module'=>'default','controller'=>'index','action'=>'detail'))
        );
        $router->addRoute(
        		'searchAtm', new Zend_Controller_Router_Route('/atm', array('module'=>'atm','controller'=>'index','action'=>'index'))
        );
        $router->addRoute(
            'searchOfAtm', new Zend_Controller_Router_Route('/atm/search', array('module'=>'atm','controller'=>'index','action'=>'search'))
        );
        $router->addRoute(
            'detailOfAtm', new Zend_Controller_Router_Route('/atm/detail/:id', array('module'=>'atm','controller'=>'index','action'=>'detail'))
        );
        $router->addRoute(
            'aboutus', new Zend_Controller_Router_Route('/aboutus', array('module'=>'content','controller'=>'index','action'=>'aboutus'))
        );
        $router->addRoute(
            'contactus', new Zend_Controller_Router_Route('/contactus', array('module'=>'content','controller'=>'index','action'=>'contactus'))
        );
        $router->addRoute(
            'privacypolicy', new Zend_Controller_Router_Route('/privacypolicy', array('module'=>'content','controller'=>'index','action'=>'privacypolicy'))
        );
        $router->addRoute(
            'termsandcondition', new Zend_Controller_Router_Route('/termsandcondition', array('module'=>'content','controller'=>'index','action'=>'termsandcondition'))
        );
        $router->addRoute(
            'helpadnfaq', new Zend_Controller_Router_Route('/helpadnfaq', array('module'=>'content','controller'=>'index','action'=>'helpadnfaq'))
        );
        $router->addRoute(
            'services', new Zend_Controller_Router_Route('/services', array('module'=>'content','controller'=>'index','action'=>'services'))
        );
        $router->addRoute(
        		'searchByCity', new Zend_Controller_Router_Route('/searchbycity', array('module'=>'default','controller'=>'index','action'=>'city'))
        );
        $router->addRoute(
        		'searchIfsc', new Zend_Controller_Router_Route('/ifsc', array('module'=>'default','controller'=>'index','action'=>'ifsc'))
        );
        $router->addRoute(
        		'searchMicr', new Zend_Controller_Router_Route('/micr', array('module'=>'default','controller'=>'index','action'=>'micr'))
        );
        
        $router->addRoute(
        		'searchofMicr', new Zend_Controller_Router_Route('/micr/:micr_code', array('module'=>'default','controller'=>'index','action'=>'searchmicr'))
        );
        $router->addRoute(
        		'searchofIfsc', new Zend_Controller_Router_Route('/ifsc/:ifsc_code', array('module'=>'default','controller'=>'index','action'=>'searchifsc'))
        );
        $router->addRoute(
        		'statejson', new Zend_Controller_Router_Route('/getstatejson', array('module'=>'default','controller'=>'index','action'=>'getstatejson'))
        );
        $router->addRoute(
        		'branchjson', new Zend_Controller_Router_Route('/getbranchjson', array('module'=>'default','controller'=>'index','action'=>'getbranchjson'))
        );
        $router->addRoute(
        		'districtjson', new Zend_Controller_Router_Route('/getdistrictjson', array('module'=>'default','controller'=>'index','action'=>'getdistrictjson'))
        );
        $router->addRoute(
        		'cityjson', new Zend_Controller_Router_Route('/getcityjson', array('module'=>'default','controller'=>'index','action'=>'getcityjson'))
        );
        
        
        $router->addRoute(
        		'statejsonatm', new Zend_Controller_Router_Route('getstatejsonatm', array('module'=>'atm','controller'=>'index','action'=>'getstatejsonatm'))
        );
        $router->addRoute(
        		'branchjsonatm', new Zend_Controller_Router_Route('getbranchjsonatm', array('module'=>'atm','controller'=>'index','action'=>'getbranchjsonatm'))
        );
        $router->addRoute(
        		'districtjsonatm', new Zend_Controller_Router_Route('getdistrictjsonatm', array('module'=>'atm','controller'=>'index','action'=>'getdistrictjsonatm'))
        );
        $router->addRoute(
        		'cityjsonatm', new Zend_Controller_Router_Route('getcityjsonatm', array('module'=>'atm','controller'=>'index','action'=>'getcityjsonatm'))
        );
    }
}

