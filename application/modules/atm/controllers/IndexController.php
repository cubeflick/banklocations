<?php

class Atm_IndexController extends App_Controller_Modules_Content_ContentbaseController {

    public function init() {
        parent::init();
        $this->view->navId = 'atm';
        $this->Model = new Atm_Model_Atm();        
    }

    public function indexAction() {
      $this->Model = new Atm_Model_Atm();
        $this->view->SectionHeading = "Dashboard";
        $this->view->BankNames = $this->Model->GetAtmNames(); 
        $this->view->States = $this->Model->GetStateNames();
        
        
        $url['page_url'] = "/atm";
        $result = $this->Model -> getMetaValues($url);
        $this->view->Detail = $result[0];
    }

    public function getstatejsonatmAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getstatejsonatm($params);
    }
    
    public function getdistrictjsonatmAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getdistrictjsonatm($params);
    }

    public function getbranchjsonatmAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getbranchjsonatm($params);
    }

    public function getcityjsonatmAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getcityjsonatm($params);
    }

    public function searchAction() {
        $this->view->PageHead = "Search";
        $objRequest = $this->getRequest();
        $Params = $objRequest->getParams();  
              
        $this->view->params = $Params;
        $total_pages = $this->Model->getTotalCountAtm($Params);
        $adjacents = 3;
        if ($objRequest->isGet()) {
        	$Params['limitPage'] = '0';
            $page = $Params['limitPage'];
        } else {
            $page = 1;

        }
        $limit = 10;
        if ($page)
            $start = ($page - 1) * $limit;
        else
            $start = 0;

        if ($page == 0){
            $page = 1;
        }
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($total_pages / $limit);
        $lpm1 = $lastpage - 1;

        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<div class=\"pagination\">";
            if ($page > 1)
                $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$prev')\">< previous</a>";
            else
                $pagination.= "<span class=\"disabled\">< previous</span>";

            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$counter')\">$counter</a>";
                }
            }
            elseif ($lastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$counter')\">$counter</a>";
                    }
                    $pagination.= "<span class=\"dots\">...</span>";
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$lpm1')\">$lpm1</a>";
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$lastpage')\">$lastpage</a>";
                }
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('1')\">1</a>";
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('2')\">2</a>";
                    $pagination.= "<span class=\"dots\">...</span>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$counter')\">$counter</a>";
                    }
                    $pagination.= "<span class=\"dots\">...</span>";
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$lpm1')\">$lpm1</a>";
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$lastpage')\">$lastpage</a>";
                }
                else {
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('1')\">1</a>";
                    $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('2')\">2</a>";
                    $pagination.= "<span class=\"dots\">...</span>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$counter')\">$counter</a>";
                    }
                }
            }

            if ($page < $counter - 1)
                $pagination.= "<a href=\"javascript:void(0)\" onclick=\"setPage('$next')\">next ></a>";
            else
                $pagination.= "<span class=\"disabled\">next ></span>";
            $pagination.= "</div>\n";
        }
        
        $this->view->pagination = $pagination;
        
        if(array_key_exists('bank_name', $Params))
        {
        	$Params['bank_name'] = strtolower(str_replace("_"," ",$Params['bank_name']));
        }
        if(array_key_exists('state_name', $Params))
        {
        	$Params['state_name'] = strtolower(str_replace("_"," ",$Params['state_name']));
        }
        if(array_key_exists('district_name', $Params))
        {
        	$Params['district_name'] = strtolower(str_replace("_"," ",$Params['district_name']));
        }
        if(array_key_exists('city_name', $Params))
        {
        	$Params['city_name'] = strtolower(str_replace("_"," ",$Params['city_name']));
        }
        

        $this->view->Records = $this->Model->getValuesAtm($Params);

        $this->view->BankName = '';
        if (isset($Params['bank_name']) && $Params['bank_name'] != '' && substr($Params['bank_name'] , 0, 6) != 'Select') {
            $this->view->BankName = $Params['bank_name'];
        }
        
        //set the meta tags for this page
        $val = $this->Model->getValuesAtm($Params);
        $row = $val[0];
       $city = $row['city'];
        $bank = $row['bank_name'];
       
        $title['description'] = "Here you can find list of $bank, $city - ATM. We took utmost care to 
        		collect and provide most updated list of <bank name> ATM's in $city listed.";
        $title['title'] ="$bank ATM List in $city, $bank ATM Locator $city  " ;
         
        $this->view->Detail = $title;
        
        
        
    }

    public function detailAction() {
        $this->view->PageHead = "Branch Detail";
        $objRequest = $this->getRequest();
        $id = $objRequest->getParam('id');
        $id = $objRequest->getParam('id');
        $id = explode('_', $id);
        $records = $this->Model->getValuesAtm(array('id'=> $id[0]));
        $this->view->Records = $records[0];
        
        
        $row = $records[0];
        $city = $row['city'];
        $bank = $row['bank_name'];
        
        $title['description'] = "Here you can find list of $bank, $city - ATM. We took utmost care to
        collect and provide most updated list of <bank name> ATM's in $city listed.";
        $title['title'] ="$bank ATM in $city, $bank ATM Near $city, $bank ATM Centre In $city" ;
         
        $this->view->Detail = $title;

    }
}