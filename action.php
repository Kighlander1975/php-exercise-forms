<?php
session_start();
$data = [];
$data = $_POST;
$path = __DIR__ . '/tasks.txt';

if(empty($data['task']) || empty($data['description'])) {
    
    $_SESSION['error'] = "Task and Description are required";
    header("location: index.php");
}

$dir = dirname($path);
if (!is_dir($dir) || !is_writable($dir)) {
    $_SESSION['error'] = 'Speicherort ist nicht beschreibbar.';
    header('Location: index.php');
    exit;
}

// "a" erstellt die Datei, wenn sie nicht existiert
$file = @fopen($path, 'a');
if ($file === false) {
    $_SESSION['error'] = 'Datei konnte nicht geöffnet/erstellt werden.';
    header('Location: index.php');
    exit;
}

// Zeile schreiben
$line = ($data['task'] ?? '') . ' - ' . ($data['description'] ?? '') . PHP_EOL;
if (fwrite($file, $line) === false) {
    fclose($file);
    $_SESSION['error'] = 'Schreiben in Datei fehlgeschlagen.';
    header('Location: index.php');
    exit;
}

fclose($file);
$_SESSION['success'] = 'Aufgabe erfolgreich gespeichert';
header('Location: index.php');
exit;