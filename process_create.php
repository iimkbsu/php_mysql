<?php
//var_dump($_POST); POST메소드 확인용

$conn = mysqli_connect("127.0.0.1", "root", "", "opentutorials");

//sql 인젝션 막기
$filtered = array (
   'title' => mysqli_real_escape_string($conn, $_POST['title']),
   'description' => mysqli_real_escape_string($conn, $_POST['description'])
);

$sqlQuery = "INSERT INTO topic (title, description, created) VALUES (
   '{$filtered['title']}','{$filtered['description']}',NOW());";

//echo $sqlQuery; 올바른 쿼리 확인용

$result = mysqli_query($conn, $sqlQuery);

if ($result === false) {
   echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요";
   error_log(mysqli_error($conn));
} else {
   echo "<script>alert('글이 저장되었습니다.');
      window.location.href='index.php';</script>";

      //header("LOCATION:index.php");

}

?>