<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION["idUsuario"]) || !isset($_SESSION["usuario"])) {
    header('Location:../login.php');
} else {
    $idUsuario = $_SESSION["idUsuario"];
    $usuario = $_SESSION["usuario"];
    $perm = $_SESSION["perm"];
}
