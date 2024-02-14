<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'opentutorials');
$sql = "SELECT * FROM topic LIMIT 1000";
$result = mysqli_query($conn, $sql);
$list = null;

while ($row = mysqli_fetch_array($result)) {

   //html script 인젝션 막기
   $escapted_title = htmlspecialchars($row['title']);

   //<li><a href='index.php?id=테이블의id값'>해당 id의 title</a></li>
   $list = $list . "<li><a href='index.php?id={$row['id']}'>{$escapted_title}</a></li>";
}

$article = array(
   'title' => 'Welcome',
   'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
Repellat excepturi nobis illum alias odit, numquam non vel,
et quam est iste beatae ratione explicabo veniam distinctio sit accusamus, ipsum deleniti.'
);

$update_link = '';
$delete_link = null;

if (isset($_GET['id'])) {

   //sql 인젝션 막기
   $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
   $getContsql = "SELECT * FROM topic WHERE id={$filtered_id}";

   $resultId = mysqli_query($conn, $getContsql);
   $row = mysqli_fetch_array($resultId);

   $article = array('title' => htmlspecialchars($row['title']), 'description' => htmlspecialchars($row['description']));

   $update_link = "<a id='bBox' href=\"update.php?id=" . $_GET['id'] . "\">글 수정</a>";
   $delete_link = '<form action="process_delete.php" method="post">
   <input type="hidden" name="id" value="' . $_GET['id'] . '">
   <input type="submit" value="글 삭제"></form>';
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WEB</title>
   <style>
      #aBox {
         border: 2px solid #D99AFA;
         background-color: #E0C8ED;
         color: #50037A;
      }

      #bBox {
         border: 2px solid #3AA5ED;
         background-color: #C0E0F5;
         color: #013150;
      }

   </style>
</head>

<body>

   <h1><a href='index.php'>WEB</a></h1>

   <hr>
   <ol>
      <?= $list; ?>
   </ol>
   <div>
      <?= "<h2>" . $article['title'] . "</h2>"
         . $article['description'];
      ?>
   </div>
   <br>
   <hr>
   <a href="create.php" id='aBox'>글 작성</a>
   <?= $update_link ?>
   <br><br>
   <?= $delete_link ?>
</body>



</html>