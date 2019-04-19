<?php
  require("../main/FuncDefs.php");
  // echo("great");
  $data['q_id']=37;
  $question=getQuestionFromQuestionID($data['q_id']);
?>
<html>
  <body>
    <<?php
    echo("Question:<br />");
    print_r($question);
    ?>>
    <form action="grading.php" method="post">
      <textarea name="ans" cols="40" rows="5"></textarea>
      <input name="submit" type="submit" value="submit" /><br />
    </form>
  </body>
</html>
