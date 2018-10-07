<?php

namespace App\Logic;

use Razorpay\Api\Api;

trait Payment
{
    protected $instamojo_url = 'https://test.instamojo.com/api/1.1/payment-requests/';

    protected $instamojo_api_key = 'X-Api-Key:test_bfb5ab568bfdbc746392c440165';

    protected $instamojo_auth_key = 'X-Auth-Token:test_d32341c41797372cac35b7d2436';

    protected $razorpay_key = 'rzp_test_dH5EBUEjZ7dHdD';

    protected $razorpay_secret_key = 't3K2pahKcqoEUcBlWII0WyRp';


    public function createInstamojoRequest($payload)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->instamojo_url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array($this->instamojo_api_key, $this->instamojo_auth_key));

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function captureInstamojoDetails($payment_request_id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->instamojo_url . $payment_request_id);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array($this->instamojo_api_key, $this->instamojo_auth_key));
        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);;
    }

    public function requestRazorpay()
    {
        return new Api($this->razorpay_key, $this->razorpay_secret_key);
    }

    public function fetchRazorpayPayment($api, $payment_id)
    {
        return $api->payment->fetch($payment_id);
    }

    public function captureRazorpayPayment($payment, $amount)
    {
        return $payment->capture($amount);
    }


}