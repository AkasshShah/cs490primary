<?php
  require("FuncDefs.php");
  errorReporting();
  function main(){
    $data=getJSONdataAndDecode();
    $url=$data[0];
    $json_data=$data[1];
    echo(redirectBack($json_data, $url));
  }
  main();
?>
