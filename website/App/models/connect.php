<?php

class Connect
{
    var $localhost = "localhost";
    var $root = "root";
    var $passwd = "";
    var $database = "controlestoque";
    var $SQL;

    public function __construct()
    {
        $this->SQL = mysqli_connect($this->localhost, $this->root, $this->passwd);
        mysqli_select_db($this->SQL, $this->database);
        if (!$this->SQL) {
            die("Conexão com o banco de dados falhou!:" . mysqli_connect_error($this->SQL));
        }
    }

    function login($username, $password)
    {
        // Utilize prepared statements
        $query = "SELECT * FROM usuario WHERE username = ?";
        $stmt = mysqli_prepare($this->SQL, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $dados = mysqli_fetch_array($result);

            // Verifique a senha usando MD5
            if ($dados && md5($password) === $dados['Password']) {
                session_start();
                $_SESSION['idUsuario'] = $dados['idUser'];
                $_SESSION['usuario'] = $dados['Username'];
                $_SESSION['perm'] = $dados['Permissao'];
                header("Location:../pages/");
                exit();
            } else {
                header("Location:../login.php?alert=2");
                exit();
            }
        } else {
            header("Location:../login.php?alert=1");
            exit();
        }
    }
}

$connect = new Connect;
