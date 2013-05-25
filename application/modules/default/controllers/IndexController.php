<?php

class IndexController extends App_Controller_BaseController {

    public function init() {
        parent::init();
        $this->Model = new Default_Model_Default();
        $this->_helper->ajaxContext->addActionContext('search', 'html')
        ->initContext();
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
        	$Params['city_name'] = str_replace("_", " ",$Params['state_name']);
        	$Params['state_name'] = str_replace("_", " ",$Params['bank_name']);
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
        
        $records = $this->Model->getBankValues($Params);
        
        /*
         * Place the pagination
         */
        $paginator = Zend_Paginator::factory($records);
        $paginator->setCurrentPageNumber($this->getRequest()->getParam('page', 1));
        $paginator->setPageRange(10);
        $paginator->setItemCountPerPage(100);
        $this->view->paginator = $paginator;
        
        $this->view->host = $this->constant->HOSTPATH;

        
        $this->view->Records = $records;
        $this->view->BankName = '';
        if (isset($Params['bank_name']) && $Params['bank_name'] != '' && substr($Params['bank_name'] , 0, 6) != 'Select') {
            $this->view->BankName = $Params['bank_name'];
        }
        
        if(($Params['bank_name'] !="") && ($Params['state_name'] !="") && ($Params['district_name'] !="") &&
        		($Params['city_name'] !="") )
        {
			$title['title'] = $records[0]['bank_name'].": ".$records['0']['branch_name']."- Branch Details & Contact Numbers of " .$records[0]['bank_name']."," .$records[0]['branch_name'];        	 
			$title['description'] = "Here you can find ".$records[0]['bank_name']. " branch details & contact numbers of ".$records[0]['branch_name']. " NEFT, RTGS, ESC";

			
			$this->view->Detail = $title;        	
        }
        
       $title['title'] = $records[0]['bank_name'].": ".$records['0']['branch_name']."- Branch Details & Contact Numbers of " .$records[0]['bank_name']."," .$records[0]['branch_name'];
        $title['description'] = "Here you can find ".$records[0]['bank_name']. " branch details & contact numbers of ".$records[0]['branch_name']. " NEFT, RTGS, ESC";
        
        	
        $this->view->Detail = $title;
        
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
    	if($micr)
    	{
    	$row = $micr[0];
        $code = $row['micr_code']; 
       
    	$city = $row['city'];
    	$branch = $row['branch_name'];
    	$bank = $row['bank_name'];
    	$title['keywords'] = "MICR Code: $code,$city, Bank MICR codes, List of MICR codes";
    	$title['description'] = " Here you can find list of $bank, $branch - $code. We tried to provide $bank contact details, address and IFSC code";
    	$title['title'] ="MICR Code $code of $bank,$branch,$city " ;
    	
    	$this->view->Detail = $title;
    	}
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
    	if($ifsc)
    	{
    	$row = $ifsc[0];
    	$code = $row['ifsc_code'];
    	$city = $row['city'];
    	$branch = $row['branch_name'];
    	$bank = $row['bank_name'];
    	$title['keywords'] = "IFSC Code: $code,$city, Bank IFSC codes, List of IFSC codes";
    	$title['description'] = " Here you can find list of $bank, $branch - $code. We tried to provide $bank contact details, address and MICR code";
    	$title['title'] ="IFSC Code $code of $bank,$branch,$city " ;
    	 
    	$this->view->Detail = $title;
    	}
    	
    }

    public function detailAction() {
        $this->view->PageHead = "Branch Detail";
        $objRequest = $this->getRequest();
        $id = $objRequest->getParam('id');
        $id = explode('_', $id);
        $records = $this->Model->getBankValues(array('id'=> $id[0]));
        $this->view->Records = $records[0];

        $title['title'] = $records[0]['bank_name'].": ".$records['0']['branch_name']."- Branch Address & Contact Address of " .$records[0]['bank_name']."," .$records[0]['branch_name'];        	 
			$title['description'] = "Here you can find ".$records[0]['bank_name']. " branch address & contact address of ".$records[0]['branch_name']. " NEFT, RTGS, ESC";;

        $this->view->Detail = $title;
         
        
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
    	$branch = $row['branch_name'];
    	$bank = $row['bank_name'];
    	$title['keywords'] = "IFSC Code: $code,$city, Bank IFSC codes, List of IFSC codes";
    	$title['description'] = " Here you can find list of $bank, $branch - $code. We tried to provide $bank contact details, address and MICR code";
    	$title['title'] ="IFSC Code $code of $bank,$branch,$city " ;
    	
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
    	$branch = $row['branch_name'];
    	$bank = $row['bank_name'];
    	$title['keywords'] = "MICR Code: $code,$city, Bank IFSC codes, List of MICR codes";
    	$title['description'] = " Here you can find list of $bank, $branch - $code. We tried to provide $bank contact details, address and IFSC code";
    	$title['title'] ="MICR Code $code of $bank,$branch,$city " ;
    	 
    	$this->view->Detail = $title;
    	
    	 }
    	 
    	 public function sitemapAction() {
    	 	
    	 	$this->Model = new Default_Model_Default();
    	 	$this->viw->Model = $this->Model;
    	 	$this->view->BankNames = $this->Model->GetBankNames();
    	 	$this->view->States = $this->Model->GetStatesNamesAndCity();
    	 	
    	 }
    
    
}