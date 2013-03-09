<?php

class App_Model_BaseModel extends Zend_Db_Table_Abstract {

    /**
     * Defining class variable for zend database adapter.
     */
    public $_db;
    /**
     * Defining class variable for user session.
     */
    public $userSession;

    /**
     * Initializing zend database adapter and initializing user session variable for use.
     *
     * @param
     *
     * @return
     */
    public function __construct() {
        if (null === $this->_db) {
            $this->_db = self::getDBAdapter();
        }
        $userSession = new Zend_Session_Namespace('userNamespace');
        $this->userSession = $userSession->storage;
        $this->constant = new Zend_Config_Ini(APPLICATION_PATH.'/configs/constants.ini', 'site', true);
    }

    /**
     * Initializing zend database adapter
     *
     * @param
     *
     * @return object
     */
    protected function getDBAdapter() {
        global $application;
        return $application->getBootstrap()->getResource('db');
    }

    /**
     * Setting default database table name for db model instance externally through model object.
     *
     * @param
     *
     * @return
     */
    public function setDBTableName($name) {
        $this->_name = $name;
    }

    /**
     * Getting default database current table name of db model instance externally through model object.
     *
     * @param
     *
     * @return string Default db model instance current table name
     */
    public function getDBTableName() {
        return $this->_name;
    }

    /**
     * This function is used to fetch information from specified config file
     *
     * @param string $config_name This parameter is used to specify config file name from which information is to be fetched
     * @param string $sect_name This parameter is used to specify section in constant.ini file from which constants are to fetched
     *
     * @return array This function will return constants in array (key => value) format
     */
    public function getConfig($config_name = 'constants', $sect_name='') {
        if ($config_name != '' && $sect_name != '') {
            $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/' . $config_name . '.ini', $sect_name, true);
            return $config->toArray();
        }
    }

    /**
     * This function will be used to filter specified table data out of posted data.
     *
     * @param string $table_name Table name for which data is to be filtered.
     * @param array $data Posted Data.
     *
     * @return array Filtered data array related to specified table.
     */
    public function filterTableData($table_name, $data = array()) {
        $form_mapping = $this->getConfig('form_field_mapping', $table_name);
        $table_data = array();
        if (!empty($data)) {
            foreach ($data as $key => $item) {
                if (isset($form_mapping[$key])) {
                    $table_data[$form_mapping[$key]] = $item;
                }
            }
        }
        return $table_data;
    }

    /* This function will be used to fetch all sub nodes in tree format.
     *
     * @param array $params Array will contain
     * 						For e.g., array('allNodes' => <2-D array of all nodes>,
     * 										'parentNode' => <Parent node id>,
     * 										'parentNodeName' => <Parent node index name>,
     * 										)
     *
     * @return array Tree in 2-D array format
     */

    public function fetchTree($params = array()) {
        $tree = array();
        $parent = 0;
        if (isset($params['parentNode']) && !empty($params['parentNode'])) {
            $parent = $params['parentNode'];
        }
        $parentIndex = 'parent_id';
        if (isset($params['parentNodeName']) && !empty($params['parentNodeName'])) {
            $parentIndex = $params['parentNodeName'];
        }

        if (isset($params['allNodes']) && !empty($params['allNodes'])) {
            foreach ($params['allNodes'] as $key => $node) {
                if ($node[$parentIndex] == $parent) {
                    $tree[$node['cm_id']]['id'] = $node['id'];
                    $remainingNodes = $params['allCategories'];
                    unset($remainingNodes[$key]);
                    $tree[$node['cm_id']]['children'] = $this->fetchTree(array('allNodes' => $remainingNodes, 'parentNode' => $node['id']));
                }
            }
        }
        return $tree;
    }

    public function alphaID($in, $to_num = false, $pad_up = 9, $passKey = null) {
        $index = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($passKey !== null) {
            // Although this function's purpose is to just make the
            // ID short - and not so much secure,
            // with this patch by Simon Franz (http://blog.snaky.org/)
            // you can optionally supply a password to make it harder
            // to calculate the corresponding numeric ID

            for ($n = 0; $n < strlen($index); $n++) {
                $i[] = substr($index, $n, 1);
            }

            $passhash = hash('sha256', $passKey);
            $passhash = (strlen($passhash) < strlen($index)) ? hash('sha512', $passKey) : $passhash;

            for ($n = 0; $n < strlen($index); $n++) {
                $p[] = substr($passhash, $n, 1);
            }

            array_multisort($p, SORT_DESC, $i);
            $index = implode($i);
        }

        $base = strlen($index);

        if ($to_num) {
            // Digital number  <<--  alphabet letter code
            $in = strrev($in);
            $out = 0;
            $len = strlen($in) - 1;
            for ($t = 0; $t <= $len; $t++) {
                $bcpow = bcpow($base, $len - $t);
                $out = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
                }
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        } else {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
                }
            }

            $out = "";
            for ($t = floor(log($in, $base)); $t >= 0; $t--) {
                $bcp = bcpow($base, $t);
                $a = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in = $in - ($a * $bcp);
            }
            $out = strrev($out); // reverse
        }

        return $out;
    }

   public function getStaticValues($section,$valueType){
        return $this->constant->fixvalues->$section->$valueType;
    }
}

?>