<?php
// Sistema de sessão
session_start();

if (!isset($_SESSION['logado'])) {
    header('Location: pages/auth/login.php');
}

// Sistema de rota
switch ($_SESSION['acesso']) {
    case 'admin':
        header("Location: pages/admin/home.php");
        break;
    case 'cliente':
        header("Location: pages/cliente/home.php");
        break;
}
