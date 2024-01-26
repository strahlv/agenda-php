<?php

require_once '../Evento.php';
require_once '../helpers.php';

// CONFIG
session_start();
// session_destroy();

date_default_timezone_set('America/Bahia');

$eventos = [];

if (!isset($_SESSION['eventos'])) {
    $_SESSION['eventos'] = [];
    $_SESSION['last_id'] = 100;
} else {
    $eventos = $_SESSION['eventos'];
}

$display = isset($_GET['display']) && $_GET['display'] == 'list' ? 'list' : 'grid';
$year = isset($_GET['y']) ? $_GET['y'] : date('Y');
$month = isset($_GET['m']) ? $_GET['m'] : date('n');

// DELETE
if (isset($_GET['delete'])) {
    unset($_SESSION['eventos'][$_GET['delete']]);
    header("Location: /month?display=list&y=$year&m=$month");
}

// UPDATE
if (isset($_GET['update']) && isset($_POST['titulo'])) {
    $_SESSION['eventos'][$_GET['update']]->titulo = $_POST['titulo'];
    header("Location: /month?display=list&y=$year&m=$month");
} else {
    // CREATE
    if (isset($_POST['titulo'])) {
        $novoEvento = new Evento($_SESSION['last_id'], $_POST['titulo'], strtotime($_POST['data']));
        $_SESSION['eventos'][$_SESSION['last_id']] = $novoEvento;

        $_SESSION['last_id'] += 1;
        $month = date('n', $novoEvento->data);
        header("Location: /month?display=$display&y=$year&m=$month");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda PHP</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a783aedd26.js" crossorigin="anonymous"></script>
    <script src="jquery-3.7.1.js"></script>
    <script src="app.js"></script>
</head>

<body>