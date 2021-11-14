<?php 

define('TEMPLATES_URL', __DIR__ .  '/templates');
define('FUNCIONES_URL', '/includes/funciones.php');
define('FOLDER_IMG', __DIR__ . '/../admin/img/');


function includeTemplate( $name ) {
    include TEMPLATES_URL . "/${name}.php";
}

function isAuth() : void {
    session_start();

    //login es true
    if (!$_SESSION['login']) {
        header('Location: /');
    }

}


function debug($item) {
    echo "<pre>";
    var_dump($item);
    echo "</pre>";
    exit;

}

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}