<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

$pageTitle = "게시물 작성";
?>
<?php require_once __DIR__ . "/../head.php"; ?>

<form action="doWrite.php">
  <div>
    <span>제목</span>
    <input required placeholder="제목을 입력해주세요." type="text" name="title"> 
  </div>
  <div>
    <span>내용</span>
    <textarea required placeholder="내용을 입력해주세요." name="body"></textarea>
  </div>
  <!--
    http://localhost/usr/article/doWrite.php?title=제목1&body=내용2
  -->
  <div>
    <input type="submit" value="글작성">
  </div>
</form>

<?php require_once __DIR__ . "/../foot.php"; ?> 