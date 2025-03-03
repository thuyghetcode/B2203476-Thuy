<?php
session_start();
//Xoa tat ca cac gia tri tron session
$_SESSION = array();

//Neu muon xoa hoan toan session, bao gom ca session cookie
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

//cuoi cung, huy session
session_destroy();

//Xoa cookie bang cách dat thoi gian het han la thoi gian tron qua khu
setcookie("user", "", time()-3600, "/");
setcookie("fullname", "", time() -3600, "/");
setcookie("id", "", time() - 3600, "/");

//chuyen huong den trang dăng nhap
header("Location: login.php");
exit;
?>
