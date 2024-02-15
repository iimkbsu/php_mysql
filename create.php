<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'opentutorials');
$sql = "SELECT * FROM topic LIMIT 1000";
$result = mysqli_query($conn, $sql);
$list = null;

while ($row = mysqli_fetch_array($result)) {
   //<li><a href='index.php?id=테이블의id값'>해당 id의 title</a></li>
   $list .= "<li><a href='index.php?id={$row['id']}'>{$row['title']}</a></li>";
}


// author 테이블 사용하기위해 초기화
$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);

//<select name='name'><option>이름</option></select>
$name_opt = "<select name='author_id'>";
while($row = mysqli_fetch_array($result)) {
   $name_opt = $name_opt."<option value=".$row['id'].">".$row['name']."</option>";
}
$name_opt .= "</select>";

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
         background-color: cornsilk;
         margin: 0 auto;
         height: auto;
      }
   </style>
</head>

<body>
   <h1><a href='index.php'>WEB</a></h1>
   <ol>
      <?= $list; ?>
   </ol>

   <div id='container'>
      <form action="process_create.php" method="post" id='formbox'>
         <fieldset>
            <legend>새 글 입력</legend>
            <p><input type='text' name='title' placeholder="title" required></p>
            <p><textarea name='description' placeholder='description' rows='10' cols='50'required></textarea></p>

            <p>작성자 : <?=$name_opt?></p>

            <input type='submit'> <button type='button' onclick="location.href='index.php'">취소</button>
         </fieldset>
      </form>
   </div>
</body>

</html>