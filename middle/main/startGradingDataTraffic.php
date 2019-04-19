<?php
  // Author: Akassh Shah
  error_reporting(E_ALL);
  ini_set('display_errors' , 1);
  require("FuncDefs.php");
  function main(){
    $json_data=getJSONdata();
    // $url="https://web.njit.edu/~tdm24/cs490beta/backend/Grade/startGrade.php";
    $url=backEndLinks(8);
    $response=redirectBack($json_data, $url);
    echo($response);
  }
  main();
?>
