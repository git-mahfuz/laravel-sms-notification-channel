<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel {

	public function send($notifiable, Notification $notification)
	{		
		try {

			$message = $notification->toSms($notifiable);
			$sms = $message['message'];            

            $smsUSER = config('services.sms.username');
           
            $smsPassword = config('services.sms.password');

            $from = config('services.sms.from');

            $authHash = "Basic " . base64_encode($smsUSER . ":" . $smsPassword);
            
            $curl = curl_init();
          
              curl_setopt_array($curl, array(
              CURLOPT_URL => config('services.sms.url'),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{ \"from\":\"$from\", \"to\":\"$notifiable->mobile_number\", \"text\":\"$sms\" }",
              CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: ".$authHash,
                "content-type: application/json"
              ),
            ));

            $resp = curl_exec($curl);
            curl_close($curl);

            \Log::info($resp);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
	}

}