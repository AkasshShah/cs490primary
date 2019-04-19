<?php
  require("FuncDefs.php");
  errorReporting();
  function main(){
    $data=getJSONdataAndDecode();
    $arrayCriteria=array();
    $currentGrade=0;
    $question=$data['questionInfo'];
    $n=2;
    if($question['q_isWhile']=='yes'){
      $n+=1;
    }
    if($question['q_isFor']=='yes'){
      $n+=1;
    }
    if($question['q_isPrint']=='yes'){//this is when it should be printed.
      $n+=1;
    }
    $gr=40.0000/$n;
    $grade=array("colon"=>$gr;"name"=>$gr,"dowhile"=>$gr,"while"=>$gr,"for"=>$gr,"print"=>$gr,"testcases"=>60);
    $testing="";
    $comments="";
    if(getFuncNameFromText($data['studentAnswer'])!=FALSE){
      if(getFuncNameFromText($data['studentAnswer'])==$question['q_funcName']){
        $currentGrade+=$grade["name"];
        $arrayCriteria['FuncName']=array("Pass",0);
      }
      else{
        $comments.="function name not proper; function name should be ".$question['q_funcName'].", but is ".getFuncNameFromText($data['studentAnswer'])."|";
        $arrayCriteria['FuncName']=array("Fail",$grade["name"]);
      }
    }
    else{
      $comments.="function name not proper|";
      $arrayCriteria['FuncName']=array("FAIL",$grade["name"]);
      $testing.="exiting because of no function def found|";
      $feedback=array("comments"=>$comments,"currentGrade"=>$currentGrade,"testing"=>$testing,"gradingCriteria"=>$arrayCriteria);
      $feedback_json=json_encode($feedback);
      echo($feedback_json);
      return;
      exit();
    }
    $lines=explode('\n',$data['studentAnswer']);
    $defStuff=trim($lines[0],"\t");
    if(substr($defStuff,-1)!=":"){
      $comments.="colon not found at end of first line|";
      $arrayCriteria['colon']=array("Fail",$grade["colon"]);
      $lines[0]=$defStuff.":";
      $data['studentAnswer']=implode("\n",$lines);
    }
    else{
      $currentGrade+=$grade["colon"];
      $arrayCriteria['colon']=array("Pass",0);
    }
    if($question['q_isWhile']=='yes'){
      if(strpos($data['studentAnswer'],'while')!==false){
        $currentGrade+=$grade["dowhile"];
        $arrayCriteria['dowhile']=array("Pass",0);
      }
      else{
        $comments.="missing while loop|";
        $arrayCriteria['dowhile']=array("Fail",$grade["dowhile"]);
      }
    }
    if($question['q_isFor']=='yes'){
      if(strpos($data['studentAnswer'],'for')!==false){
        $currentGrade+=$grade["for"];
        $arrayCriteria['for']=array("Pass",0);
      }
      else{
        $comments.="missing for loop|";
        $arrayCriteria['for']=array("Fail",$grade["for"]);
      }
    }
    if($question['q_isPrint']=='yes'){
      if((strpos($data['studentAnswer'],'print')!==false)){
        $currentGrade+=$grade["print"];
        $arrayCriteria['print']=array("Pass",0);
      }
      else{
        $comments.="missing print|";
        $arrayCriteria['print']=array("Fail",$grade["print"]);
      }
    }





    // test cases stuff


    // $questions=explode(",",$data['q_ids']);
    $testcaseInputs=explode("|",$question['qtc_inputs']);
    $testcaseOutputs=explode("|",$question['qtc_outputs']);
    $numOfWorkingTestCases=0;
    $numbeOfTestCases=sizeof($testcaseInputs);
    $arrayCriteria['testcases']=array();
    // foreach($testcaseInputs as $testcase){
    for($i=0;$i<$numbeOfTestCases;$i++){
      $testcase=$testcaseInputs[$i];
      // writeTesting($testcase);
      writeToFile($data['studentAnswer'], $testcase);
      $output=execPythonFile();
      if((string)$output[0]==(string)$testcaseOutputs[$i]){
        $numOfWorkingTestCases++;
        $arrayCriteria['testcases'][(string)($i+1)]=array("Pass",0,array('shouldBe'=>(string)$testcaseOutputs[$i],'studGivesOut'=>(string)$output[0]));
        $currentGrade+=1.0*$grade['testcases']/$numbeOfTestCases;
      }
      else{
        $comments.="testcase ".($i+1)." does not match for".$data['q_id']."| ";
        $arrayCriteria['testcases'][(string)($i+1)]=array("Fail",1.0*$grade['testcases']/$numbeOfTestCases,array('shouldBe'=>(string)$testcaseOutputs[$i],'studGivesOut'=>(string)$output[0]));
      }
    }


    // writeToFile($data['studentAnswer'], $question['q_testcase1_in']);
    // $output=execPythonFile();
    // if((string)$output[0]==(string)$question['q_testcase1_out']){
    //   $numOfWorkingTestCases++;
    // }
    // else{
    //   $comments.="testcase1 does not match; ";
    // }
    // writeToFile($data['studentAnswer'], $question['q_testcase2_in']);
    // $output=execPythonFile();
    // if((string)$output[0]==(string)$question['q_testcase2_out']){
    //   $numOfWorkingTestCases++;
    // }
    //
    //
    // else{
    //   $comments.="testcase2 does not match; ";
    // }



    // end game
    if($currentGrade==100){
      $comments.="good|";
    }
    else{
      $comments.="can do better|";
    }
    $jsonArr=json_encode($arrayCriteria);
    // writeTesting("hello");
    $feedback=array("comments"=>$comments,"currentGrade"=>$currentGrade,"testing"=>$testing,"gradingCriteria"=>$jsonArr);
    // $feedback=array("comments"=>$comments,"currentGrade"=>$currentGrade,"testing"=>$testing);
    $feedback_json=json_encode($feedback);
    // writeTesting($feedback_json);
    echo($feedback_json);
  }
  main();
?>
