<?php
  /*
    Author: Akassh Shah
		File: web.njit.edu/~as2757/cs490/middle/main/FuncDefs.php
  */
	function errorReporting(){
		error_reporting(E_ALL);
		ini_set('display_errors' , 1);
		return;
	}
	function njitWeb(){
		return("https://web.njit.edu/");
		// return("afsaccess1.njit.edu/");
	}
	function getJSONdata(){
		$json_data = file_get_contents("php://input");
		return($json_data);
	}
	function getJSONdataAndDecode(){
		$json_data=getJSONdata();
		$data = json_decode($json_data, true);
		return($data);
	}
	function backEndAuthenticateLogin($ucid, $password){
		$array=array("ucid"=>$ucid, "password"=>$password);
		$json_data=json_encode($array);
    $ch = curl_init();
		$url=backEndLinks(0);
    curl_setopt_array($ch, array(
  		CURLOPT_RETURNTRANSFER => 1,
  		// CURLOPT_URL => "https://web.njit.edu/~tdm24/TSbeta/login.php",
			CURLOPT_URL => $url,
  		CURLOPT_USERAGENT => "POST Request to back",
  		CURLOPT_POST => 1,
  		CURLOPT_POSTFIELDS => $json_data
  	));
    $response = curl_exec($ch);
  	curl_close($ch);
  	return($response);
  }
	function getQuestionFromQuestionID($id){
		$data['id']=(int)$id;
    $json_data=json_encode($data);
		// $url="https://web.njit.edu/~tdm24/cs490beta/backend/Question/getQuestion.php";
		$url=backEndLinks(3);
    $output=redirectBack($json_data, $url);
		$arrayQ=json_decode($output,true);
		return($arrayQ);
	}
	function getQuestionInTest($test_id,$stud_id,$q_id){//actually gets answer for that test question by that student
		// $data['test_id_in']=$test_id;
		// $data['stud_userid_in']=$stud_id;
		// $data['q_id_in']=$q_id;
		$data['t_id']=$test_id;
		$data['stud_id']=$stud_id;
		$data['q_id']=$q_id;
		// $url="https://web.njit.edu/~tdm24/CS490model/Answer/getA.php";
		$url=backEndLinks(6);
		return(jsonEncodeSendAndGetResult($data,$url));
		// return('Hi');
	}
	function getAnswer($t_id,$stud_id,$q_id){
		$data['t_id']=(int)$t_id;
		$data['stud_id']=(int)$stud_id;
		$data['q_id']=(int)$q_id;
		$url=backEndLinks(6);
		// echo($url);
		// echo(json_encode($data));
		return(jsonEncodeSendAndGetResult($data,$url));
	}
	function backEndLinks($num){
		$initial=njitWeb();
		$links=array(
			$initial."~tdm24/CS490model/login.php",                 //0
			$initial."~tdm24/CS490model/Question/addQ.php",         //1
			$initial."~tdm24/CS490model/Question/listQ.php",        //2
			$initial."~tdm24/CS490model/Question/getQ.php",         //3
			$initial."~tdm24/CS490model/Test/addT.php",             //4
			$initial."~tdm24/CS490model/Answer/saveA.php",          //5
			$initial."~tdm24/CS490model/Answer/getA.php",           //6
			$initial."~tdm24/CS490model/Grade/saveG.php",           //7
			$initial."~tdm24/CS490model/Grade/startG.php",          //8
			$initial."~tdm24/CS490model/Test/listT.php",            //9
			$initial."~tdm24/CS490model/Test/getT.php",             //10
			$initial."~tdm24/CS490model/Grade/saveGb.php"           //11
		);
		return($links[$num]);
	}
	function getFuncNameFromText($text){
		if(strpos($text,'def')===false){
			return(FALSE);
		}
    $result=preg_split('/def/',$text);
    if(count($result)>1){
      $result_split=explode(' ',$result[1]);
    }
    $func=strstr($result_split[1], '(', true);
    // echo($func);
    return($func);
  }
	function redirectBack($json_data, $url){
		// $array=array("ucid"=>$ucid, "password"=>$password);
		// $json_data=json_encode($array);
    $ch = curl_init();
    curl_setopt_array($ch, array(
  		CURLOPT_RETURNTRANSFER => 1,
  		// CURLOPT_URL => "https://web.njit.edu/~tdm24/TSbeta/login.php",
			CURLOPT_URL => $url,
  		CURLOPT_USERAGENT => "POST Request to back",
  		CURLOPT_POST => 1,
  		CURLOPT_POSTFIELDS => $json_data
  	));
    $response = curl_exec($ch);
  	curl_close($ch);
  	return($response);
	}
	function execPythonFile(){
		$filepathname="gradingWorkSpace/test.py";
    $command = "python ".$filepathname." 2>&1";
    exec($command, $output);
    return($output);
  }
	function execPythonFileAndPrint($filepathname){
		$output=execPythonFile($filepathname);
		print_r($output);
		return($output);
	}
	function writeToFile($text, $testcase1){
    // text will look like:
    // def my_func(x):
    //     return(x)
		$filepathname="gradingWorkSpace/test.py";
    $text.="\n"."print(".getFuncNameFromText($text)."(".$testcase1."))\n";
    $fp=fopen($filepathname,'w+');
    fwrite($fp, $text);
    fclose($fp);
  }
	function writeTesting($text){
		$filepathname="gradingWorkSpace/comments.txt";
		$text="\n\n".$text."\n\n";
		$fp=fopen($filepathname,'a+');
    fwrite($fp, $text);
    fclose($fp);
	}
	function jsonEncodeSendAndGetResult($data,$url){
		$json_data=json_encode($data);
		$output=redirectBack($json_data, $url);
		$rtn=json_decode($output, true);
		return($rtn);
	}
	function gradeQuestion($data){
		// $data=array("q_id"=>$qid,"studentAnswer"=>$studentAnswer);
		$json_data=json_encode($data);
		$url="https://web.njit.edu/~as2757/cs490/middle/main/gradeOneQuestion.php";
    $output=redirectBack($json_data, $url);
		// echo($output);
		$rtn=json_decode($output,true);
		return($rtn);
	}
?>
