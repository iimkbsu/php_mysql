<?php

$conn = mysqli_connect('127.0.0.1', 'root', '', 'opentutorials');

$filtered = array(
   'name' => mysqli_real_escape_string($conn, $_POST['name']),
   'profile' => mysqli_real_escape_string($conn, $_POST['profile'])
);

$sql = "INSERT INTO author (name, profile) VALUES ('{$filtered['name']}', '{$filtered['profile']}');";

$result = mysqli_query($conn, $sql);

if($result === false) {
   echo "등록하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.";
}else {
   echo "<script>alert('작가가 등록되었습니다.');
      window.location.href='author.php';
   </script>";
}

?>