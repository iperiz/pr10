<?php

class curl {
  
    public function get($url, $token){
        $ch = curl_init($url);    
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                 
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             "User-Agent: php-curl",
             "Authorization: token ".$token,
             "Content-Length: 0"));
         $result = curl_exec($ch);
         return $result;
    }
}
?>
