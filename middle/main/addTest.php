<?php
  // Author: Akassh Shah
  require("FuncDefs.php");
  function main(){
    $json_data=getJSONdata();
    // $url="https://web.njit.edu/~tdm24/cs490beta/backend/Test/addTest.php";
    // $url="https://web.njit.edu/~tdm24/cs490model/Test/addT.php";
    $url=backEndLinks(4);
    $response=redirectBack($json_data, $url);
    echo($response);
  }
  main();
?>
