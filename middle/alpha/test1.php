<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors' , 1);
  $ucid='as2757';
  $password='as2757';
  $arr = array('user' => $ucid, 'pass' => $password);
  $json_data=json_encode($arr);
  echo($json_data);
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "https://web.njit.edu/~as2757/cs490/back/alpha/back-alpha.php",
    CURLOPT_USERAGENT => "POST Request to back",
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $json_data
  ));
  $response = curl_exec($ch);
  // echo($response);
  curl_close($ch);
  echo($response);
?>
