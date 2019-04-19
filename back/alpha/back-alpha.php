<?php
  /*
    Author: Akassh Shah
  */
  require("FuncDefs.php");
  require("account.php");
  function main(){
    connectDB($db, $flag_c);
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);
    $ucid = $data['user'];
    $password = $data['pass'];
    if(ucidPass($db,$ucid,$password)){
      // echo("{'valid':'database'}");
      echo("NJIT Login Doesn't Work. Database Login Works");
    }
    else{
      // echo('{"valid":"none"}');
      echo("NJIT Login Doesn't Work. Database Login Doesn't Work");
    }
    closeDB($db);
  }
  main();
?>
