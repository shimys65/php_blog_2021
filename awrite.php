<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시물작성</title>
</head>
<body>
  <h1>게시물작성</h1>
  <hr>  

  <form action="adoWrite.php">
    <div>
      <p><label>제목<input required placeholder="제목을 입력"
      type="text" name="title"></label></p>
    </div>
    <div>
    <p><label>내용<textarea required placeholder="내용을 입력"
      name="body"></textarea></label></p>
    </div>
    <div>
      <input type="submit" value="글작성">
    </div>
  </form>
  
  <?php require_once __DIR__ . "/../foot.php"; ?> 