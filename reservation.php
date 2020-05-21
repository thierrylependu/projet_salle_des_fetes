<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    

    $template = 'reservation';
    include 'layout.phtml';


?>