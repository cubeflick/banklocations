<?php

class App_Acl extends Zend_Acl {

    public function __construct() {
        $config = Zend_Registry::get('config');
        $roles = $config->acl->roles;
        $this->_addRoles($roles);
    }

    protected function _addRoles($roles) {
        foreach ($roles as $name => $parents) {
            if (!$this->hasRole($name)) {
                if (empty($parents)) {
                    $parents = null;
                } else {
                    $parents = explode(',', $parents);
                }
                $this->addRole(new Zend_Acl_Role($name), $parents);
            }
        }

        //Manage Resource and permissions

        $this->deny('public', null ,null);

        //Default Module

        //Index Controller
        $this->addResource(new Zend_Acl_Resource('default-index'));
        $this->allow(null, 'default-index', array('index'));

        //Admin Controller
        $this->addResource(new Zend_Acl_Resource('default-admin'));
        $this->allow('admin', 'default-admin', array('index'));


        //User Module

        //Admin Controller
        $this->addResource(new Zend_Acl_Resource('user-admin'));
        $this->allow('admin', 'user-admin', array('index','getallxml','delete','edit','add','changestatus'));

        //Admin Controller
        $this->addResource(new Zend_Acl_Resource('user-index'));
        $this->allow(null, 'user-index', array('getuser'));
    }

    

}
?>
