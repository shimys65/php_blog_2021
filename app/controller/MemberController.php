<?php
class APP__UsrMemberController { //콘트롤러는 서비스 클래스에 요청
  private APP__MemberService $memberService; //서비스 구조를 갖는 변수

  public function __construct() { //서비스 변수 인스턴스 생성    
    global $App__memberService;
    $this->memberService = $App__memberService;
  }

  public static function getViewPath($viewName) {
    return $_SERVER['DOCUMENT_ROOT'] . '/' . $viewName . '.view.php'; 
  }

  // login.php를 처리하기 위한 함수.
  public function actionShowLogin() {
    require_once static::getViewPath("usr/member/login");
  }

  public function actionDoLogin() {
    if ( isset($_GET['loginId']) == false ) {
      echo "loginId를 입력해주세요.";
      exit;
    }
    
    if ( isset($_GET['loginPw']) == false ) {
      echo "loginPw를 입력해주세요.";
      exit;
    }
    
    // 기존 코드는 아래와 같이 입력이 되면, 해킹이 된다.
    // loginId=user1
    // loginPw=' OR '' = '
    
    //$loginId = mysqli_real_escape_string($dbConn, $_GET['loginId']);
    //$loginPw = mysqli_real_escape_string($dbConn, $_GET['loginPw']);
    
    $loginId = $_GET['loginId'];
    $loginPw = $_GET['loginPw'];    
   
    $member = $this->memberService->getForPrintMemberByLoginIdAndLoginPw($loginId, $loginPw);
    
    if ( empty($member) ) {
      jsHistoryBackExit("일치하는 회원이 존재하지 않습니다.");
    }
    
    $_SESSION['loginedMemberId'] = $member['id'];
    //echo session_id();
    //echo $_SESSION['loginedMemberId'];
    //var_dump($_SESSION);
    //exit;
    
    jsLocationReplaceExit("../article/list.php", "{$member['nickname']}님 환영합니다.");
  } 

  public function actionDoLogout() {
    unset($_SESSION['loginedMemberId']); //로그인된 멤버의 session을 해제
    jsLocationReplaceExit("../article/list.php"); //로그아웃되면 list.php로 이동
  }
}
?>