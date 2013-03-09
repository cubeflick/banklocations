<?php

class User_Model_User extends App_Model_BaseModel {

    public function getValues($params = array()) {
        $order_by = "id desc";
        $where = "user_master.role <> 'admin' ";
        if (isset($params['order_by']) && $params['order_by'] != '') {
            $order_by = $params['order_by'];
        }
        if (isset($params['id'])) {
            $where .= ' and id=' . $params['id'];
        }
        if (isset($params['is_deleted'])) {
            $where .= " and is_deleted= '" . $params['is_deleted'] . "'";
        }
        if (isset($params['name'])) {
            $where .= " and ( first_name LIKE '%".$params['name']."%' OR last_name LIKE '%".$params['name']."%' )";
        }
        if (isset($params['is_active'])) {
            $where .= " and is_active= '" . $params['is_active'] . "'";
        }

        $select = $this->_db->select()
                        ->from('user_master')
                        ->where($where);
        if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }

        $select->order($order_by);
        return $this->_db->fetchAll($select);
    }

    public function getUsers($params = array()) {
        $order_by = "id desc";
        $where = "user_master.role <> 'admin' ";
        if (isset($params['order_by']) && $params['order_by'] != '') {
            $order_by = $params['order_by'];
        }
        if (isset($params['id'])) {
            $where .= ' and id=' . $params['id'];
        }
        if (isset($params['is_deleted'])) {
            $where .= " and is_deleted= '" . $params['is_deleted'] . "'";
        }
        if (isset($params['name'])) {            
            $params['name'] = trim($params['name']);
            if(str_word_count($params['name']) > 1){
                $nameParams = explode(' ', $params['name']);                
                foreach($nameParams as $key=>$value){
                    $where .= " and ( first_name LIKE '%".$value."%' OR last_name LIKE '%".$value."%' )";
                }
            }else{
                $where .= " and ( first_name LIKE '%".$params['name']."%' OR last_name LIKE '%".$params['name']."%' )";
            }
            
        }
        if (isset($params['is_active'])) {
            $where .= " and is_active= '" . $params['is_active'] . "'";
        }

        $select = $this->_db->select()
                        ->from('user_master',array('id'=>'id','label'=>new Zend_Db_Expr("CONCAT(first_name, ' ', last_name)"),'value'=>new Zend_Db_Expr("CONCAT(first_name, ' ', last_name)")))
                        ->where($where);
        if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }

        $select->order($order_by);
        return $this->_db->fetchAll($select);
    }

    public function saveValues($params = array()) {
        
        if (isset($params['id'])) {
            $params['modified_on'] = date("Y-m-d H:i:s");
            $this->_db->update("user_master", $params, array('id = ?' => (int) $params['id']));
            return $last_insert_id = $params['id'];
        } else {
            $this->_db->insert("user_master", $params);
            return $last_insert_id = $this->_db->lastInsertId();
        }
    }
    
    public function getAllValues($params = array()) {
        $order_by = "user_master.id";
        $where = "user_master.role <> 'admin' ";

        if (isset($params['id'])) {
            $where .= ' and id=' . $params['id'];
        }
        
        if (isset($params['order_by']) && $params['order_by'] != '') {
            $order_by = 'user_master.'.$params['order_by'];
        }
        $select = $this->_db->select()
                        ->from('user_master')
                        ->where($where)
                        ->group('user_master.id');
        if (isset($params['limit'])) {
            $select->limit($params['limit']);
        }
        $select->order($order_by);
        return $this->_db->fetchAll($select);
    }

    public function getAllXml($params = array()) {

        $data = $this->getAllValues($params);
        $xml = '';
        $xml .= "<rows>";
        foreach ($data as $row) {
            $id = $this->alphaID($row['id']);

            $xml .="<row id='" . $id . "' >";
            $xml .="<cell>" . $row['first_name'] .' '. $row['middle_name'].' '.$row['last_name']. "</cell>";
            $xml .="<cell>" . $row['email'] . "</cell>";
            $xml .="<cell>" . $row['role'] . "</cell>";

            $xml .="<cell><![CDATA[<a href='javascript:void(\"$id\")'
            onclick='editAction(\"$id\")'>
            <img src='" . $this->constant->ICONPATH . "/edit-icon.png' id='img2'>
                </a>]]></cell>";

            if ($row['is_deleted'] == 1) {
                $xml .= "<cell><![CDATA[<a href='javascript:void(\"$id\")'
            onclick='undelete(\"$id\",\"0\")'>
            <img src='" . $this->constant->ICONPATH . "/undelete.png'
                id='img2'></a>]]></cell>";
            } else {
                $xml .="<cell><![CDATA[<a href='javascript:void(\"$id\")'
            onclick='deleteAction(\"$id\")'>
            <img src='" . $this->constant->ICONPATH . "/delete-icon.png' id='img2'>
                </a>]]></cell>";
            }
            $xml .="</row>";
        }
        $xml .="</rows>";
        header("content-type: text/xml");
        echo $xml;
        exit();
    }

    public function searchUseActivities($params = array()) {
        $where = "activity_master.user_id = '".$params['user_id']."'";
        $select = $this->_db->select();
        $select->from('activity_master',array('type'=>'type','activity_date'=> 'created_on','date' => new Zend_Db_Expr("DATE_FORMAT( activity_master.created_on , '%M %e, %Y <span>| %h:%i %p</span>' )")));
        $select->joinleft(array('catalog_master'=>'catalog_master'), 'catalog_master.id = activity_master.content_id', array('catalog_enc_id' => 'enc_id','catalog_title'=>'title'));
        $select->joinleft(array('portfolio_master'=>'portfolio_master'), 'portfolio_master.id = activity_master.content_id', array('portfolio_id' => 'id'));

        $select->where($where);
        if (isset($params['limitPage'])) {
            $select->limitPage($params['limitPage'], 10);
        } else {
            $select->limitPage(1, 10);
        }
        $select->order('activity_master.created_on desc');

        return $this->_db->fetchAll($select);
    }
}

?>
