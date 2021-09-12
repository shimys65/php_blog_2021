<?php
$dbConn = mysqli_connect("127.0.0.1", "root", "", "php_blog_2021") or die("DB CONNECTION ERROR");

if ( isset($_GET['id']) == false ) {
  echo "id를 입력해주세요.";
  exit;
}

$id = intval($_GET['id']);

$sql = "
SELECT *
FROM article AS A
WHERE A.id = '${id}'
";
$rs = mysqli_query($dbConn, $sql);
$article = mysqli_fetch_assoc($rs);

if ( $article == null ) {
  echo "${id}번 게시물은 존재하지 않습니다.";
  exit;
}

print_r($article);
?>