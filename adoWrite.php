<?php
$dbcon = mysqli_connect("127.0.0.1", "root", "", "php_blog_2021");

if( !isset($_GET['title'])) {
  echo "title을 입력하시오.";
  exit;
}

if( !isset($_GET['body'])) {
  echo "body를 입력하시오.";
  exit;
}

$title = $_GET['title'];
$body = $_GET['body'];

$sql = "INSERT INTO article SET
  regDate = NOW(),
  updateDate = NOW(),
  title = '${title}',
  'body' = '${body}'
";

mysqli_query($dbcon, $sql);

$id = mysqli_insert_id($dbcon);
?>

<script>
alert('<?=$id?>번 게시물이 생성되었습니다.');
location.replace('adetail.php?id=<?=$id?>');
</script>