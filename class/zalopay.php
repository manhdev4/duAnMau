<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(0);
class ZaloPay
{
    public $cookie;

    public function __construct($cookie)
    {
        $this->cookie = $cookie;
        return $this;
    }

    public function getHistory()
    {
        $headers = array(
            'Host: sapi.zalopay.vn',
            'Cookie: ' . $this->cookie,
            'Accept: */*',
            'Origin: https://social.zalopay.vn',
            'Referer: https://social.zalopay.vn/spa/v2/history',
            'X-Platform: ZPA',
            'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36',
            'Accept-Language: vi-VN,vi;q=0.9',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/history/transactions?page_size=20');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $history = [];
        
        foreach (json_decode($data, true)['data']['transactions'] as $row) {
            $trans_id_code = $row['trans_id'];
            $headers = array(
                'Host: sapi.zalopay.vn',
                'Cookie: ' . $this->cookie,
                'Accept: */*',
                'Origin: https://social.zalopay.vn',
                'Referer: https://social.zalopay.vn/spa/v2/history',
                'X-Platform: ZPA',
                'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36',
                'Accept-Language: vi-VN,vi;q=0.9',
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://sapi.zalopay.vn/v2/history/transactions/' . $trans_id_code . "?type=1");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($response, true)['data']['transaction'];
            //return $response;
            $history[] = [
                "trans_id" => $json['template_info']['custom_fields'][0]['value'],
                "trans_time" => $json['trans_time'],
                "trans_amount" => $json['trans_amount'],
                "status" => $json['status_info']['status'],
                "sign" => $json['sign'],
                "name" => $json['template_info']['custom_fields'][1]['value'],
                "phone" => $json['template_info']['custom_fields'][2]['value'],
                "description" => $json['description'],
            ];
        }
        return json_encode([
            "status" => "success",
            "msg" => "Lịch Sử Giao Dịch Zalo",
            "transaction" => $history
        ]);
    }


    public function getQR($amount, $description)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sapi.zalopay.vn/v1/mt/flex-qrcode/generate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"amount":' . $amount . ',"message":"' . $description . '","size":190}',
            CURLOPT_HTTPHEADER => array(
                'Host: sapi.zalopay.vn',
                'Cookie: ' . $this->cookie,
                'Accept: */*',
                'Origin: https://social.zalopay.vn',
                'Referer: https://social.zalopay.vn/spa/v2/history',
                'X-Platform: ZPA',
                'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Mobile Safari/537.36',
                'Accept-Language: vi-VN,vi;q=0.9',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}

$cookie = '_ga_CTKYTBPSY7=GS1.1.1722396654.1.1.1722396741.60.0.0; _ga_F67L6K7V67=GS1.1.1722396653.1.1.1722396741.0.0.0; has_device_id=0; _ga=GA1.1.1376231858.1722396854; zalo_id=2611450619252271734; zalopay_id=240727000500556; zalo_oauth=vCa0kCz8tXw4vMVtuKwC5xtOL_AjRfmRzTiZy_f-eMBapsptdsNN6_dATS2aPwaYiTvfokrlxMdPpLBxm7gLQRxIA8VVUUf8Y-PbYQHNf7__vmEjutcbDVcIUuIgGvqbbB4JXEyRqc7iitpGxbQQHBBVNB2vQf8xnyqxm816xpJl-NZN-52XJkIXHCYSRQuZtfr_ix0-wLlHW2FGpKk1ISBh5FZ53xrSZyLUaurXurwnaWVWoJtN0CpYETFFCQ5jmi91BjzhoAw6xWO9w7QE_uwePZ_k5u3hpPDPCE4UqDlki5iFT9t3YZm1Ig4-IcTXQjM8bHWL9cuniFseIaSiBZJfcwCrN48f8fM3h59OIIrUMIR7kMPJpsw860; zlp_token=KswwYX9JwBz1KmLzTsh41t7CrfKuxJf8XgpKkS24pCmpiquNpoTZYUQ5HGnMbSgxxeA5LHFX6BYXdt8CZWzvMVvZvcMQr7F9oBtxHsR2APv3Y15JSxsse8uobgeR2kzgsDxVqffmdtb84px75YVLCYDBgZCRByUihGkosMwM8DsEUbGZPV5E; _ga_XWW4JEB21X=GS1.1.1722396854.1.1.1722397060.26.0.0';

$ZaloPay = new ZaloPay($cookie);
//$getHistory = $ZaloPay->getHistory(); #get lịch sử zalo

?>
