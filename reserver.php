<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    if (!empty($_SESSION)) {
      $query = $pdo->prepare('SELECT * FROM `Account` WHERE id =?');
      $query->execute([$_SESSION["id"]]);
      $account = $query->fetch(PDO::FETCH_ASSOC);

      /* $query = $mysqli->prepare("SELECT * FROM `Account` WHERE id =?");
      $query->bind_param("i", $_SESSION["id"]);
      $query->execute();
      $account = $query->get_result()->fetch_assoc();
      $query->close();    */     
    }

    $done = false;
    if (!empty($_POST)) {
      $query = $pdo->prepare('SELECT * FROM `Reservation` WHERE date =?');
      $query->execute([$_POST["day"]]);
      $reserv = $query->fetchAll(PDO::FETCH_ASSOC);

      /* $query = $mysqli->prepare("SELECT * FROM `Reservation` WHERE date =?");
      $query->bind_param("s", $_POST["day"]);
      $query->execute();
      $reserv = $query->get_result()->fetch_all(MYSQLI_ASSOC);
      $query->close();  */     

        $full = false;
        foreach($reserv as $res){
            if ($res["Heure"] === $_POST["hour"] || $res["Heure"] === "jour") {
                $full = true;
            }
        }
        if ($_POST["hour"] === "jour" && count($reserv) > 0) {
            $full = true;
        }

        if (!$full) {
            $query = $pdo->prepare('INSERT INTO Reservation (client, date, heure,email) values (?,?,?,?)');
            $query->execute([$_POST["lastName"], $_POST["day"], $_POST["hour"], $_POST["email"]]);
            $add = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("INSERT INTO Reservation (client, date, heure,email) values (?,?,?,?)");        
            $query->bind_param("ssss", $_POST["lastName"], $_POST["day"], $_POST["hour"], $_POST["email"]);    
            $query->execute();
            $query->close();    */           

                if (array_key_exists("phone", $_POST)) {
                    $query = $pdo->prepare('UPDATE Reservation SET phone = ? WHERE date = ? AND heure = ?');
                    $query->execute([$_POST["phone"], $_POST["day"], $_POST["hour"]]);  
                    $edit = $query->fetchAll(PDO::FETCH_ASSOC);

                    /* $query = $mysqli->prepare("UPDATE Reservation SET phone = ? WHERE date = ? AND heure = ?");        
                    $query->bind_param("sss", $_POST["phone"], $_POST["day"], $_POST["hour"]);    
                    $query->execute();
                    $query->close(); */                     
                }
                if (!empty($_SESSION)) {
                    $query = $pdo->prepare('UPDATE Reservation SET userId = ? WHERE date = ? AND heure = ?');
                    $query->execute([$_SESSION["id"], $_POST["day"], $_POST["hour"]]);
                    $edit = $query->fetchAll(PDO::FETCH_ASSOC);
                    
                    /* $query = $mysqli->prepare("UPDATE Reservation SET userId = ? WHERE date = ? AND heure = ?");        
                    $query->bind_param("iss", $_SESSION["id"], $_POST["day"], $_POST["hour"]);    
                    $query->execute();
                    $query->close(); */                     
                }
            $done = true;
        }
    }

    $template = 'reserver';
    include 'layout.phtml';


?>