<?php
    $url = "https://api.privatbank.ua/p24api/rest_fiz";
    $id = 123456;
    $password = 'tralalatralalatralala';// length 32 symbols
    $date_begin = '01.06.2018';
    $date_end = '30.07.2018';
    $card_number = '1111222233334444';

    $data = '<oper>cmt</oper><wait>0</wait><test>0</test><payment id=""><prop name="sd" value="'.$date_begin.'" /><prop name="ed" value="'.$date_end.'" /><prop name="card" value="'.$card_number.'" /></payment>';

    $sign = sha1(md5($data.$password));

    $xml_form = '<?xml version="1.0" encoding="UTF-8"?><request version="1.0"><merchant><id>'.$id.'</id><signature>'.$sign.'</signature></merchant><data>'.$data.'</data></request>';
    $stream_options = array (
                'http' => array (
                'method' => "POST",
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => $xml_form
                )
    );
    $context = stream_context_create($stream_options);
    $response = file_get_contents($url, false, $context);
    $array_data = json_decode(json_encode(simplexml_load_string($response)), true);

    print_r($array_data);