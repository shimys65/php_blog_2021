<?php
class APP__MemberRepository {

  public function getForPrintMemberByLoginIdAndLoginPw
    (string $loginId, string $loginPw):array|null {
    // $sql = " SELECT * FROM article AS A WHERE A.id = '${id}' ";

    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM `member` AS M");
    $sql->add("WHERE M.loginId = ?", $loginId);
    $sql->add("AND M.loginPw = ?", $loginPw);
    
    //echo $sql;
    //exit;

    return DB__getRow($sql);
  }  
}

?>