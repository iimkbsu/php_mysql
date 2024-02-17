<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'opentutorials');
$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);




$table = "<table border='1'><th>ID</th><th>NAME</th><th>PROFILE</th>";
while ($row = mysqli_fetch_array($result)) {

   $filtered = array('id' => htmlspecialchars($row['id']), 'name' => htmlspecialchars($row['name']), 'profile' => htmlspecialchars($row['profile']));
   $table .= "<tr><td>" . $filtered['id'] . "</td><td>" . $filtered['name'] . "</td><td>" . $filtered['profile'] . "</td><td><a href='process_update_author.php'>수정</a></td><td><a href='process_delete_author.php'>삭제</a></td></tr>";
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
      fieldset {
         background-color: #D6FFCE;
         margin: 0 auto;
         height: auto;
      }
   </style>
</head>

<body>

   <h1><a href='index.php'>WEB</a></h1>
   <hr>
   <h3><a href="index.php" style="border: 1px solid; background-color: #CFFFC5"> topic list</a></h3>

   <br><br>
   author list
   <?= $table ?>
   <hr>

   <div id='container'>
      <form action="process_reg_author.php" method="post" id='formbox'>
         <fieldset>
            <legend>작가 정보 입력</legend>
            <p><input type="text" placeholder="name" name="name"></p>
            <p><textarea name="profile" placeholder="profile" rows="10px" cols="40px"></textarea></p>
            <p><input type="submit" value="작가 정보 등록"></p>
         </fieldset>
      </form>
   </div>

</body>



</html>