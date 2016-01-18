<?php
include_once 'curl.php';

$token = '24ab75a630bafe1f4234508bbd5c7b6d4d0bce7e'; // Token generado
$url = 'https://api.github.com/user/repos';
$crud = new curl;
$result = $crud->get($url, $token);
$resultado_json = (json_decode($result)); // Decodifica un string de JSON

if ((isset($_REQUEST['repositori']))) {
    echo '<h1 style="color: purple">' . $_REQUEST['repositori'] . ' de ' . $_REQUEST['user'] . '</h1>';

    $url_commits = 'https://api.github.com/repos/' . $_REQUEST['user'] . '/' . $_REQUEST['repositori'] . '/commits';
    $result = $crud->get($url_commits, $token);
    $resultado_json = (json_decode($result));

    foreach ($resultado_json as $repositori) {
        echo '<br>AUTOR: ' . $repositori->commit->author->name;
        echo '<br>FECHA: ' . $repositori->commit->committer->date;
        echo '<br>TITULO: ' . $repositori->commit->message;
        echo '<br>';
    }

    $url_readme = 'https://api.github.com/repos/' . $_REQUEST['user'] . '/' . $_REQUEST['repositori'] . '/readme/readme';
    $result = $crud->get($url_readme, $token);
    $resultado_json2 = (json_decode($result));

    if (isset($resultado_json2->content)) {
        echo base64_decode($resultado_json2->content);
    }
} else {
    echo '<h1 style="color: purple;">Repositori de iperiz</h1>';
    $contador = 0;
    foreach ($resultado_json as $repositori) {
        if ($repositori->owner->login == 'iperiz') {
            $contador++;
            echo '<a href="?repositori=' . $repositori->name . '&user=' . $repositori->owner->login . '">' . $contador . '. ' . $repositori->name . '<a/>';
            echo '<br>';
        }
    }
}
?>


<html>
    <head>
        <title>PR 10</title>
        <style>
            a{
                text-decoration: none;
                color: black;
            }
        </style>
    </head>
</html>
