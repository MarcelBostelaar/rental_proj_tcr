<?php
//session_start();

$requestUri = $_SERVER['REQUEST_URI'];
$path = trim(parse_url($requestUri, PHP_URL_PATH), '/');

// 👉 Speciale routes voor acties
if ($path === 'logout') {
    require_once __DIR__ . '/../actions/logout.php';
    exit;
}

if ($path === 'login-handler') {
    require_once __DIR__ . '/../actions/login.php';
    exit;
}

if ($path === 'register-handler') {
    require_once __DIR__ . '/../actions/register.php';
    exit;
}

// 👉 Fallback naar pagina's
$page = $path ?: 'home';
$file = __DIR__ . '/../pages/' . $page . '.php';

if (file_exists($file)) {
    include $file;
} else {
    http_response_code(404);
    include __DIR__ . '/../pages/404.php';
}
