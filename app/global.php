<?php
// 리포지터리
$App__articleRepository = new APP__ArticleRepository();
$App__memberRepository = new APP__MemberRepository();

// 서비스 전역변수
$App__articleService = new APP__ArticleService();
$App__memberService = new APP__MemberService();

// 뷰에서 사용할 이용자의 로그인 상태관련 전역변수
$App__isLogined = false;
$App__loginedMemberId = 0;
$App__loginedMember = null;