<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(0);
define('SERVERNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','manhdev');

class ManhDev {
    private $ketnoi;
    function connect() {
        if (!$this->ketnoi) {
            $this->ketnoi = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE) or die ('Lỗi Liên Kết SQL! Vui Lòng Liền Hệ Zalo: zalo.me/manhdev | FB: fb.com/lumanhgioi.vn Để Được Hỗ Trợ');
            mysqli_query($this->ketnoi, "set names 'utf8'");
        }
    }
    function dis_connect() {
        if ($this->ketnoi) {
            mysqli_close($this->ketnoi);
        }
    }

    function site($data) {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `settings` ")->fetch_array();
        return $row[$data];
    }
    
    function users($data) {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' AND `domain` = '".$_SERVER['SERVER_NAME']."' ")->fetch_array();
        return $row[$data];
    }
    
    function query($sql) {
        $this->connect();
        $row = $this->ketnoi->query($sql);
        return $row;
    }
    function cong($table, $data, $sotien, $where) {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` + '$sotien' WHERE $where ");
        return $row;
    }
    function tru($table, $data, $sotien, $where) {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` - '$sotien' WHERE $where ");
        return $row;
    }
    
    function insert($table, $data) {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value) {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->ketnoi, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->ketnoi, $sql);
    }
    
    function update($table, $data, $where) {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value) {
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        return mysqli_query($this->ketnoi, $sql);
    }
    
    function update_value($table, $data, $where, $value1) {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where.' LIMIT '.$value1;
        return mysqli_query($this->ketnoi, $sql);
    }
    
    function xoa($table, $where) {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->ketnoi, $sql);
    }
    
    function get_list($sql) {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database ');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    
    function get_row($sql) {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result) {
            die ('Lỗi kết nối database 2');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
    
    function num_rows($sql) {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Lỗi kết nối database 2');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row) {
            return $row;
        }
        return false;
    }
}

# ĐƠN VỊ THIẾT KẾ WEBSITE MANHDEV | ZALO: zalo.me/manhdev | FB: fb.com/lumanhgioi.vn | KHÔNG SỬ DỤNG MÃ NGUỒN CỦA BÊN KHÁC CUNG CẤP! CHÚNG TÔI SẼ KHÔNG BẢO HÀNH LỖI MÀ BẠN GẶP.

if(isset($_SESSION['username'])) { 
    $ManhDev = new ManhDev;
    $getUser = $ManhDev->get_row(" SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ");
    $username = $getUser['username'];
    
    if(!$getUser) {
        session_start();
        session_destroy();
        header('location: /');
    }
    
    if($getUser['bannd'] >= 1) {
        include $_SERVER['DOCUMENT_ROOT']."/pages/bandAccount.php"; 
        die();
        exit;
    }
    
    if ($getUser['money'] < 0) {
        $ManhDev->update("users", array(
            'bannd' => 1
        ), "username = '$my_user' ");
        session_start();
        session_destroy();
        header('location: /');
        die();
    }
# ĐƠN VỊ THIẾT KẾ WEBSITE MANHDEV | ZALO: zalo.me/manhdev | FB: fb.com/lumanhgioi.vn | KHÔNG SỬ DỤNG MÃ NGUỒN CỦA BÊN KHÁC CUNG CẤP! CHÚNG TÔI SẼ KHÔNG BẢO HÀNH LỖI MÀ BẠN GẶP.

} else {
    $my_level = NULL;
    $my_money = 0;
}

$ManhDev = new ManhDev;
$base_url = 'https://'.$_SERVER['SERVER_NAME'].'/';
$url_site_name = strtoupper($_SERVER['SERVER_NAME']);

# ĐƠN VỊ THIẾT KẾ WEBSITE MANHDEV | ZALO: zalo.me/manhdev | FB: fb.com/lumanhgioi.vn | KHÔNG SỬ DỤNG MÃ NGUỒN CỦA BÊN KHÁC CUNG CẤP! CHÚNG TÔI SẼ KHÔNG BẢO HÀNH LỖI MÀ BẠN GẶP.

$time = date("H:i d-m-Y");

function tach_time($time){
    return date("d-m-Y H:i:s", $time);
}

function userAgent() {
return $_SERVER["HTTP_USER_AGENT"];
}


function trangThaiMxh($data){
    if($data == "Pending"){
        return '<span class="badge bg-warning badge-sm">Đang Chờ</span>';
    } else if($data == "Completed") {
        return '<span class="badge bg-success badge-sm">Hoàn Thành</span>';
    } else if($data == "WaitingForRefund") {
        return '<span class="badge bg-secondary badge-sm">Đang Hủy Đơn</span>';
    } else if($data == "Running") {
        return '<span class="badge bg-primary badge-sm">Đang Chạy</span>';
    } else if($data == "Refund") {
        return '<span class="badge bg-danger badge-sm">Hoàn Tiền</span>';
    } else if($data == "Paused") {
        return '<span class="badge bg-danger badge-sm">Tạm Dừng</span>';
    } else if($data == "Active") {
        return '<span class="badge bg-success badge-sm">Hoạt Động</span>';
    } else {
        return '<span class="badge bg-info badge-sm">Khác</span>';
    }
}

function BASE_URL($url) {
    global $base_url;
    return $base_url.$url;
}

function check_string($data) {
    return (trim(htmlspecialchars(addslashes($data))));
}

function tien($price) {
    return str_replace(",", ".", number_format($price));
}

function random($string, $int) {  
    return substr(str_shuffle($string), 0, $int);
}

function getip() {
return $_SERVER['REMOTE_ADDR'];
}

function api_token() {
$api_token = random('QWERTYUIOPASDFGHJKLZXCVBNM', '4')."-".random('QWERTYUIOPASDFGHJKLZXCVBNM', '4')."-".random('QWERTYUIOPASDFGHJKLZXCVBNM', '4')."-".random('QWERTYUIOPASDFGHJKLZXCVBNM', '4');
return $api_token;
}

# ĐƠN VỊ THIẾT KẾ WEBSITE MANHDEV | ZALO: zalo.me/manhdev | FB: fb.com/lumanhgioi.vn | KHÔNG SỬ DỤNG MÃ NGUỒN CỦA BÊN KHÁC CUNG CẤP! CHÚNG TÔI SẼ KHÔNG BẢO HÀNH LỖI MÀ BẠN GẶP.

function xoadau($strTitle) {
$strTitle=strtolower($strTitle);
$strTitle=trim($strTitle);
$strTitle=str_replace(' ','-',$strTitle);
$strTitle=preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/",'o',$strTitle);
$strTitle=preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/",'o',$strTitle);
$strTitle=preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/",'a',$strTitle);
$strTitle=preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/",'a',$strTitle);
$strTitle=preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/",'e',$strTitle);
$strTitle=preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/",'e',$strTitle);
$strTitle=preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/",'u',$strTitle);
$strTitle=preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/",'u',$strTitle);
$strTitle=preg_replace("/(ì|í|ị|ỉ|ĩ)/",'i',$strTitle);
$strTitle=preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/",'i',$strTitle);
$strTitle=preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/",'y',$strTitle);
$strTitle=preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/",'y',$strTitle);
$strTitle=str_replace('đ','d',$strTitle);
$strTitle=str_replace('Đ','d',$strTitle);
$strTitle=preg_replace("/[^-a-zA-Z0-9]/",'',$strTitle);
return $strTitle;
}