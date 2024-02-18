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
$author = '';

if (isset($_GET['id'])) {

   //sql 인젝션 막기
   $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);

   //$getContsql = "SELECT * FROM topic WHERE id={$filtered_id}";
   $getContsql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id=author.id WHERE topic.id={$filtered_id}"; //topic 테이블을 author 테이블과 조인하여 한꺼번에 가져오기

   $resultId = mysqli_query($conn, $getContsql);
   $row = mysqli_fetch_array($resultId);

   //$article = array('title' => htmlspecialchars($row['title']), 'description' => htmlspecialchars($row['description']));
   $article = array('title' => htmlspecialchars($row['title']), 'description' => htmlspecialchars($row['description']), 'name' => htmlspecialchars($row['name']));

   $update_link = "<a id='bBox' href=\"update.php?id=" . $_GET['id'] . "\">글 수정</a>";

   // 기존 글 삭제 코드
   // $delete_link = '<form action="process_delete.php" method="post" style="display:inline">
   // <input type="hidden" name="id" value="' . $_GET['id'] . '">
   // <input type="submit" value="글 삭제"></form>';

   // 위의 글 삭제 코드에서 자바스크립트 confirm을 사용하여 삭제 전에 확인하는 방식 추가
   $delete_link = '<button type="button" onclick="check_delete()">글 삭제</button>
   <form id="delete" action="process_delete.php" method="post" style="display:inline">
   <input type="hidden" name="id" value="'.$_GET['id'].'">
   </form>';



   if ($article['name'] === '') {
      $author = "<b>by</b> NULL";
   } else {
      $author = "<b>by</b> " . $article['name'];
   }
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

   <script>
      //글 삭제 코드에서 자바스크립트 confirm을 사용하여 삭제 전에 확인하는 방식 추가
      function check_delete() {
         if(confirm("삭제하시겠습니까?")) {
            document.getElementById("delete").submit();
         }
      }
   </script>

   <h1><a href='index.php'>WEB</a></h1>
   <hr>
   <h3><a href="author.php" style="border: 1px solid; background-color: #CFFFC5">author</a></h3>
   <ol>
      <?= $list; ?>
   </ol>
   <div>
      <p>
      <h2>
         <?= $article['title'] ?>
      </h2>
      </p>
      <p>
         <?= $article['description'] ?>
      </p>
      <p>
         <?= $author ?>
      </p>
   </div>
   <br>
   <hr>
   <a href="create.php" id='aBox'>글 작성</a>
   <br><br>
   <?= $update_link ?>
   <?= $delete_link ?>

</body>



</html>