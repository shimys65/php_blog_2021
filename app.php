<?php
require_once __DIR__ . '/app/repository/MemberRepository.php';
require_once __DIR__ . '/app/repository/ArticleRepository.php';

require_once __DIR__ . '/app/service/MemberService.php';
require_once __DIR__ . '/app/service/ArticleService.php';

require_once __DIR__ . '/app/controller/MemberController.php';
require_once __DIR__ . '/app/controller/ArticleController.php';

function App__getViewPath($viewName) {
  return __DIR__ . '/public/' . $viewName . '.view.php';
}

function App__run($action) {
  /*다음 코드 전체는 list.php에서 사용했던 아래 두 라인의 코드를 대체하기위해 함수 runApp을 만들고 짜여진 코드
  코드의 $usrArticleController = new $controllerClassName();는 아래 코드로 변환
  $usrArticleController = new APP__UsrArticleController();

  코드의 $usrArticleController->$actionMethodName();은 아래 코드로 변환, 만들어진 인스탄스에의해 
  actionShowList() 함수 실행
  $usrArticleController -> actionShowList();

  require_once __DIR__ . '/app/controller/ArticleController.php';에 의해 
  /app/controller/ArticleController.php에서 실행되며 이것이 없으명 에러
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

  $usrArticleController = new $controllerClassName(); //new APP__UsrArticleController()와 같음
  $usrArticleController->$actionMethodName(); // actionShowList()와 같음
}
?>