<?php
  // Author: Akassh Shah
  error_reporting(E_ALL);
  ini_set('display_errors' , 1);
  require("FuncDefs.php");
  function main(){
    $json_data=getJSONdata();
    // $url="https://web.njit.edu/~tdm24/cs490beta/backend/Question/addQuestion.php";
    // $url="https://web.njit.edu/~tdm24/cs490model/Question/addQ.php";
    $url=backEndLinks(1);
    $response=redirectBack($json_data, $url);
    echo($response);
  }
  main();
?>
