<?php

$conn = mysqli_connect('127.0.0.1', 'root', '', 'opentutorials');

settype($_POST['id'], 'integer');

$filtered = array('id'=>mysqli_real_escape_string($conn, $_POST['id']));
$sql = "DELETE FROM topic WHERE id={$filtered['id']}";

$result = mysqli_query($conn, $sql);

if ($result === false) {
   echo "삭제하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
   //error_log(mysqli_error($conn));
} else {
   echo "<script>alert('글이 삭제되었습니다.');
      window.location.href='index.php';</script>";

      //header("LOCATION:index.php");

}

?>