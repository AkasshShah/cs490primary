<?php
  // Author: Akassh Shah
  require("FuncDefs.php");
  error_reporting(E_ALL);
  ini_set('display_errors' , 1);
  function main(){
    $json_data=getJSONdata();
    // $url="https://web.njit.edu/~tdm24/cs490beta/backend/Question/getQuestionBank.php";
    $url=backEndLinks(2);
    // $url="asdfasdf";
    // echo($url);
    $response=redirectBack($json_data, $url);
    echo($response);
  }
  main();
?>
