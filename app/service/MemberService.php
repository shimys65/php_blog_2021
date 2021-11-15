<?php
class APP__MemberService { //콘트롤러에서 요청한 서비스 처리위헤 리포지터리에 요청
  private APP__MemberRepository $memberRepository; //리포지터리 구조를 갖는 변수

  public function __construct() { //리포지터리 변수 인스턴스 생성    
    global $App__memberRepository;
    $this->memberRepository = $App__memberRepository;
  }
  
  public function getForPrintMemberByLoginIdAndLoginPw
    (string $loginId, string $loginPw): array|null {

    return $this ->memberRepository -> getForPrintMemberByLoginIdAndLoginPw
      ($loginId, $loginPw);
  }  
}
?>