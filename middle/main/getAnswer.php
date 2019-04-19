<?php
  // Author: Akassh Shah
  require("FuncDefs.php");
  function main(){
    $data=getJSONdataAndDecode();
    /*
      $data['test_id']: test id for which the grades and answers and comments are wanted
      $data['q_ids']: the question ids in a string seperated by commas and no spaces, of the questions that are in the test
      $data['stud_user']: the grades and all for that particular student id
    */
    $questions=explode(",",$data['q_ids']);
    $arr=array();
    $arr['test_id']=$data['test_id'];
    $arr['stud_user']=$data['stud_user'];
    foreach($questions as $q_id){
      $qit=getQuestionInTest($data['test_id'],$data['stud_user'],$q_id);
      $arr[$q_id]=$qit;
    }
    echo(json_encode($arr));
  }
  main();
?>
