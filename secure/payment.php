<?php

@session_start();

class payment {

    CONST ACCESS_CODE = 'A7CB0A09'; //Put your access code here
    CONST MERCHANT = 'BBL3335577'; //Add your merchant number here
    CONST RETURN_URL = 'http://www.identikid.com.au/secure/payment_callback.php';
    CONST MERCHANT_NAME = 'Identikid';
    CONST SECURE_SECRET = "DDE28EF69AE3E7214E080E54F809C2E2";
    CONST TOKEN_NOT_MATCHED = 'Token not matched';
    CONST PAYMENT_SUCCESSFULL = 'payment successfull';
    CONST PAYMENT_FAILED = 'payment failed';

    /**
     * print getValhttp://www.identikid.com.au/
     * @param type $array
     * @param type $key
     * @param type $default
     * @return type
     */
    public function getValue($array, $key, $default = '') {
        if (isset($array[$key])) {
            return $array[$key];
        }

        return $default;
    }

    private function generateToken($orderId, $userId) {
        $token = hash('ripemd160', $orderId . '_' . $userId . '_' . uniqid());
        $_SESSION['token'] = $token;
        return $token;
    }

    private function checkIfReturnedTokenMatches($returnedToken) {
        $savedToken = $this->getValue($_SESSION, 'token', uniqid());
        if ($returnedToken === $savedToken) {
            return true;
        }
        return false;
    }

    /**
     * update response from payment gateway
     * @return type
     */
    public function updateResponse() {
        $returnedToken = $this->getValue($_REQUEST, 'vpc_MerchTxnRef');
        // check if token matched
        if (!$this->checkIfReturnedTokenMatches($returnedToken)) {
            exit("Security warning!, token not matched!");
        }


        $TxnResponseCode = $this->getValue($_REQUEST, 'vpc_TxnResponseCode',  uniqid());
        
        // approved
        if ($TxnResponseCode === '0') {
            return self::PAYMENT_SUCCESSFULL;
        } else {
            return self::PAYMENT_FAILED;
        }
    }

    /**
     * make paymet
     * @param type $amount
     * @param type $orderId
     * @param type $userId
     */
    public function makePayment($amount, $orderId, $userId) {

        $token = $this->generateToken($orderId, $userId);

        $paymentData = array(
            "vpc_Amount" => $amount, //Final price should be multifly by 100
            "vpc_AccessCode" => self::ACCESS_CODE, //Put your access code here
            "vpc_Command" => "pay",
            "vpc_Locale" => "en",
            "vpc_MerchTxnRef" => $token, //This should be something unique number, i have used the session id for this
            "vpc_Merchant" => "BBL3335577", //Add your merchant number here
            "vpc_OrderInfo" => $orderId, //this also better to be a unique number
            "vpc_ReturnURL" => self::RETURN_URL, //Add the return url here so you have to code here to capture whether the payment done successfully or not
            "vpc_Version" => "1",
            "vpc_merchant_name" => self::MERCHANT_NAME,
        );

        ksort($paymentData); // You have to ksort the arry to make it according to the order that it needs

        $secureSecret = self::SECURE_SECRET;
        $url = "";

        foreach ($paymentData as $key => $value) {
            $secureSecret .= $value;
            $url .= $key . "=" . urlencode($value) . "&";
        }

        $securehash = md5($secureSecret); //Encoding
        $url .= "vpc_SecureHash=" . $securehash;

        header("location:https://migs.mastercard.com.au/vpcpay?$url");
    }

}
