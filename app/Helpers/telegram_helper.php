<?php
if( !function_exists('send_telegram_callmebot') ){

    function send_telegram_callmebot($message){
        $userName = 'groovyhooked';
        $url = "http://api.callmebot.com/text.php?user=".$userName."&text=".urlencode($message)."";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ));
        curl_exec($curl);
        curl_close($curl);
    }
}
