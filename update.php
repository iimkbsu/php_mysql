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

// $article = array(
//    'title' => 'Welcome',
//    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.
// Repellat excepturi nobis illum alias odit, numquam non vel,
// et quam est iste beatae ratione explicabo veniam distinctio sit accusamus, ipsum deleniti.'
// );

// $update_link = '';

if (isset($_GET['id'])) {

   //sql 인젝션 막기
   $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
   $getContsql = "SELECT * FROM topic WHERE id={$filtered_id}";

   $resultId = mysqli_query($conn, $getContsql);
   $row = mysqli_fetch_array($resultId);
   
   $article = array('title' => htmlspecialchars($row['title']), 'description' => htmlspecialchars($row['description']));

   //$update_link = "<a href=\"update.php?id=".$_GET['id']."\">글 수정하기</a>";
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WEB</title>

   <style>
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
      fieldset {
         background-color: #B6E9FF;
         margin: 0 auto;
         height: auto;
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
   <!-- <a href="create.php">글 작성하기</a> -->
   <!-- <?=$update_link?> -->


   <div id='container'>
      <form action="process_update.php" method="post" id='formbox'>
         <fieldset>
            <legend>글 수정</legend>
            <p><input type="hidden" name="id" value=<?=$_GET['id']?>></p>
            <p><input type='text' name='title' value='<?=$article['title']?>' required></p>
            <p><textarea name='description' rows='10' cols='50'required><?=$article['description']?></textarea></p>
            <input type='submit'> <button type='button' onclick="location.href='index.php'">취소</button>
         </fieldset>
      </form>
   </div>



</body>



</html>