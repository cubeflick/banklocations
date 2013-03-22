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
        
        
    }
    
    public function cityAction()
    {
    	$this->Model = new Default_Model_Default();
    	$this->view->SectionHeading = "Dashboard";
    	$this->view->BankNames = $this->Model->GetBankNames();
    	$this->view->navId = 'city';
    	$this->view->States = $this->Model->GetStatesNames();
    }
    public function ifscAction()
    {
    	$this->Model = new Default_Model_Default();
    	$this->view->SectionHeading = "Dashboard";
    	$this->view->BankNames = $this->Model->GetBankNames();
    	$this->view->navId = 'ifsc';
    	$this->view->States = $this->Model->GetStatesNames();
    }
    
    public function micrAction()
    {
    	$this->Model = new Default_Model_Default();
    	$this->view->SectionHeading = "Dashboard";
    	$this->view->BankNames = $this->Model->GetBankNames();
    	$this->view->navId = 'micr';
    	$this->view->States = $this->Model->GetStatesNames();
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
    }
    
    public function searchmicrAction() {
    	$this->view->PageHead = "Search";
    	$objRequest = $this->getRequest();
    	$Params = $objRequest->getParams();
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
    }
    
    public function searchifscAction() {
    	$this->view->PageHead = "Search";
    	$objRequest = $this->getRequest();
    	$Params = $objRequest->getParams();
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
    }

    public function detailAction() {
        $this->view->PageHead = "Branch Detail";
        $objRequest = $this->getRequest();
        $id = $objRequest->getParam('id');
        $id = explode('_', $id);
        $records = $this->Model->getBankValues(array('id'=> $id[0]));
        $this->view->Records = $records[0];

    }
}