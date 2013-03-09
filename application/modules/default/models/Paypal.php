<?php

class Default_Model_Paypal extends Zend_Http_Client {

    private $_api_version = '56.0';
    private $_api_username = 'paypal_1325102763_biz_api1.picstotake.com';
    private $_api_password = '1325102792';
    private $_api_signature = 'ATTMDc8VBRXeH-dTJdBlfnOtqJ5AADBlhkUIu7yV7qM9r7v.DXRqbmjJ';

    function __construct($uri = null, $options = null) {
        parent::__construct($uri, $options);

        // NOTE: Parameters must always be url encoded, as per PayPal documentation.
        $this->setParameterGet('USER', urlencode($this->_api_username));
        $this->setParameterGet('PWD', urlencode($this->_api_password));
        $this->setParameterGet('SIGNATURE', urlencode($this->_api_signature));
        $this->setParameterGet('VERSION', urlencode($this->_api_version));
    }

    /**
     * Calls the 'DoDirectPayment' API call. Note - Keep track of the
     * transaction ID on success! You'll need it to get transaction details
     * at a later date.
     *
     * @param float $amount
     * @param string $credit_card_type
     * @param string $credit_card_number
     * @param string $expiration_month
     * @param string $expiration_year
     * @param string $cvv2
     * @param string $first_name
     * @param string $last_name
     * @param string $address1
     * @param string $address2
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $country
     * @param string $currency_code
     * @param string $ip_address
     * @param string $payment_action Can be 'Authorization' (default) or 'Sale'
     *
     * @return Zend_Http_Response
     * @throws Zend_Http_Client_Exception
     */
    function doDirectPayment(
    $amount, $credit_card_type, $credit_card_number, $expiration_month, $expiration_year, $cvv2, $first_name, $last_name, $address1, $address2, $city, $state, $zip, $country, $currency_code, $ip_address, $payment_action = 'Sale'
    ) {
        $this->setParameterGet('METHOD', 'DoDirectPayment');

        $expiration_date = str_pad($expiration_month, 2, STR_PAD_LEFT) .
                $expiration_year;

        $this->setParameterGet('PAYMENTACTION', urlencode($payment_action)); // Can be 'Authorization', or 'Sale'
        $this->setParameterGet('AMT', urlencode($amount));
        $this->setParameterGet('CREDITCARDTYPE', urlencode($credit_card_type));
        $this->setParameterGet('ACCT', urlencode($credit_card_number));
        $this->setParameterGet('EXPDATE', urlencode($expiration_date));
        $this->setParameterGet('CVV2', urlencode($cvv2));
        $this->setParameterGet('FIRSTNAME', urlencode($first_name));
        $this->setParameterGet('LASTNAME', urlencode($last_name));
        $this->setParameterGet('STREET', urlencode($address1));

        if (!empty($address2)) {
            $this->setParameterGet('STREET2', urlencode($address2));
        }

        $this->setParameterGet('CITY', urlencode($city));
        $this->setParameterGet('STATE', urlencode($state));
        $this->setParameterGet('ZIP', urlencode($zip));
        $this->setParameterGet('COUNTRYCODE', urlencode($country));
        $this->setParameterGet('CURRENCYCODE', urlencode($currency_code));
        $this->setParameterGet('IPADDRESS', urlencode($ip_address));

        return $this->request(Zend_Http_Client::GET);
    }

}

?>