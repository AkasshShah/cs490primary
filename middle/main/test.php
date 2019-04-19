<?php
  // Author: Akassh Shah
  error_reporting(E_ALL);
  ini_set('display_errors' , 1);
  require("FuncDefs.php");
  function main(){
    $json_data=getJSONdata();
    writeTesting("\nxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx".$json_data."\n\n\nxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");
    // echo("Hello");
  }
  main();

?>
