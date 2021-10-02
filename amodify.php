<?php
$dbcon = mysqli_connect("127.0.0.1", "root", "", "php_blog_2021");

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
$rs = mysqli_query($dbcon, $sql);
$article = mysqli_fetch_assoc($rs);

if ( $article == null ) {
  echo "${id}번 게시물은 존재하지 않습니다.";
  exit;
}
?>

<?php $pageTitle = "게시물 수정, ${id}번 게시물"; ?>
<?php require_once __DIR__ . "/../head.php"; ?>  
  <div>
    <a href="alist.php">글 리스트</a>
    <a href="adetail.php?id=<?=$id?>">원문</a>
  </div>
  <hr>

  <form action="doModify.php">
  <input type="hidden" name="id" value="<?=$article['id']?>"> 
  <div>
      <span>번호</span>
      <span><?=$article['id']?></span>
    </div>
    <div>
      <span>제목</span>
      <input required placeholder="제목을 입력해주세요." type="text" name="title" 
      value="<?=$article['title']?>"> 
    </div>
    <div>
      <span>내용</span>
      <textarea required placeholder="내용을 입력해주세요." name="body">
        <?=$article['body']?></textarea>
    </div>
    <div>
      <input type="submit" value="글수정">
    </div>
  </form>
  <?php require_once __DIR__ . "/../foot.php"; ?> 