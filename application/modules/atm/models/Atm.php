<?php

class Atm_Model_Atm extends App_Model_BaseModel
{
   public function GetAtmNames($params = array()){
        
        $where = '1 = 1';
        $select = $this->_db->select()
                    ->from('atm_detail',array('id','bank_name'))
                    ->where($where)
                    ->group('bank_name');
                    
        return $this->_db->fetchAll($select);
   }
   
   public function GetStateNames($params = array()){
   
   	$where = '1 = 1';
   	$select = $this->_db->select()
   	->from('atm_detail',array('state'))
   	->where($where)
   	->group('state');
   
   	return $this->_db->fetchAll($select);
   }

   public function getstatejsonatm($params = array()) {
        $where = '1 = 1';

        $order_by = "state  asc";


        if (isset($params['bank_name']) && $params['bank_name'] != '') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }
        
        $select = $this->_db->select()
                        ->from('atm_detail', array('state'))
                        ->where($where)
                        ->group('state')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }
    
   public function getbranchjsonatm($params = array()) {
        $where = '1 = 1';

        $order_by = "  area   asc";

        if (isset($params['bank_name']) && $params['bank_name'] != '') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }

        if (isset($params['state_name']) && $params['state_name'] != '') {
            $where .= " and state = '" . $params['state_name'] . "'";
        }

        $select = $this->_db->select()
                        ->from('atm_detail', array('area'))
                        ->where($where)
                        ->group('area')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }

    public function getdistrictjsonatm($params = array()) {
        $where = '1 = 1';

        $order_by = "  district   asc";

        if (isset($params['bank_name']) && $params['bank_name'] != '') {
            $where .= " and  bank_name = '" . $params['bank_name'] . "'";
        }

        if (isset($params['state_name']) && $params['state_name'] != '') {
            $where .= " and state = '" . $params['state_name'] . "'";
        }

        $select = $this->_db->select()
                        ->from('atm_detail', array('district'))
                        ->where($where)
                        ->group('district')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }

   public function getcityjsonatm($params = array()) {
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
                        ->from('atm_detail', array('city'))
                        ->where($where)
                        ->group('city')
                        ->order($order_by);
        $records = $this->_db->fetchAll($select);
        echo json_encode($records);
        exit;
    }

    public function getValuesAtm($params = array()) {
    
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

        if (isset($params['area']) && $params['area'] != '' && substr($params['area'] , 0, 6) != 'Select') {
            $where .= " and  area = '" . $params['area'] . "'";
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
                        ->from('atm_detail')
                        ->where($where);
        if (isset($params['limitPage'])) {
            $select->limitPage($params['limitPage'], 10);
        } else {
            $select->limitPage(1, 10);
        }

        $select->order($order_by);
        $select->order('district');
        $select->order('city');
        $select->order('area');
        
        return $this->_db->fetchAll($select);
    }

    public function getTotalCountAtm($params = array()) {
    
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

        if (isset($params['area']) && $params['area'] != '' && substr($params['area'] , 0, 6) != 'Select') {
            $where .= " and  area = '" . $params['area'] . "'";
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
                        ->from('atm_detail',array('total' => new Zend_Db_Expr("count(id)")))
                        ->where($where);

        $select->order($order_by);
        $record =  $this->_db->fetchAll($select);        
        return $record[0]['total'];
    }




   public function saveUser($params = array(),$where = null) {

        if (isset($params['id'])) {
            $params['modified_on'] = date("Y-m-d H:i:s");
            $this->_db->update("user_master", $params, array('id = ?' => (int) $params['id']));
            return $last_insert_id = $params['id'];
        }elseif($where != ''){
            $params['modified_on'] = date("Y-m-d H:i:s");
            return $this->_db->update("user_master", $params, $where);
        }else {
            $this->_db->insert("user_master", $params);
            return $last_insert_id = $this->_db->lastInsertId();
        }
    }
   public function saveLogin($params = array(),$where = null) {

        if (isset($params['id'])) {
            $params['modified_on'] = date("Y-m-d H:i:s");
            $this->_db->update("report_active_users", $params, array('id = ?' => (int) $params['id']));
            return $last_insert_id = $params['id'];
        }else{
            $this->_db->insert("report_active_users", $params);
            return $last_insert_id = $this->_db->lastInsertId();
        }
    }

    

    public function getMembershipCount($params = array()) {
        $order_by = "created_on";
        $where = '1 = 1';
        
        if (isset($params['start_date']) && isset($params['end_date'])) {
            $where .= " and created_on  between '".$params['start_date']."' and '".$params['end_date']."'";
        }
        
        $select = $this->_db->select()
                        ->from('user_membership',array('count'=>new Zend_Db_Expr('count(*)'), 'year'=>new Zend_Db_Expr('date_format(`created_on`,"%y")') , 'Month'=>new Zend_Db_Expr('date_format(`created_on`,"%M")')))
                        ->where($where)
                        ->group('YEAR(`created_on`), MONTH(`created_on`)');
        if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }

        $select->order($order_by);        
        return $this->_db->fetchAll($select);
    }

    public function getMembershipShare($params = array()) {
        $order_by = "member_plan.plan_title";
        $where = '1 = 1';

        if (isset($params['start_date']) && isset($params['end_date'])) {
            $where .= " and user_membership.created_on  between '".$params['start_date']."' and '".$params['end_date']."'";
        }

        $select = $this->_db->select()
                        ->from('user_membership',array('count'=>new Zend_Db_Expr('count(*)')))
                        ->joinleft('member_plan','user_membership.plan_id = member_plan.id',array('plan'=>'plan_title'))
                        ->where($where)
                        ->group('member_plan.plan_title');
        if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }

        $select->order($order_by);        
        return $this->_db->fetchAll($select);
    }

    public function getLoginCount($params = array()) {        
        $order_by = "login_date";
        $where = '1 = 1';

        if (isset($params['start_date']) && isset($params['end_date'])) {
            $where .= " and login_date  between '".$params['start_date']."' and '".$params['end_date']."'";
        }

        $select = $this->_db->select()
                        ->from('report_active_users',array('count'=>new Zend_Db_Expr('count(*)'), 'year'=>new Zend_Db_Expr('date_format(`login_date`,"%y")') , 'Month'=>new Zend_Db_Expr('date_format(`login_date`,"%M")')))
                        ->where($where)
                        ->group('YEAR(`login_date`), MONTH(`login_date`)');
        if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }

        $select->order($order_by);        
        return $this->_db->fetchAll($select);
    }

    public function getCatalogCount($params = array()) {
        $order_by = "catalog_master.created_on";
        $where = '1 = 1';

        if (isset($params['start_date']) && isset($params['end_date'])) {
            $where .= " and  catalog_master.created_on   between '".$params['start_date']."' and '".$params['end_date']."'";
        }

        $select = $this->_db->select()
                        ->from('catalog_master',array('count'=>new Zend_Db_Expr('count(*)'), 'year'=>new Zend_Db_Expr('date_format(`created_on`,"%y")') , 'Month'=>new Zend_Db_Expr('date_format(`created_on`,"%M")')))
                        ->where($where)
                        ->group('YEAR(`created_on`), MONTH(`created_on`)');
        if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }

        $select->order($order_by);
        return $this->_db->fetchAll($select);
    }
    
    public function getMetaValues($params = array()) {
    	$order_by = "id  asc";
    	$where =  " page_url = '" . $params['page_url'] . "'";
    
    	if (isset($params['order_by']) && $params['order_by'] != '') {
    		$order_by = $params['order_by'];
    	}
    	if (isset($params['id'])) {
    		$where .= ' and id=' . $params['id'];
    	}
    
    	$select = $this->_db->select()
    	->from('meta_tag')
    	->where($where);
    	return $this->_db->fetchAll($select);
    }
    
    public function getallMetaValues($params = array()) {
    	$order_by = "id  asc";
    	$where = '1 = 1';
    	 
    
    	if (isset($params['order_by']) && $params['order_by'] != '') {
    		$order_by = $params['order_by'];
    	}
    	if (isset($params['id'])) {
    		$where .= ' and id=' . $params['id'];
    	}
    
    	$select = $this->_db->select()
    	->from('meta_tag')
    	->where($where);
    	return $this->_db->fetchAll($select);
    }
    
    
    public function saveMetaValues($params = array(),$where = null) {
    	 
    	$where = '1 = 1';
    	$select = $this->_db->select()
    	->from('meta_tag',array('page_url'))
    	->where($where)
    	->group('page_url');
    	$url = $this->_db->fetchAll($select);
    	$tempurl = array();
    	foreach($url as $urlkey => $urlvalue)
    	{
    		$tempurl[] = $urlvalue['page_url'];
    	}
    	$needle = $params['page_url'];
    
    	if(in_array($needle,$tempurl)) {
    		$this->_db->update("meta_tag", $params, array('page_url = ?' =>  $params['page_url']));
    		return $last_insert_id = $params['page_url'];
    	}else {
    		$this->_db->insert("meta_tag", $params);
    		return $last_insert_id = $this->_db->lastInsertId();
    	}
    }
    
    
}