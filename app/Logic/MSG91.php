<?php
namespace App\Logic;

/**
 * class MSG91 to send SMS on Mobile Numbers.
 * @author Shashank Tiwari
 */
class MSG91 {

    function __construct() {

    }

    public function sendSMS($mobile,$message){
        $isError = 0;
        $errorMessage = true;
        //Preparing post parameters
        $postData = array(
            'authkey' => env('MSG91_AUTH_KEY'),
            'mobiles' => $mobile,
            'message' => $message,
            'sender' => env('MSG91_SENDER_ID'),
            'route' => env('MSG91_ROUTE'),
            'country' => env('MSG91_COUNTRY')
        );

        $url = "http://api.msg91.com/api/sendhttp.php";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }
}
?>