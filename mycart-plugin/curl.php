<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/subscriptions/");
curl_setopt($ch, CURLOPT_HEADER, 0);

$instArray = Array();

$instArray['client_id'] = "8a243bf4ba274a7c9020a2d8f31211b7";
$instArray['client_secret'] = "f907e96308bd4bb1b40dd1137b3d5008";
$instArray['object'] = "tag";
$instArray['aspect'] = "media";
$instArray['object_id'] = "endeavour";
$instArray['callback_url'] = "http://endeavour.edu.au";

curl_setopt($ch, CURLOPT_POSTFIELDS, $instArray);

if(($str = curl_exec($ch)) === false)
{
    echo 'Curl error: ' . curl_error($ch);
}

print_r($str);