<?php
session_start();
session_unset();
session_destroy();

// توجيه المستخدم لصفحة تسجيل الدخول في الواجهة الأمامية
header("Location: ../frontend/login.php");
exit;
?>