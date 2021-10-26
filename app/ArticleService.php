<?php
class APP__ArticleService { //콘트롤러에서 요청한 서비스 처리위헤 리포지터리에 요청
  private APP__ArticleRepository $articleRepository; //리포지터리 구조를 갖는 변수

  public function __construct() { //리포지터리 변수 인스턴스 생성    
    $this -> articleRepository = new APP__ArticleRepository;
  }
  public function getForPrintArticles(): array {
    return $this -> articleRepository -> getForPrintArticles();
  }

  public function getForPrintArticleById(int $id): array {
    return $this -> articleRepository -> getForPrintArticleById($id);
  }

  public function writeArticle(string $title, string $body): int {
    return $this -> articleRepository -> writeArticle($title, $body);
  }
}
?>