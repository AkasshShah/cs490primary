<?php
  // Author: Akassh Shah
  require("FuncDefs.php");
  function main(){
    $json_data=getJSONdata();
    // $url="https://web.njit.edu/~tdm24/cs490beta/backend/Question/getQuestion.php";
    $url=backEndLinks(3);
    $response=redirectBack($json_data, $url);
    echo($response);
  }
  main();
?>
