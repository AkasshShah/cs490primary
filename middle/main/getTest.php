<?php
  // Author: Akassh Shah
  require("FuncDefs.php");
  function main(){
    $json_data=getJSONdata();
    // $url="https://web.njit.edu/~tdm24/cs490beta/backend/Test/getTest.php";//get test by test id
    $url=backEndLinks(10);
    $response=redirectBack($json_data, $url);
    echo($response);
  }
  main();
?>
