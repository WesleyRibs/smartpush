<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $url     = "http://smartville.com.br/condominiosUsers/sendforall";
        //echo $htmlPag = file_get_contents( $url );

        // create curl resource 
        $ch = curl_init();

        // set url 
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string 
        echo "Resultado: " . $output = curl_exec($ch);

        // close curl resource to free up system resources 
        curl_close($ch);
}