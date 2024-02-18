<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'opentutorials');

settype($_POST['id'], 'integer');

$filtered = array(
   'id' => mysqli_real_escape_string($conn, $_POST['id']),
   'name' => mysqli_real_escape_string($conn, $_POST['name']),
   'profile' => mysqli_real_escape_string($conn, $_POST['profile'])
);

$sql = "UPDATE author SET name='{$filtered['name']}', profile='{$filtered['profile']}' WHERE id={$filtered['id']}";

$result = mysqli_query($conn, $sql);

if($result === false) {
   echo "수정하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.";
}else {
   echo "<script>alert('작가 정보가 수정되었습니다.');
      window.location.href='author.php';
   </script>";
}
?>