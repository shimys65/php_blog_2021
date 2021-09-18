<?php
$dbConn = mysqli_connect("127.0.0.1", "root", "", "php_blog_2021") or die("DB CONNECTION ERROR");

$sql = "
SELECT *
FROM article AS A
ORDER BY A.id DESC
";
$rs = mysqli_query($dbConn, $sql);

$articles = [];

while ( $article = mysqli_fetch_assoc($rs) ) {
  $articles[] = $article;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시물 리스트</title>
</head>
<body>
  <h1>게시물 리스트</h1>
  <hr>
  <div>
    <a href="write.php">글 작성</a>
  </div>
  <hr>
  <div>
    <?php foreach ( $articles as $article ) { ?>
      <?php
      $detailUri = "detail.php?id=${article['id']}";
      ?>
      <a href="<?=$detailUri?>">번호 : <?=$article['id']?></a><br>
      작성 : <?=$article['regDate']?><br>
      수정 : <?=$article['updateDate']?><br>
      <a href="<?=$detailUri?>">제목 : <?=$article['title']?></a><br>
      내용 : <?=$article['body']?></a><br>
    <hr>
    <?php } ?>
  </div>
</body>
</html>