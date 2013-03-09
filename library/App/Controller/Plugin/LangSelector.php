<?php
/**
 * Description of LangSelector
 *
 * @author Vivek
 */
class App_Controller_Plugin_LangSelector
    extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
	$lang = $request->getParam('lang','');
	        
	if ($lang !== 'en' && $lang !== 'it'){
            if(isset($_COOKIE["lang"])){
                $request->setParam('lang',$_COOKIE["lang"]);
            }else{
                $request->setParam('lang','en');
            }
	    
        }
	$lang = $request->getParam('lang');
	if ($lang == 'en')
	    $locale = 'en';
	else
	    $locale = 'it_IT';

	$zl = new Zend_Locale();
	$zl->setLocale($locale);
	Zend_Registry::set('Zend_Locale', $zl);
	
	$translate = new Zend_Translate('csv', APPLICATION_PATH . '/configs/lang/'. $lang . '.csv' , $lang);
	Zend_Registry::set('Zend_Translate', $translate);        
    }

}