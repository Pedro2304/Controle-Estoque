<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'Models/connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<script>alert('Você deve digitar seu nome e senha');</script>";
        echo "<script>window.location.href='..login.php'</script>";
        exit;
    } else {
        $connect = new Connect;
        $connect->login($username, $password);
    }
} else {
    // Redirecionar para a página de login se não for uma solicitação POST
    header('Location: ../login.php');
    exit;
}
