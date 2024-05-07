<?php
require_once "../config/config.php";
require_once "../lib/KaasConnectionDB/kaasConnectionDB.php";

// receber dados da requisição
$email = htmlspecialchars($_POST['txt_email']);
$senha = htmlspecialchars($_POST['txt_senha']);

// conectar ao banco de dados
$db = new KaasConnectionDB();

$resultado = $db->select("SELECT U.id, U.email, U.senha, P.nivel AS acesso 
                                  FROM usuario AS U
                                  INNER JOIN privilegio AS P
                                  ON U.acesso = P.id
                                  WHERE U.email LIKE('" . $email . "');");

// se usuário não existir
if(!count($resultado)){
    echo "error";
    return;
}

$usuario = $resultado[0];

// se password não esta correcta
if(!password_verify($senha,$usuario['senha'])){
    echo "error";
    return;
}


session_start();
$_SESSION['id'] = $usuario['id'];
$_SESSION['email'] = $usuario['email'];
$_SESSION['acesso'] = $usuario['acesso'];
$_SESSION['logado'] = true;


echo "success";
