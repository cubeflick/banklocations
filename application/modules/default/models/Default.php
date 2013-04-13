<?php

class Default_Model_Default extends App_Model_BaseModel
{
   public function GetBankNames($params = array()){
        
        $where = '1 = 1';
        $select = $this->_db->select()
                    ->from('bank_detail',array('id','bank_name'))
                    ->where($where)
                    ->group('bank_name');
                    
        return $this->_db->fetchAll($select);
   }

   public function GetStatesNames($params = array()){
   
   	$where = '1 = 1';
   	$select = $this->_db->select()
   	->from('bank_detail',array('state'))
   	->where($where)
   	->group('state');
   
   	return $this->_db->fetchAll($select);
   }
    
   
   public function getstatejson($params = array()) {
        $where = '1 = 1';

        $order_by = " state  asc";


        if (isset($params['bank_name']) && $params['bank_name'] != '') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }
        
        $select = $this->_db->select()
                        ->from('bank_detail', array('state'))
                        ->where($where)
                        ->group('state')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }
    
   public function getbranchjson($params = array()) {
        $where = '1 = 1';

        $order_by = "  branch_name   asc";

        if (isset($params['bank_name']) && $params['bank_name'] != '') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }

        if (isset($params['state_name']) && $params['state_name'] != '') {
            $where .= " and state = '" . $params['state_name'] . "'";
        }

        $select = $this->_db->select()
                        ->from('bank_detail', array('branch_name'))
                        ->where($where)
                        ->group('branch_name')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }

    public function getdistrictjson($params = array()) {
        $where = '1 = 1';

        $order_by = "  district   asc";

        if (isset($params['bank_name']) && $params['bank_name'] != '') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }

        if (isset($params['state_name']) && $params['state_name'] != '') {
            $where .= " and state = '" . $params['state_name'] . "'";
        }

        $select = $this->_db->select()
                        ->from('bank_detail', array('district'))
                        ->where($where)
                        ->group('district')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }

   public function getcityjson($params = array()) {
        $where = '1 = 1';

        $order_by = "city asc";

        if (isset($params['bank_name']) && $params['bank_name'] != '') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }

        if (isset($params['state_name']) && $params['state_name'] != '') {
            $where .= " and state = '" . $params['state_name'] . "'";
        }
        
        if (isset($params['district_name']) && $params['district_name'] != '') {
            $where .= " and district = '" . $params['district_name'] . "'";
        }

        $select = $this->_db->select()
                        ->from('bank_detail', array('city'))
                        ->where($where)
                        ->group('city')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }

    public function getValues($params = array()) {
    
        $order_by = "id  asc";
        $where = '1 = 1';

        if (isset($params['order_by']) && $params['order_by'] != '') {
            $order_by = $params['order_by'];
        }
        if (isset($params['id'])) {
            $where .= ' and id=' . $params['id'];
        }
 
        $select = $this->_db->select()
                        ->from('google_adds_details')
                        ->where($where);
      		 return $this->_db->fetchAll($select);
    }

    public function getTotalCount($params = array()) {
    
        $order_by = "bank_name  desc";
        $where = '1 = 1';

        if (isset($params['order_by']) && $params['order_by'] != '') {
            $order_by = $params['order_by'];
        }
        if (isset($params['id'])) {
            $where .= ' and id=' . $params['id'];
        }

        if (isset($params['bank_name']) && $params['bank_name'] != '' && substr($params['bank_name'] , 0, 6) != 'Select') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }

        if (isset($params['branch_name']) && $params['branch_name'] != '' && substr($params['branch_name'] , 0, 6) != 'Select') {
            $where .= " and  branch_name = '" . $params['branch_name'] . "'";
        }

        if (isset($params['ifsc_code']) && $params['ifsc_code'] != '' && substr($params['ifsc_code'] , 0, 6) != 'Select') {
            $where .= " and ifsc_code LIKE '%" . $params['ifsc_code'] . "%'";
        }

        if (isset($params['micr_code']) && $params['micr_code'] != '' && substr($params['micr_code'] , 0, 6) != 'Select') {
            $where .= " and micr_code LIKE '%" . $params['micr_code'] . "%'";
        }

        if (isset($params['state_name']) && $params['state_name'] != '' && substr($params['state_name'] , 0, 6) != 'Select') {
            $where .= " and state = '" . $params['state_name'] . "'";
        }

        if (isset($params['district_name']) && $params['district_name'] != '' && substr($params['district_name'] , 0, 6) != 'Select') {
            $where .= " and district = '" . $params['district_name'] . "'";
        }

        if (isset($params['city_name']) && $params['city_name'] != '' && substr($params['city_name'] , 0, 6) != 'Select') {
            $where .= " and city = '" . $params['city_name'] . "'";
        }

        $select = $this->_db->select()
                        ->from('bank_detail',array('total' => new Zend_Db_Expr("count(id)")))
                        ->where($where);

        $select->order($order_by);
        $record =  $this->_db->fetchAll($select);        
        return $record[0]['total'];
    }

     public function getBankValues($params = array()) {

        $order_by = "bank_name  asc";
        $where = '1 = 1';

        if (isset($params['order_by']) && $params['order_by'] != '') {
            $order_by = $params['order_by'];
        }
        if (isset($params['id'])) {
            $where .= ' and id=' . $params['id'];
        }

        if (isset($params['bank_name']) && $params['bank_name'] != '' && substr($params['bank_name'] , 0, 6) != 'Select') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }

        if (isset($params['branch_name']) && $params['branch_name'] != '' && substr($params['branch_name'] , 0, 6) != 'Select') {
            $where .= " and  branch_name = '" . $params['branch_name'] . "'";
        }

        if (isset($params['state_name']) && $params['state_name'] != '' && substr($params['state_name'] , 0, 6) != 'Select') {
            $where .= " and state = '" . $params['state_name'] . "'";
        }

        if (isset($params['ifsc_code']) && $params['ifsc_code'] != '' && substr($params['ifsc_code'], 0, 6) != 'Select') {
            $where .= " and ifsc_code LIKE '%" . $params['ifsc_code'] . "%'";
        }

        if (isset($params['micr_code']) && $params['micr_code'] != '' && substr($params['micr_code'], 0, 6) != 'Select') {
            $where .= " and micr_code LIKE '%" . $params['micr_code'] . "%'";
        }

        if (isset($params['district_name']) && $params['district_name'] != '' && substr($params['district_name'] , 0, 6) != 'Select') {
            $where .= " and district = '" . $params['district_name'] . "'";
        }

        if (isset($params['city_name']) && $params['city_name'] != '' && substr($params['city_name'] , 0, 6) != 'Select') {
            $where .= " and city = '" . $params['city_name'] . "'";
        }


        $select = $this->_db->select()
                        ->from('bank_detail')
                        ->where($where);
        
//         if (isset($params['limitPage'])) {
//             $select->limitPage($params['limitPage'], 10);
//         } else {
//             $select->limitPage(1, 10);
//         }

        $select->order($order_by);
        $select->order('district');
        $select->order('city');
        $select->order('branch_name');

        return $this->_db->fetchAll($select);
    }


   

   public function saveValues($params = array(),$where = null) {
   	
        if (isset($params['id'])) {
            $this->_db->update("google_adds_details", $params, array('id = ?' => (int) $params['id']));
            return $last_insert_id = $params['id'];
        }else {
            $this->_db->insert("google_adds_details", $params);
            return $last_insert_id = $this->_db->lastInsertId();
        }
    }   
}