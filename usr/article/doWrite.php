<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

if (!isset($_GET['title'])) {
  echo "title을 입력해 주세요";
  exit;
}

if (!isset($_GET['body'])) {
  echo "내용을 입력해 주세요";
  exit;
}

$title = $_GET['title'];
$body = $_GET['body'];

$sql = "
INSERT INTO article SET regDate = NOW(), updateDate = NOW(), title = '${title}', `body` = '${body}'
";

mysqli_query($dbConn, $sql);

#echo "New record has id: " . mysqli_insert_id($dbConn);
#exit;

$id = mysqli_insert_id($dbConn);
?>
<script>
alert('<?=$id?>번 게시물이 생성되었습니다.');
location.replace('detail.php?id=<?=$id?>');
</script>