<?php
    require "DB/db.php";

    if( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {

        if( $_POST['reference'] !== '' )
        {
            $ref = $_POST['reference'];

            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$ref}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_c5bf0023b14b1a1ca0b56678c05534b14a311740",
                "Cache-Control: no-cache",
            ),
            ));
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {

               print_r($response);

            }

        }
        else
        {
            return 'Validation Failed';
        }
    }
    else{
        return 'THIS REQUEST IS NOT SUPPORTED';
    }


   