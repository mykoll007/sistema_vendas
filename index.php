<?php
session_start();

$base_url = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if (!isset($_SESSION['token'])) {
    header("Location: $base_url/frontend/home.php");
    exit();
} elseif ($_SESSION['user_type'] === 'admin') {
    header("Location: $base_url/frontend/admin_dashboard.php");
    exit();
} elseif ($_SESSION['user_type'] === 'operador'){
    header("Location: $base_url/frontend/pedidos.php");
    exit();
} else {
    header("Location: $base_url/frontend/home.php");
    exit();
}

exit();
?>