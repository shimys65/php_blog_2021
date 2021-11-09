<?php
class APP__ArticleRepository {
  public function getForPrintArticles(): array {
    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("ORDER BY A.id DESC");

  /*$articles = DB__getRows($sql);
    return $articles;
  */
    return DB__getRows($sql);
  }

  public function getForPrintArticleById($id):array {
    // $sql = " SELECT * FROM article AS A WHERE A.id = '${id}' ";

    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("WHERE A.id = ?", $id);

    return DB__getRow($sql);
  }

  public function writeArticle(string $title, string $body): int {
    /*
    $sql = "
    INSERT INTO article SET regDate = NOW(), updateDate = NOW(), 
    title = '${title}', `body` = '${body}' ";
    */

    // mysqli_query($dbConn, $sql);
    #echo "New record has id: " . mysqli_insert_id($dbConn);
    #exit;

    $sql = DB__secSql();
    $sql->add("INSERT INTO article");
    $sql->add("SET regDate = NOW()");
    $sql->add(", updateDate = NOW()");
    $sql->add(", title = ?", $title);
    $sql->add(", `body` = ?", $body);
    $id = DB__insert($sql);

    return $id;

    //$id = mysqli_insert_id($dbConn);
  }
}
?>