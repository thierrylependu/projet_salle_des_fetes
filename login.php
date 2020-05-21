<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';

    $log = "empty";

    if (!empty($_POST)) {

            $query = $pdo->prepare('SELECT * FROM Account WHERE email = ?');
            $query->execute([$_POST["identifiant"]]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("SELECT * FROM Account WHERE email = ?");
            $query->bind_param("s", $_POST["identifiant"]);
            $query->execute();
            $user = $query->get_result()->fetch_assoc();
            $query->close(); */               

            if (empty($user)) {
                $query = $pdo->prepare('SELECT * FROM Account WHERE userName = ?');
                $query->execute([$_POST["identifiant"]]);
                $user = $query->fetch(PDO::FETCH_ASSOC);

                /* $query = $mysqli->prepare("SELECT * FROM Account WHERE userName = ?");
                $query->bind_param("s", $_POST["identifiant"]);
                $query->execute();
                $user = $query->get_result()->fetch_assoc();
                $query->close();   */                     

            }

            if (!empty($user)  && $_POST["identifiant"] !== "slider"){
                if (verifyPassword($_POST['mdp'], $user['password'])) {
                        $_SESSION["id"] = $user["id"];
                        $_SESSION["firstName"] = $user["firstName"];
                        $_SESSION["lastName"] = $user["lastName"];
                        $_SESSION["userName"] = $user["userName"];
                        $_SESSION["role"] = $user["role"];
                        $_SESSION["ban"] = $user["ban"];
                        $log = "ok";
                    } else {
                        $log = "mdp";
                    }
                
        
            } else{
                $log = "id";
            }
        

    }

    if ($log === "ok") {
        header("Location:index.php#navbar");
    }else {
        header("Location:index.php?error=".$log);
    }
?>