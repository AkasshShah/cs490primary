<?php
  require("FuncDefs.php");
  errorReporting();
  function main(){
    $data=getJSONdataAndDecode();
    /*
      In:
        $data['stud_user']= user details of the student taking the test
        $data['test_id']= id number of the test that he took and I have to grade
        $data['q_ids']= string that has all the q_ids in that test separated by commas, and has no spaces
    */
    /*
      Out:
    */
    // $questions=explode(",",$data['q_ids']);
    // $arr=array();
    // foreach($questions as $q_id){
    //   $qit=getAnswer($data['test_id'],$data['stud_user'],$q_id);
    //   $feedback=gradeQuestion($q_id,$qit['answer']);
    //   $jsonGradingCriteria=$feedback['gradingCriteria'];
    //   $arr[$q_id]=array('test_id'=>$data['test_id'],'stud_user'=>$data['stud_user'],'q_id'=>$q_id,'grade'=>($feedback['currentGrade']*$qit['points'])/100.0000, 'comments'=>"", 'gradingCriteria'=>$jsonGradingCriteria);
    // }
    $sendBackArray=array();
    $count=0;
    foreach($data as $question){
      $questionInfo=$question[0];
      $studentAnswer=$question[1]['answer'];
      $questionWorth=$question[1]['value'];
      $a_id=$question[1]['a_id'];
      $arr=array('studentAnswer'=>$studentAnswer,'questionInfo'=>$questionInfo);
      $feedback=gradeQuestion($arr);
      $sendBackArray[$count]=array('a_id'=>$a_id,'grade'=>(($feedback['currentGrade']*$questionWorth)/(100.0)),'comments'=>$feedback['comments'],'gradingCriteria'=>$feedback['gradingCriteria']);
      $count+=1;
    }
    $url=backEndLinks(7);
    $json_dataaaa=json_encode($sendBackArray);
    $rtn=redirectBack($json_dataaaa,$url);
    echo($rtn);
  }
  main();
?>
