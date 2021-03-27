<?php

//connexion PDO

define('HOSTNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', 'root'); //root pour la MAC et LINUX
define('DATABASE', 'paradise');

$dsn = 'mysql:host=' . HOSTNAME . ';dbname=' . DATABASE;

try { //on essaie de code...
    $pdo = new PDO($dsn, USERNAME, PASSWORD);
} catch (PDOException $e) { //...en cas d'erreur on la capture
    die('<ul><li>Erreur sur le fichier : ' . $e->getFile() . '</li><li>Erreur à la ligne ' . $e->getLine() . '</li><li>Message d\'erreur : ' . $e->getMessage() . '</li></ul>');
}


//variable d'affichage etc.

$content = "";

$champPrenom    = $_POST['prenom'] ?? null;
$champNom     = $_POST['nom'] ?? null;
$champCivilite    = $_POST['civilite'] ?? null;
$champMdp       = $_POST['mdp'] ?? null;
$champRepeatMdp       = $_POST['repeatmdp'] ?? null;
$champEmail       = $_POST['email'] ?? null;
$champAdresse       = $_POST['adresse'] ?? null;
$champTelephone       = $_POST['telephone'] ?? null;

//constantes systèmes

require 'config/function.php';

