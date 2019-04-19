<?php
  /*
    Author: Akassh Shah
  */
  function njitAuthenticate($ucid,$pass){
    $url="https://aevitepr2.njit.edu/myhousing/login.cfm";
    $data=array("ucid" => $ucid, "pass" => $pass);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close ($ch);
    // return($response);
    if (strpos($response,"Please login using your UCID and password to access the online room selection system")==false){
      return True;
    }
    return False;
  }
  function backEndAuthenticate($json_data){
    $ch = curl_init();
    curl_setopt_array($ch, array(
  		CURLOPT_RETURNTRANSFER => 1,
  		CURLOPT_URL => "https://web.njit.edu/~bab29/alpha/back.php",
  		CURLOPT_USERAGENT => "POST Request to back",
  		CURLOPT_POST => 1,
  		CURLOPT_POSTFIELDS => $json_data
  	));
    $response = curl_exec($ch);
  	curl_close($ch);
  	return($response);
  }
  function main(){
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);
    $ucid = $data['user'];
    $pass = $data['pass'];
    if(njitAuthenticate($ucid,$pass)){
      echo("{'valid':'NJIT'}");
    }
    else{
      echo(backEndAuthenticate($json_data));
      // echo("{'valid':'none'}");
    }
  }
  // main();
?>
