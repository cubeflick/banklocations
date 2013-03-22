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
            'detailOfIndex', new Zend_Controller_Router_Route('/detail/:id', array('module'=>'default','controller'=>'index','action'=>'detail'))
        );
        $router->addRoute(
            'searchOfIndex', new Zend_Controller_Router_Route('/search', array('module'=>'default','controller'=>'index','action'=>'search'))
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
        		'searchofMicr', new Zend_Controller_Router_Route('/micr/search', array('module'=>'default','controller'=>'index','action'=>'searchmicr'))
        );
        $router->addRoute(
        		'searchofIfsc', new Zend_Controller_Router_Route('/ifsc/search', array('module'=>'default','controller'=>'index','action'=>'searchifsc'))
        );
    }
}

