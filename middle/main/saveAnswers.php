<?php
  // Author: Akassh Shah
  require("FuncDefs.php");
  function main(){
    $json_data=getJSONdata();
    // $url="https://web.njit.edu/~tdm24/cs490beta/backend/Answer/saveAnswer.php";
    // $url='https://web.njit.edu/~tdm24/cs490beta/backend/answer/saveAnswer.php';
    $url=backEndLinks(5);
    $response=redirectBack($json_data, $url);
    echo($response);
  }
  main();
?>
