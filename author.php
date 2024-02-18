<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'opentutorials');
$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);



// author 테이블 생성
$table = "<table border='1'><th>ID</th><th>NAME</th><th>PROFILE</th>";

while ($row = mysqli_fetch_array($result)) {

   $filtered = array('id' => htmlspecialchars($row['id']), 'name' => htmlspecialchars($row['name']), 'profile' => htmlspecialchars($row['profile']));
   $table .=
      "<tr>
         <td>" . $filtered['id'] . "</td>
         <td>" . $filtered['name'] . "</td>
         <td>" . $filtered['profile'] . "</td>
         <td>
            <a href='author.php?id={$filtered['id']}'>수정</a>
         </td>
         <td>
            <form id='delete_form' action='process_delete_author.php' method='post' onsubmit='return confirm(\"정말로 삭제하시겠습니까?\")'>
            <input type='hidden' name='id' value=\"{$filtered['id']}\">
            <input type='submit' value='삭제'>
            </form>
         </td>
      </tr>";
}
;

$table .= "</table>";


// {
//    {1,1,egoing,egiong,developer,developer}
//    {2,2,duru,duru,DBA,DBA}
//    {...}
//    {...}
// }



?>

<!DOCTYPE html>
<html lang="ko">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WEB</title>
   <style>
      table {
         /* border: 1px solid red; */
         text-align: center;
         width: 500px;
         height: 50px;
      }

      table th {
         background-color: #FFDED9;
      }

      #container {
         margin: 0 auto;
         width: 500px;
         height: 300px;
      }

      #formbox {
         margin: 0 auto;
         width: 500px;
         height: 300px;
      }

      /* fieldset {
         background-color: #D6FFCE;
         margin: 0 auto;
         height: auto;
      } */
   </style>
</head>

<body>

   <!-- <script>
      function check_delete() {
         if(confirm("정말 삭제하시겠습니까?")){
            document.getElementById('delete_form').submit();
         }
      }
   </script>  -->

   <h1><a href='index.php'>WEB</a></h1>
   <hr>
   <h3><a href="index.php" style="border: 1px solid; background-color: #CFFFC5"> topic list</a></h3>

   <br><br>
   author list
   <?= $table ?>
   <hr>

   <?php

   $escaped = array('name' => '', 'profile' => '');
   $label_submit = '작가 정보 등록';
   $form_style = "background-color: #D6FFCE; margin: 0 auto; height: auto;";
   $form_action = "process_reg_author.php";
   $button_cancel = '';
   $hidden_id = '';

   if (isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
      settype($filtered_id, 'integer');
      $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $escaped['name'] = htmlspecialchars($row['name']);
      $escaped['profile'] = htmlspecialchars($row['profile']);
      $label_submit = '작가 정보 수정';
      $form_style = "background-color: #DCD8FF; margin: 0 auto; height: auto;";
      $form_action = "process_update_author.php";
      $button_cancel = "<button type='button' onclick='location.href=\"author.php\"'>수정 취소</button>";
      $hidden_id = "<form action='process_update_author.php' method='post'><input type='hidden' name='id' value='{$_GET['id']}'></from>";
   }

   ?>
   <div id='container'>
      <?= $hidden_id ?>
      <form action="<?= $form_action ?>" method="post" id='formbox'>
         <fieldset style="<?= $form_style ?>">
            <legend>작가 정보 입력</legend>
            <p><input type="text" placeholder="name" name="name" value="<?= $escaped['name'] ?>" required></p>
            <p><textarea name="profile" placeholder="profile" rows="10px" cols="40px"
                  required><?= $escaped['profile'] ?></textarea></p>
            <p><input type="submit" value="<?= $label_submit ?>">
               <?= $button_cancel ?>
            </p>
         </fieldset>
      </form>
   </div>

</body>



</html>