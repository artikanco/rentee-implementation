<?php
/*
 * NOTE: This is only simple example for making POST request.
 */
 
if($_POST) {
    $url = 'http://<base_url>/api/reservations/new';
    $data = array(
        'api_key' => '<api_key>',
        'apartment_id' => $_POST['apartment_id'],
        'date_arrive' => $_POST['date_arrive'],
        'date_leave' => $_POST['date_leave'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'message' => $_POST['message'],
        'adult' => $_POST['adult'],
        'child' => $_POST['child'],
        'pet' => $_POST['pet'],
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
	
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    $status = json_decode($result)->status; // "fail or "success"
    $message = json_decode($result)->message; // detailed explanation

    echo $message;
}