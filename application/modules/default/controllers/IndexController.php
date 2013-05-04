<?php

class IndexController extends App_Controller_BaseController {

    public function init() {
        parent::init();
        $this->Model = new Default_Model_Default();
    }

    public function indexAction()
    {
    	
        $this->Model = new Default_Model_Default();
        $this->view->SectionHeading = "Dashboard";
        $this->view->BankNames = $this->Model->GetBankNames();
        $this->view->navId = 'home';
        $this->view->States = $this->Model->GetStatesNames();
        
        $objRequest = $this->getRequest();
        $action = $objRequest->getparam('actionName');
        $this->view->action = $action;
        
        $url['page_url'] = "/";
        $result = $this->Model -> getMetaValues($url);
        $this->view->Detail = $result[0];
        
       
    }
    
    public function cityAction()
    {
    	$this->view->PageHead = "searchbycity";
    	$this->Model = new Default_Model_Default();
    	$this->view->SectionHeading = "Dashboard";
    	$this->view->BankNames = $this->Model->GetBankNames();
    	$this->view->navId = 'city';
    	$this->view->States = $this->Model->GetStatesNames();
    	
    	$url['page_url'] = "/searchbycity";
    	$result = $this->Model -> getMetaValues($url);
    	$this->view->Detail = $result[0];
    }
    public function ifscAction()
    {
    	$this->view->PageHead = "ifsccode";
    	$this->Model = new Default_Model_Default();
    	$this->view->SectionHeading = "Dashboard";
    	$this->view->BankNames = $this->Model->GetBankNames();
    	$this->view->navId = 'ifsc';
    	$this->view->States = $this->Model->GetStatesNames();
    	
    	$url['page_url'] = "/ifsc";
    	$result = $this->Model -> getMetaValues($url);
    	$this->view->Detail = $result[0];
    	
    }
    
    public function micrAction()
    {
    	$this->view->PageHead = "micrcode";
    	$this->Model = new Default_Model_Default();
    	$this->view->SectionHeading = "Dashboard";
    	$this->view->BankNames = $this->Model->GetBankNames();
    	$this->view->navId = 'micr';
    	$this->view->States = $this->Model->GetStatesNames();
    	
    	$url['page_url'] = "/micr";
    	$result = $this->Model -> getMetaValues($url);
    	$this->view->Detail = $result[0];
    }
    

    public function getstatejsonAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getstatejson($params);
    }
    
    public function getdistrictjsonAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getdistrictjson($params);
    }

    public function getbranchjsonAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getbranchjson($params);
    }

    public function getcityjsonAction() {
        $this->_helper->acl->allow(null);
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $objRequest = $this->getRequest();
        if ($objRequest->isGet()) {
            $params = $this->getRequest()->getParams();
        }
        return $this->Model->getcityjson($params);
    }

    public function searchAction() {
    	
    	
    	
        $this->view->PageHead = "Search";
        $objRequest = $this->getRequest();
        $Params = $objRequest->getParams();
        
        $referer = $objRequest->getHeader('referer');

        if($referer == $this->constant->HOSTPATH."searchbycity")
        {
        	$Params['city_name'] = $Params['district_name'];
        	$Params['district_name'] = "";
        }	
        elseif ($referer == $this->constant->HOSTPATH)
        {
        	
        	$states = $this->Model->GetStatesNames();
        	
        	$tempStates = array();
        	
        	foreach($states as $statekey => $statevalue)
        	{
        		$tempStates[] = strtolower($statevalue['state']);
        	}	
        	$needle = str_replace("_", " ",$Params['bank_name']);
        	
        	if(in_array(strtolower($needle),$tempStates))
        	{
        		$Params['state_name'] = $Params['bank_name'];
        		$Params['bank_name'] = "";
        	}
        }
        
        elseif ($referer == $this->constant->HOSTPATH."sitemap")
        {
        	 
        	$states = $this->Model->GetStatesNames();
        	 
        	$tempStates = array();
        	 
        	foreach($states as $statekey => $statevalue)
        	{
        		$tempStates[] = strtolower($statevalue['state']);
        	}
        	$needle = str_replace("_", " ",$Params['bank_name']);
        	 
        	if(in_array(strtolower($needle),$tempStates))
        	{
        		$Params['state_name'] = $Params['bank_name'];
        		$Params['bank_name'] = "";
        	}
        }
        
        elseif ($referer == $this->constant->HOSTPATH."sitemap")
        {
        
        	$city = $this->Model->GetCityNames();
        
        	$tempcity = array();
        
        	foreach($city as $citykey => $cityvalue)
        	{
        		$tempcity[] = strtolower($cityvalue['city']);
        	}
        	$needle = str_replace("_", " ",$Params['bank_name']);
        
        	if(in_array(strtolower($needle),$tempcity))
        	{
        		$Params['city_name'] = $Params['bank_name'];
        		$Params['bank_name'] = "";
        	}
        }
        
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
        
        
        
        $this->view->params = $Params;
        $total_pages = $this->Model->getTotalCount($Params);
        $adjacents = 3;
       
        
        unset($Params['module']);
        unset($Params['controller']);
        unset($Params['action']);
        $paramcount = count($Params);
        if($paramcount <= 0)
        {
        	$this->_redirect('/');
        }
        if ($objRequest->isGet()) {
            $page = 2;
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

        $this->view->Records = $this->Model->getBankValues($Params);

        $this->view->BankName = '';
        if (isset($Params['bank_name']) && $Params['bank_name'] != '' && substr($Params['bank_name'] , 0, 6) != 'Select') {
            $this->view->BankName = $Params['bank_name'];
        }
    }
    
    public function searchmicrAction() {
    	
    	$this->view->PageHead = "micrSearch";
    	$objRequest = $this->getRequest();
    	$Params = $objRequest->getParams();
    	
    	
    	//$input=$Params->bank_name;
    	//$Params->bank_name= str_replace('_', ' ', $input);
    	
    	$this->view->params = $Params;
    	$total_pages = $this->Model->getTotalCount($Params);
    	$adjacents = 3;
    	$Params['limitPage'] = 1;
    
    	unset($Params['module']);
    	unset($Params['controller']);
    	unset($Params['action']);
    	$paramcount = count($Params);
    	if($paramcount <= 0)
    	{
    		$this->_redirect('/');
    	}
    	if ($objRequest->isGet()) {
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
    
    	$this->view->Records = $this->Model->getBankValues($Params);
    	$this->view->BankName = '';
    	if (isset($Params['bank_name']) && $Params['bank_name'] != '' && substr($Params['bank_name'] , 0, 6) != 'Select') {
    		$this->view->BankName = $Params['bank_name'];
    	}
    	
    	//set the meta tags for this page
    	$micr = $this->Model->getBankValues($Params);
    	$row = $micr[0];
        $code = $row['micr_code']; 
        $city = $row['city'];   
    	$title['keywords'] = "MICR Code: $code,$city, Bank MICR codes, List of MICR codes";
    	$title['description'] = "MICR Code:$code,$city. We help you find MICR Codes $code, Address $city, for NEFT, RTGS, ECS Transactions.";
    	$title['title'] ="MICR Code $code,$city" ;
    	
    	$this->view->Detail = $title;
    		
    }
    
    public function searchifscAction() {
    	
    	$this->view->PageHead = "ifscSearch";
    	$objRequest = $this->getRequest();
    	$Params = $objRequest->getParams();
    	$this->view->params = $Params;
    	$total_pages = $this->Model->getTotalCount($Params);
    	$adjacents = 3;
    	$Params['limitPage'] = 1;
    	unset($Params['module']);
    	unset($Params['controller']);
    	unset($Params['action']);
    	$paramcount = count($Params);
    	if($paramcount <= 0)
    	{
    		$this->_redirect('/');
    	}
    	if ($objRequest->isGet()) {
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
    
    	$this->view->Records = $this->Model->getBankValues($Params);
    
    	$this->view->BankName = '';
    	if (isset($Params['bank_name']) && $Params['bank_name'] != '' && substr($Params['bank_name'] , 0, 6) != 'Select') {
    		$this->view->BankName = $Params['bank_name'];
    	}
    	
    	//set the meta tags for this page
    	$ifsc = $this->Model->getBankValues($Params);
    	$row = $ifsc[0];
    	$code = $row['ifsc_code'];
    	$city = $row['city'];
    	$title['keywords'] = "IFSC Code: $code,$city, Bank IFSC codes, List of IFSC codes";
    	$title['description'] = "IFSC Code:$code,$city. We help you find IFSC Codes $code, Address $city, MICR,NEFT, RTGS, ECS Transactions.";
    	$title['title'] ="IFSC Code $code,$city" ;
    	 
    	$this->view->Detail = $title;
    	
    	
    }

    public function detailAction() {
        $this->view->PageHead = "Branch Detail";
        $objRequest = $this->getRequest();
        $id = $objRequest->getParam('id');
        $id = explode('_', $id);
        $records = $this->Model->getBankValues(array('id'=> $id[0]));
        $this->view->Records = $records[0];

    }
    
    public function ifscdetailAction() {
    	$this->view->PageHead = "Branch Detail";
    	$objRequest = $this->getRequest();
    	$id = $objRequest->getParam('id');
    	$id = explode('_', $id);
    	$records = $this->Model->getBankValues(array('id'=> $id[0]));
    	$this->view->Records = $records[0];
    	
    	//set the meta tags for this page
    	$row = $records[0];
    	$code = $row['ifsc_code'];
    	$city = $row['city'];
    	$title['keywords'] = "IFSC Code: $code,$city, Bank IFSC codes, List of IFSC codes";
    	$title['description'] = "IFSC Code:$code,$city. We help you find IFSC Codes $code, Address $city, MICR,NEFT, RTGS, ECS Transactions.";
    	$title['title'] ="IFSC Code $code,$city" ;
    	
    	$this->view->Detail = $title;
    
    }
    
    public function micrdetailAction() {
    	$this->view->PageHead = "Branch Detail";
    	$objRequest = $this->getRequest();
    	$id = $objRequest->getParam('id');
    	$id = explode('_', $id);
    	$records = $this->Model->getBankValues(array('id'=> $id[0]));
    	$this->view->Records = $records[0];
    	
    	//set the meta tags for this page	
    	$row = $records[0];
    	$code = $row['micr_code'];
    	$city = $row['city'];
    	$title['keywords'] = "MICR Code: $code,$city, Bank MICR codes, List of MICR codes";
    	$title['description'] = "MICR Code:$code,$city. We help you find MICR Codes $code, Address $city, for NEFT, RTGS, ECS Transactions.";
    	$title['title'] ="MICR Code $code,$city" ;
    	 
    	$this->view->Detail = $title;
    	 }
    	 
    	 public function sitemapAction() {
    	 	$this->Model = new Default_Model_Default();
    	 	$this->viw->Model = $this->Model;
    	 	
    	 	$state = $this->Model->GetStatesNames();
    	 	$i = 0;
    	 	$numRows = count($state);
    	 	$this->view->rowcount = $numRows;
    	 	 	foreach($state as $key=>$value)
    	 	{
   	 		if($i<$numRows)
     	 		{
    	 		$result = $this->Model->getallcity($value['state']);
    	 		$this->view->result = $this->Model->getallcity($value['state']);
    	 		
     	 			$res = $state[$i];
     	 			 echo '<div style="clear:both" class="sitemap_heading"><a  href="javascript:getval(\''.$res['state'].'\')">'.$res['state'].'</a></div>';
    	 			
     	 		foreach($result as $key=>$value)
     	 		{
    	 			
     	 			//echo $value['city'];
     	 			echo '<div class="sitemap_div"><li class="sitemap_li"><a  href="javascript:getvals(\''.$value['city'].'\')">'.$value['city'].'</a></li></div>';
    	 			
    	 			
     	 		}
     	 		
     	 		$i++;
     	 		}
    	 		
    	 	}
    	 	
    	 	
    	 	$this->view->BankNames = $this->Model->GetBankNames();
    	 	$this->view->States = $this->Model->GetStatesNames();
    	 	
    	 }
    
    
}