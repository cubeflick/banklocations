<?php

class Zend_View_Helper_LoggedInUser {

    protected $view;

    function setView($view) {
        $this->view = $view;
    }

    function loggedInUser() {
        $string = '';
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $logoutUrl = $this->view->url(
            array('module' => 'default','controller' => 'auth','action' => 'logout'));
            $user = $auth->getIdentity();
            $username = $this->view->escape(ucfirst($user->user_name));
            $string = 'Logged in as ' . $username . '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' .
                    $logoutUrl . '">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;';
        } else {
           $string .= '<div class="inputbox"><form id="ToploginForm" name="ToploginForm" method="post" action="/default/auth/identify"  >
                <div class="username">
                    <input name="username" type="text" class="inputbg" id="username"   />
                </div>
                <div class="username" style="border:none;">
                    <input name="password" type="password" class="inputbg" id="password" />
                </div>
                <div class="loginbutton"><a href="javascript:void(0)" onclick="javascript:submitform();">LOGIN</a></div>
                <input type="submit" style="visibility:hidden" name="submittest" value="submittest"/>
            </form></div><div class="firsttime">First time here ?
            <a href="/default/index/register">Register</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/default/index/forgotpassword">Forgot your password? </a></div>';
        }
        return $string;
    }
}

?>
