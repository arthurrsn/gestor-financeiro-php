<?php
session_start();

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["transacoes"])) {
    $_SESSION["transacoes"] = [];
}