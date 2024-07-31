<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$vnp_TmnCode = "9ZB07R4F";
$vnp_HashSecret = "3PWCJ9JM35BVZQV5X222WPJIR004ZO41";
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://".$_SERVER['SERVER_NAME']."/resources/success.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";

$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));


class VNPay
{
    public $vnp_TmnCode;
    public $vnp_Returnurl;
    public $expire;

    public $vnp_Url;

    public $vnp_HashSecret;

    function __construct($vnp_TmnCode, $vnp_Returnurl, $expire, $vnp_Url, $vnp_HashSecret)
    {
        $this->vnp_TmnCode = $vnp_TmnCode;
        $this->vnp_Returnurl = $vnp_Returnurl;
        $this->expire = $expire;
        $this->vnp_Url = $vnp_Url;
        $this->vnp_HashSecret = $vnp_HashSecret;
    }

    function createPay($vnp_TxnRef, $vnp_Amount, $vnp_BankCode)
    {
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Thanh toan GD:".$vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $this->vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $this->expire
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode !== "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url."?".$query;
        if (isset($this->vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $this->vnp_HashSecret); 
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }
}

$VNPay = new VNPay($vnp_TmnCode, $vnp_Returnurl, $expire, $vnp_Url, $vnp_HashSecret);