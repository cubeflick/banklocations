<?php

class App_Plugins_Escape {

    public function NewEscape($str,$html = false) {
       $str = preg_replace('#(\\\r|\\\r\\\n|\\\n)#', "<br>", $str);//              
       if(substr( $str,0,1) == "'"){
            $str = substr( $str,1 );
       }
       if(substr( $str,-1) == "'"){
            $str = substr( $str,0,-1);
       }
       if($html == 'input'){
          $str = stripslashes($str);
       }else{
           $str = stripslashes($str);
           //$str = htmlentities($str, ENT_QUOTES, 'UTF-8');
       }      
       $str = $this->make_clickable($str,$html);
       return $str;
    }
    
    /**
    * Callback to convert URI match to HTML A element.
    *
    * This function was backported from 2.5.0 to 2.3.2. Regex callback for {@link
    * make_clickable()}.
    *
    * @since 2.3.2
    * @access private
    *
    * @param array $matches Single Regex Match.
    * @return string HTML A element with URI address.
    */
    public function make_url_clickable_cb($matches) {
        $url = $matches[2];        
        if ( empty($url) )
            return $matches[0];
        return $matches[1] . "<a href=\"$url\" rel=\"nofollow\" target=\"_blank\">$url</a>";
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
        if ( empty($dest) )
            return $matches[0];
        // removed trailing [,;:] from URL
        if ( in_array(substr($dest, -1), array('.', ',', ';', ':')) === true ) {
            $ret = substr($dest, -1);
            $dest = substr($dest, 0, strlen($dest)-1);
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
    public function make_clickable($ret,$html) {
        $ret = ' ' . $ret;
        // in testing, using arrays here was found to be faster
        $ret = preg_replace_callback('#(?<=[\s>])(\()?([\w]+?://(?:[\w\\x80-\\xff\#$%&~/\-=?@\[\](+]|[.,;:](?![\s<])|(?(1)\)(?![\s<])|\)))+)#is', array($this,'make_url_clickable_cb'), $ret);
        $ret = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]+)#is', array($this,'make_web_ftp_clickable_cb'), $ret);
        if($html != 'input'){
            $ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', array($this,'make_email_clickable_cb'), $ret);
        }        
        // this one is not in an array because we need it to run last, for cleanup of accidental links within links
        $ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
        $ret = trim($ret);
        return $ret;
    }  
}
?>
