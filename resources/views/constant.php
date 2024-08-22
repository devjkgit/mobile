<?php
function pathUrl($dir = __DIR__)
{
    $root = "";
    $dir = str_replace('\\', '/', realpath($dir));
    $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $root .= '://' . $_SERVER['HTTP_HOST']."";
    return $root;
}


 @session_start(); 
 define('DB_HOST','localhost');
 define('DB_DATABASE','gabriel');
 define('DB_USER','gabriel');
 define('DB_PASSWORD','e0AWX+}f,KO6');
 $base_url = pathUrl(__DIR__ . '/../');
 

 define('base_url', $base_url);
 define('DOCUMENT_ROOT', $_SERVER["DOCUMENT_ROOT"]);
 define('EXEC', $base_url."/Exec/");
 define('Classes', $base_url."/Classes/");
 define('css', $base_url."/assets/css/");
 define('js', $base_url."/assets/js/");
 define('images', $base_url."/assets/images/");
 define('Function_File',$base_url. '/function.php');
 define('ROOT',$_SERVER['HTTP_HOST'] . '/');


define('CLIENT_ID', '81697861866-q0nqbivhf8b2v1medc9a21svdkf57pqg.apps.googleusercontent.com');
define('CLIENT_SECRET', '-8z3rDs_4eJz4t99h7O1K9li');
define('CLIENT_REDIRECT_URL', 'http://khalaf.imakeawesomethings.com/google');



class geoPlugin {
    private function getUserIpAddr()
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $IP = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $IP = $_SERVER['REMOTE_ADDR'];
        }
        return $IP;
    }
    //the geoPlugin server
    // var $host = 'http://www.geoplugin.net/php.gp?ip={103.251.19.130}';
    public function locate($ip = null) {
        $IP=$this->getUserIpAddr();
        $host = 'http://www.geoplugin.net/php.gp?ip='.$IP;
        $timezone = null;
        global $_SERVER;
        if ( is_null( $ip ) ) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        @$host = str_replace( '{IP}', $ip, $this->host );
        $data = array();
        $response = $this->fetch($host);
        @$data = unserialize($response);
        $this->timezone = $data['geoplugin_timezone'];
    }
    public function fetch($host) {
        $IP=$this->getUserIpAddr();
        $host = 'http://www.geoplugin.net/php.gp?ip='.$IP;
        $timezone = null;
        if ( function_exists('curl_init') ) {
            //use cURL to fetch data
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
            $response = curl_exec($ch);
            curl_close ($ch);
        } else if ( ini_get('allow_url_fopen') ) {
            $response = file_get_contents($host, 'r');
        } else {
            trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
            return;
        }
        return $response;
    }
}
$geoplugin = new geoPlugin();
$geoplugin->locate();
@date_default_timezone_set($geoplugin->timezone);
?>