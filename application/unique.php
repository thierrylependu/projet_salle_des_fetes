<?php

function getMail(){
    include 'application/bdd_connect.php';
    if (!empty($_SESSION)) {
        if ($_SESSION["role"] === "admin") {            
            $query = $pdo->prepare('SELECT id AS mail FROM Message WHERE status = "Non lu"');
            $query->execute();
            $mail = $query->fetchAll(PDO::FETCH_ASSOC);
            
            /* $query = $mysqli->prepare("SELECT id AS mail FROM Message WHERE status = 'Non lu'");
            $query->execute();
            $mail = $query->get_result()->fetch_all(MYSQLI_ASSOC);
            $query->close();   */ 

            return sizeof($mail);
        }
    }
}

?>