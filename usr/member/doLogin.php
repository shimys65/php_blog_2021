<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/webInit.php';

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

$sql = "
SELECT * FROM `member` AS M 
WHERE M.loginId = ?
AND M.loginPw = ?
";

$stmt = $dbConn->prepare($sql);
$stmt->bind_param('ss', $loginId, $loginPw);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

if ( empty($member) ) {
  jsHistoryBackExit("일치하는 회원이 존재하지 않습니다.");
}

$_SESSION['loginedMemberId'] = $member['id'];
//echo session_id();
//echo $_SESSION['loginedMemberId'];
//var_dump($_SESSION);
//exit;

jsLocationReplaceExit("../article/list.php", "{$member['nickname']}님 환영합니다.");

