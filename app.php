<?php
class APP__UsrArticleController { //콘트롤러는 서비스 클래스에 요청
  private APP__ArticleService $articleService; //서비스 구조를 갖는 변수

  public function __construct() { //서비스 변수 인스턴스 생성    
    $this -> articleService = new APP__ArticleService;
  }

  public static function getViewPath($viewName) {
    return $_SERVER['DOCUMENT_ROOT'] . '/' . $viewName . '.view.php'; 
  }

  // 1. list.php를 처리하기 위한 함수.

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

  // 2. detail.php를 처리하기 위한 함수.
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
}

class APP__ArticleService { //콘트롤러에서 요청한 서비스 처리위헤 리포지터리에 요청
  private APP__ArticleRepository $articleRepository; //리포지터리 구조를 갖는 변수

  public function __construct() { //리포지터리 변수 인스턴스 생성    
    $this -> articleRepository = new APP__ArticleRepository;
  }
  public function getForPrintArticles() {
    return $this -> articleRepository -> getForPrintArticles();
  }

  public function getForPrintArticleById(int $id): array {
    return $this -> articleRepository -> getForPrintArticleById($id);
  }
}

class APP__ArticleRepository {
  public function getForPrintArticles() {
    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("ORDER BY A.id DESC");

  /*$articles = DB__getRows($sql);
    return $articles;
  */
    return DB__getRows($sql);
  }

  public function getForPrintArticleById($id) {
    // $sql = " SELECT * FROM article AS A WHERE A.id = '${id}' ";

    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("WHERE A.id = ?", $id);

    return DB__getRow($sql);
  }
}

function runApp($action) {
  /*다음 코드 전체는 list.php에서 사용했던 아래 두 라인의 코드를 대체하기위해 함수 runApp을 만들고 짜여진 코드 
  $usrArticleController = new APP__UsrArticleController();
  $usrArticleController -> actionShowList();
  */
  list($controllerTypeCode, $controllerName, $actionFuncName) = explode('/', $action);

// usr/article/list가 들어오면 APP__UsrArticleController로 변하여 controllerClassName에 저장
  $controllerClassName = "APP__" . ucfirst($controllerTypeCode) . ucfirst($controllerName) . "Controller";
//list.php의 $usrArticleController -> actionShowList(); 부분에서 actionShowList() 부분을 완성하기위해
// 먼저 action을 넣는 코드, 다음 if문 아래는 action 뒤의 Show와 Do를 구분하는 코드
  $actionMethodName = "action";

  if ( str_starts_with($actionFuncName, "do") ) { //do가 있으면(ex : doWrite) DoWrite로 변형
    $actionMethodName .= ucfirst($actionFuncName);
  }
  else { //do가 없으면 ShowList 같이 나옴.
    $actionMethodName .= "Show" . ucfirst($actionFuncName);
  }

  $usrArticleController = new $controllerClassName(); //new APP__UsrArticleController과 같음
  $usrArticleController->$actionMethodName(); // actionShowList()와 같음
}


