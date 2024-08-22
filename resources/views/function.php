<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/db.class.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/mail.php');
?>

<?php
$db=new db();	


class AllFunction{
    public function ImgName(){
        $TmpName= date('Y:m:d H:i:s');
        $TmpName=str_replace(':', '', $TmpName);
        $TmpName=str_replace(' ', '', $TmpName);
        return $TmpName;
    }
}
function EncodeId($id,  $salt = "gabriel.imakeawesomethings.com/"){
    return randomString().base64_encode($id).randomString();
    //return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $id, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
}
function DecodeId($id,  $salt = "gabriel.imakeawesomethings.com/"){
    $id = substr($id,1,-1);
    return base64_decode($id);
}
function randomString($length = 1) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}


?>


