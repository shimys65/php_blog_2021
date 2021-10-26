<?php
class APP__UsrArticleController { //콘트롤러는 서비스 클래스에 요청
  private APP__ArticleService $articleService; //서비스 구조를 갖는 변수

  public function __construct() { //서비스 변수 인스턴스 생성    
    $this -> articleService = new APP__ArticleService;
  }

  public static function getViewPath($viewName) {
    return $_SERVER['DOCUMENT_ROOT'] . '/' . $viewName . '.view.php'; 
  }

  // 1. write.php를 처리하기 위한 함수.
  public function actionShowWrite() {
    require_once static::getViewPath("usr/article/write");
  }

  public function actionDoWrite() {
    /*
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
    */

    $title = getStrValueOr($_GET['title'], "");
    $body = getStrValueOr($_GET['body'], "");

    if ( !$title ) {
      jsHistoryBackExit("제목을 입력해주세요.");
    }

    if ( !$body ) {
      jsHistoryBackExit("내용을 입력해주세요.");
    }

    $id = $this -> articleService -> writeArticle($title, $body);

    /*
    <script>
    alert('<?=$id?>번 게시물이 생성되었습니다.');
    location.replace('detail.php?id=<?=$id?>');
    </script>
    */
    jsLocationReplaceExit("detail.php?id=${id}", "${id}번 게시물이 생성되었습니다.");
  }

  // 2. list.php를 처리하기 위한 함수.

  public function actionShowList() {     //리스트 내용을 받기위한 절차
              // 리스트 받기위해 프린트아티클에 요청하고 변수 article에 내용 전부를 넘겨줌.
              // 순서는 콘트롤러 쇼리스트->서비스 프린트아티클->리포지터 리프린트아티클
              // $articles가 list.view로 가서 출력 해줌.

    $articles = $this -> articleService -> getForPrintArticles(); 

                /* var_dump($articles); 리스트 내용을 전부 출력해서 보여줌.
                exit; */

                //출력을 위해 list.view.php를 require를 사용 연결 함.   
    require_once static::getViewPath("usr/article/list");
  }

  // 3. detail.php를 처리하기 위한 함수.
  public function actionShowDetail() {
    $id = getIntValueOr($_GET['id'], 0);

    if ( $id == 0 ) {
      jsHistoryBackExit("번호를 입력해주세요.");
    }

    $article = $this -> articleService -> getForPrintArticleById($id); 

    if ( !$article) {    // $article == null
      jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
    }

    require_once static::getViewPath("usr/article/detail");
  }

  public function actionShowModify() {
    $id = getIntValueOr($_GET['id'], 0);

    if ( $id == 0 ) {
      jsHistoryBackExit("번호를 입력해주세요.");
    }

    $article = $this -> articleService -> getForPrintArticleById($id);    
    
    if ( $article == null ) {
      jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
    }

    require_once static::getViewPath("usr/article/modify");
  }
}
?>