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
    }
         
}

