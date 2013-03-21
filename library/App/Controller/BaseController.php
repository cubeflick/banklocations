<?php

class App_Controller_BaseController extends Zend_Controller_Action {

    /**
     * This variable defines the zend filters object to be used as standard throughout the project
     */
    public $filters = array();
    /**
     * This variable defines the zend validators object to be used as standard throughout the project
     */
    public $validators = array();
    /**
     * This variable defines the namespace to be used for storing user session data to be used as standard throughout the project
     */
    public $namespace = 'userNamespace';
    /**
     * This variable will define the mail object for sending mails
     */
    public $mail = null;
    /**
     * This variable will contain session values for user.
     */
    public $userSession = '';
    /**
     * This variable will contain session values for sql stmt trace.
     */
    public $errorSession = '';
    /**
     * This variable will contain the ACL object of user permissions.
     */
    public $ACL = '';
    
    /**
     * This variable will define the FlashMessenger helper object
     */
    public $flashMsg = null;
    /**
     * This is the handler to write application logs.
     */
    public $logger;

    /**
     * This function will exceute on every request before any other action.
     *
     * @param
     *
     * @return
     */
    public function init() {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
            session_unset();
            session_destroy();
        }
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

        Zend_Controller_Action_HelperBroker::addPath('../library/Icpl/Helpers/Action', 'My_Action_Helper');

        Zend_Layout::startMvc(APPLICATION_PATH . '/layouts/scripts');
        $view = Zend_Layout::getMvcInstance()->getView();
        $view->setHelperPath('../library/App/View/Helper', 'My_View_Helper');
        $passKey = 'sandysoftwaredeveloper';
        /**
         * Declaring frmMsg variable to be used as standard variable for form messages throughout the application.
         */
        $this->view->frmMsg = '';

        /**
         * Declaring frmMsg variable to be used as standard variable for form messages throughout the application.
         */
        $this->view->frmMsgEncode = '';

        /**
         * Declaring frmMsg variable to be used as standard variable for form messages throughout the application.
         */
        $this->view->errMsg = '';
        /**
         * Declaring frmMsg variable to be used as standard variable for form messages throughout the application.
         */
        $this->view->errMsgEncode = '';

        $this->view->SectionHeading = '';

        $this->view->moduleName = $this->moduleName = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
        $this->view->controllerName = $this->controllerName = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
        $this->view->actionName = $this->actionName = Zend_Controller_Front::getInstance()->getRequest()->getActionName();

        $this->filters[2] = new Zend_Filter_StripTags(array('<p>', '<span>', '<div>', '<ul>', '<li>', '<ol>', '<br>', '<br/>', '<b>', '<strong>', '<em>', '<table>', '<td>', '<tr>', '<s>', '<strike>'));
        $this->view->constant = $this->constant = new Zend_Config_Ini(APPLICATION_PATH . '/configs/constants.ini', 'site', true);

        $this->flashMsg = $this->_helper->FlashMessenger;
        $this->flashMsg->setNamespace('FlashMessage');

        $flashMessenger = $this->_helper->FlashMessenger;
        $flashMessenger->setNamespace('actionErrors');
        $this->view->actionErrors = $flashMessenger->getMessages();

        $this->errorSession = new Zend_Session_Namespace('errorNamespace');
        $this->errorSession->trace = array();

        $userSession = new Zend_Session_Namespace($this->namespace);
        $this->userSession = $userSession->storage;

        $this->view->userSession = $this->userSession;

        $UserNamespace = new Zend_Session_Namespace('UserNamespace');        
        $this->_auth = Zend_Auth::getInstance();
        
        
        $escObj = new App_Plugins_Escape();
        $this->view->setEscape(array($escObj, 'NewEscape'));
        $this->view->PageHead = "Home";
        
        /**
         * This function is used to fetch the scripts saved in database for google adds
         */
        $this->ModelDefault = new Default_Model_Default();
        $result = $this->ModelDefault -> getValues();
        $this->view->GoogleAddScript = $result[0];
        
    }

    /**
     * This function is used to fetch global constants from constant.ini file
     *
     * @param string $sect_name This parameter is used to specify section in constant.ini file from which constants are to fetched
     *
     * @return array This function will return constants in array (key => value) format
     */
    public function getConstants($sect_name='') {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/constants.ini', $sect_name, true);
        return $config->toArray();
    }

    /**
     * This function is used to fetch error messages from error.ini file of a defined module
     *
     * @param string $module_name This parameter is used to specify module from where error.ini is to be fetched.
     * @param string $sect_name This parameter is used to specify section in error.ini file from which error messages are to fetched.
     *
     * @return array This function will return error messages in array (key => value) format
     */
    protected function errorMessage($module_name, $sect_name) {
        if ($module_name != '' && $sect_name != '') {
            $config_common = new Zend_Config_Ini(APPLICATION_PATH . '/modules/' . strtolower($module_name) . '/configs/error.ini', 'Common', true);
            $config = new Zend_Config_Ini(APPLICATION_PATH . '/modules/' . strtolower($module_name) . '/configs/error.ini', $sect_name, true);
            return array_merge($config_common->toArray(), $config->toArray());
        }
    }

    /**
     * This function is used to fetch form messages from form_message.ini file of a defined module
     *
     * @param string $module_name This parameter is used to specify module from where form_message.ini is to be fetched.
     * @param string $sect_name This parameter is used to specify section in form_message.ini file from which form messages are to fetched
     *
     * @return array This function will return form messages in array (key => value) format
     */
    protected function formMessage($module_name, $sect_name) {
        if ($module_name != '' && $sect_name != '') {
            $config_common = new Zend_Config_Ini(APPLICATION_PATH . '/modules/' . strtolower($module_name) . '/configs/form_messages.ini', 'Common', true);
            $config = new Zend_Config_Ini(APPLICATION_PATH . '/modules/' . strtolower($module_name) . '/configs/form_messages.ini', $sect_name, true);
            return array_merge($config_common->toArray(), $config->toArray());
        }
    }

    /**
     * This function is used to fetch errors generated by zend validator on form submission
     *
     * @param array $errors This parameter defines the error thrown by zend validator for submitted form fields in array format
     *
     * @return string This function returns errors in formatted text.
     */
    public function getValidatorErrors($errors = array()) {
        $strErrors = '';
        if (!empty($errors)) {
            foreach ($errors as $error) {
                if (is_array($error)) {
                    foreach ($error as $val) {
                        if (!empty($val))
                            $strErrors .= $val . '<br/>';
                    }
                }
                else {
                    if (!empty($error))
                        $strErrors .= $error . '<br/>';
                }
            }
        }
        return $strErrors;
    }

    /**
     * This function is used to initialize page and error messages for specified section to their variables.
     *
     * @param
     *
     * @return
     */
    public function initMsg($section) {
        $this->frmMsg = $this->formMessage($this->moduleName, $section);
        $this->view->frmMsg = $this->frmMsg;
        $this->view->frmMsgEncode = json_encode($this->frmMsg);

        $this->errMsg = $this->errorMessage($this->moduleName, $section);
        $this->view->errMsg = $this->errMsg;
        $this->view->errMsgEncode = json_encode($this->errMsg);
    }

    /**
     * Translates a number to a short alhanumeric version
     *
     * Translated any number up to 9007199254740992
     * to a shorter version in letters e.g.:
     * 9007199254740989 --> PpQXn7COf
     *
     * specifiying the second argument true, it will
     * translate back e.g.:
     * PpQXn7COf --> 9007199254740989
     *
     * this function is based on any2dec && dec2any by
     * fragmer[at]mail[dot]ru
     * see: http://nl3.php.net/manual/en/function.base-convert.php#52450
     *
     * If you want the alphaID to be at least 3 letter long, use the
     * $pad_up = 3 argument
     *
     * In most cases this is better than totally random ID generators
     * because this can easily avoid duplicate ID's.
     * For example if you correlate the alpha ID to an auto incrementing ID
     * in your database, you're done.
     *
     * The reverse is done because it makes it slightly more cryptic,
     * but it also makes it easier to spread lots of IDs in different
     * directories on your filesystem. Example:
     * $part1 = substr($alpha_id,0,1);
     * $part2 = substr($alpha_id,1,1);
     * $part3 = substr($alpha_id,2,strlen($alpha_id));
     * $destindir = "/".$part1."/".$part2."/".$part3;
     * // by reversing, directories are more evenly spread out. The
     * // first 26 directories already occupy 26 main levels
     *
     * more info on limitation:
     * - http://blade.nagaokaut.ac.jp/cgi-bin/scat.rb/ruby/ruby-talk/165372
     *
     * if you really need this for bigger numbers you probably have to look
     * at things like: http://theserverpages.com/php/manual/en/ref.bc.php
     * or: http://theserverpages.com/php/manual/en/ref.gmp.php
     * but I haven't really dugg into this. If you have more info on those
     * matters feel free to leave a comment.
     *
     * @author  Kevin van Zonneveld <kevin@vanzonneveld.net>
     * @author  Simon Franz
     * @author  Deadfish
     * @copyright 2008 Kevin van Zonneveld (http://kevin.vanzonneveld.net)
     * @license   http://www.opensource.org/licenses/bsd-license.php New BSD Licence
     * @version   SVN: Release: $Id: alphaID.inc.php 344 2009-06-10 17:43:59Z kevin $
     * @link    http://kevin.vanzonneveld.net/
     *
     * @param mixed   $in    String or long input to translate
     * @param boolean $to_num  Reverses translation when true
     * @param mixed   $pad_up  Number or boolean padds the result up to a specified length
     * @param string  $passKey Supplying a password makes it harder to calculate the original ID
     *
     * @return mixed string or long
     */
    function alphaID($in, $to_num = false, $pad_up = 9, $passKey = null) {

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

    /**
     * send mail function to send a mail
     * @param <type> $params
     * @return
     */
    public function sendMail($params = null) {

        $config = array('port' => 25, 'auth' => 'login', 'username' => 'vicky@qualitybrains.com', 'password' => '%Trang3r');

        $this->transport = new Zend_Mail_Transport_Smtp($this->constant->SMTPSERVER, $config);

        //$this->transport	= new Zend_Mail_Transport_Smtp($this->constant->SMTPSERVER);
        $this->mail = new Zend_Mail();

        //asd($params);
        $this->mail->clearSubject();
        $emailTo = $params['toEmail'];
        $emailValidator = new Zend_Validate_EmailAddress();
        if ($emailValidator->isValid($emailTo)) {
            $this->mail->setSubject($params['subject']);
            $this->mail->setFrom($params['from']);
            $this->mail->setReplyTo($this->constant->ADMINMAILID);
            $this->mail->setBodyHtml(stripcslashes(nl2br($params['body'])));
            $this->mail->addTo($emailTo);
            $this->mail->addBcc('vivek.vanguard@gmail.com');
            $this->mail->addBcc($this->constant->ADMINMAILID);

            /* check if there is attachment */
            try {
                if (isset($params['attachment']) && $params['attachment']['file_name'] != "") {

                    $contents = file_get_contents($params['attachment']['file_path']);
                    $at2 = new Zend_Mime_Part($contents);
                    $at2->type = $params['attachment']['file_type'];
                    $at2->disposition = Zend_Mime::DISPOSITION_INLINE;
                    $at2->encoding = Zend_Mime::ENCODING_BASE64;
                    $at2->filename = $params['attachment']['file_name'];
                    $this->mail->addAttachment($at2);
                }

                $this->mail->send($this->transport);
                $this->mail->clearRecipients();
                $this->mail->clearSubject();
                return true;
            } catch (Exception $e) {
                asd($e->getMessage());
                return 'Email could not be sent to ' . $emailTo . '<br/>';
            }
        }
    }

    public function getStaticValues($section, $valueType) {
        return $this->constant->fixvalues->$section->$valueType;
    }

    protected function _flashMessage($message) {
        $flashMessenger = $this->_helper->FlashMessenger;
        $flashMessenger->setNamespace('actionErrors');
        $flashMessenger->addMessage($message);
    }

    public function multi_implode($array, $glue) {
        $ret = '';
        foreach ($array as $item) {
            if (is_array($item)) {
                unset($item['average']);
                $ret .= $this->multi_implode($item, $glue) . $glue;
            } else {
                $ret .= $item . $glue;
            }
        }
        $ret = substr($ret, 0, 0 - strlen($glue));
        return $ret;
    }

    public function Escape($str, $html = false) {
        $str = preg_replace('#(\\\r|\\\r\\\n|\\\n)#', "<br>", $str); //
        if (substr($str, 0, 1) == "'") {
            $str = substr($str, 1);
        }
        if (substr($str, -1) == "'") {
            $str = substr($str, 0, -1);
        }
        $str = stripslashes($str);
        $str = $this->make_clickable($str, $html);
        return $str;
    }

    /**
     * Callback to convert URL match to HTML A element.
     *
     * This function was backported from 2.5.0 to 2.3.2. Regex callback for {@link
     * make_clickable()}.
     *
     * @since 2.3.2
     * @access private
     *
     * @param array $matches Single Regex Match.
     * @return string HTML A element with URL address.
     */
    public function make_web_ftp_clickable_cb($matches) {
        $ret = '';
        $dest = $matches[2];
        $dest = 'http://' . $dest;
        //$dest = esc_url($dest);
        if (empty($dest))
            return $matches[0];
        // removed trailing [,;:] from URL
        if (in_array(substr($dest, -1), array('.', ',', ';', ':')) === true) {
            $ret = substr($dest, -1);
            $dest = substr($dest, 0, strlen($dest) - 1);
        }
        return $matches[1] . "<a href=\"$dest\" rel=\"nofollow\" target=\"_blank\">$dest</a>" . $ret;
    }

    /**
     * Callback to convert email address match to HTML A element.
     *
     * This function was backported from 2.5.0 to 2.3.2. Regex callback for {@link
     * make_clickable()}.
     *
     * @since 2.3.2
     * @access private
     *
     * @param array $matches Single Regex Match.
     * @return string HTML A element with email address.
     */
    public function make_email_clickable_cb($matches) {
        $email = $matches[2] . '@' . $matches[3];
        return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
    }

    /**
     * Convert plaintext URI to HTML links.
     *
     * Converts URI, www and ftp, and email addresses. Finishes by fixing links
     * within links.
     *
     * @since 0.71
     *
     * @param string $ret Content to convert URIs.
     * @return string Content with converted URIs.
     */
    public function make_clickable($ret, $html) {
        $ret = ' ' . $ret;
        // in testing, using arrays here was found to be faster
        $ret = preg_replace_callback('#(?<=[\s>])(\()?([\w]+?://(?:[\w\\x80-\\xff\#$%&~/\-=?@\[\](+]|[.,;:](?![\s<])|(?(1)\)(?![\s<])|\)))+)#is', array($this, 'make_url_clickable_cb'), $ret);
        $ret = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]+)#is', array($this, 'make_web_ftp_clickable_cb'), $ret);
        if ($html != 'input') {
            $ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', array($this, 'make_email_clickable_cb'), $ret);
        }
        // this one is not in an array because we need it to run last, for cleanup of accidental links within links
        $ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
        $ret = trim($ret);
        return $ret;
    }

    public function find_date($string) {

        //Define month name:
        $month_names = array(
            "january",
            "february",
            "march",
            "april",
            "may",
            "june",
            "july",
            "august",
            "september",
            "october",
            "november",
            "december"
        );

        $month_number = $month = $matches_year = $year = $matches_month_number = $matches_month_word = $matches_day_number = "";

        //Match dates: 01/01/2012 or 30-12-11 or 1 2 1985
        preg_match('/([0-9]?[0-9])[\.\-\/ ]?([0-1]?[0-9])[\.\-\/ ]?([0-9]{2,4})/', $string, $matches);
        if ($matches) {
            if ($matches[1])
                $day = $matches[1];

            if ($matches[2])
                $month = $matches[2];

            if ($matches[3])
                $year = $matches[3];
        }

        //Match month name:
        preg_match('/(' . implode('|', $month_names) . ')/i', $string, $matches_month_word);

        if ($matches_month_word) {
            if ($matches_month_word[1])
                $month = array_search(strtolower($matches_month_word[1]), $month_names) + 1;
        }

        //Match 5th 1st day:
        preg_match('/([0-9]?[0-9])(st|nd|th)/', $string, $matches_day);
        if ($matches_day) {
            if ($matches_day[1])
                $day = $matches_day[1];
        }

        //Match Year if not already setted:
        if (empty($year)) {
            preg_match('/[0-9]{4}/', $string, $matches_year);
            if ($matches_year[0])
                $year = $matches_year[0];
        }
        if (!empty($day) && !empty($month) && empty($year)) {
            preg_match('/[0-9]{2}/', $string, $matches_year);
            if ($matches_year[0])
                $year = $matches_year[0];
        }

        //Leading 0
        if (1 == strlen($day))
            $day = '0' . $day;

        //Leading 0
        if (1 == strlen($month))
            $month = '0' . $month;

        //Check year:
        if (2 == strlen($year) && $year > 20)
            $year = '19' . $year;
        else if (2 == strlen($year) && $year < 20)
            $year = '20' . $year;

        $date = array(
            'year' => $year,
            'month' => $month,
            'day' => $day
        );

        //Return false if nothing found:
        if (empty($year) && empty($month) && empty($day))
            return false;
        else
            return $date;
    }

}