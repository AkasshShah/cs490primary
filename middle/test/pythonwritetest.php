<?php
  error_reporting(E_ALL);
  ini_set('display_errors' , 1);
  function getFuncNameFromText($text){
    $result=preg_split('/def/',$text);
    if(count($result)>1){
      $result_split=explode(' ',$result[1]);
    }
    $func=strstr($result_split[1], '(', true);
    // echo($func);
    return($func);
  }
  function writeToFile($text, $filepathname){
    // text will look like:
    // def my_func(x):
    //     return(x)
    $text.="\n"."print(".getFuncNameFromText($text)."('testcase1'))";
    $fp=fopen($filepathname,'w');
    fwrite($fp, $text);
    fclose($fp);
  }
  function execPythonFile($filepathname){
    $command = "python ".$filepathname." 2>&1";
    exec($command, $output);
    return($output);
  }
  function main(){
    $text="def myfunc(x):\n"."    return(y)";
    $filepathname="../main/gradingWorkSpace/test.py";
    writeToFile($text,$filepathname);
    // echo("done");
    $output=execPythonFile($filepathname);
    print_r($output[0]);
    if($output[0]=="testcase1"){
      echo("Wow");
    }
    else{
      print_r($output);
    }
  }
  main();
?>
