<?php

require_once 'config.php';

$privateKey;
if (isset($_POST["privateKey"]))
    $privateKey = $_POST["privateKey"];
else if (isset($_GET["privateKey"]))
    $privateKey = $_GET["privateKey"];
$data;
if (isset($_POST["data"]))
    $data = $_POST["data"];
else if (isset($_GET["data"]))
    $data = $_GET["data"];


if (!empty($privateKey)) {
    $fields = array(
        'privateKey' => urlencode($privateKey),
        'data' => urlencode($data)
    );
    $fields_string="";
    foreach ($fields as $key => $value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, EASY_SOCKET_POST_URL);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    $result = curl_exec($ch); 
    curl_close($ch);
} else {
    echo json_encode("privateKey empty");
}
?>
