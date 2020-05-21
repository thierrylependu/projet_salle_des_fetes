<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    $query = $pdo->prepare('SELECT * FROM Account WHERE id = ?');
    $query->execute([$_SESSION["id"]]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    /* $query = $mysqli->prepare("SELECT * FROM Account WHERE id = ?");
    $query->bind_param("i", $_SESSION["id"]);
    $query->execute();
    $user = $query->get_result()->fetch_assoc();
    $query->close();        */


    if (!empty($_POST)) {
        if (array_key_exists("add", $_POST)) {
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
                $query = $pdo->prepare('INSERT INTO Reservation (client, date, heure,email, adminComment, userId) values (?,?,?,?,?,?)');
                $query->execute([$_SESSION["userName"], $_POST["day"], $_POST["hour"], $user["email"], $_POST["comment"], $user["id"]]);
                $add = $query->fetchAll(PDO::FETCH_ASSOC);
                
               /*  $query = $mysqli->prepare("INSERT INTO Reservation (client, date, heure,email, adminComment, userId) values (?,?,?,?,?,?)");        
                $query->bind_param("sssssi", $_SESSION["userName"], $_POST["day"], $_POST["hour"], $user["email"], $_POST["comment"], $user["id"]);    
                $query->execute();
                $query->close();  */ 
    
                $query = $pdo->prepare('SELECT * FROM Reservation WHERE date = ? AND Heure = ?');
                $query->execute([$_POST["day"], $_POST["hour"]]);
                $res = $query->fetch(PDO::FETCH_ASSOC);

                /* $query = $mysqli->prepare("SELECT * FROM Reservation WHERE date = ? AND Heure = ?");
                $query->bind_param("ss", $_POST["day"], $_POST["hour"]);
                $query->execute();
                $res = $query->get_result()->fetch_assoc();
                $query->close();   */   
                
                $query = $pdo->prepare('INSERT INTO Events (name, comment, date, heure, resId) values (?,?,?,?,?)');
                $query->execute([$_POST["title"], $_POST["comment"], $_POST["day"], $_POST["hour"], $res["id"]]);
                $add = $query->fetchAll(PDO::FETCH_ASSOC);

                /* $query = $mysqli->prepare("INSERT INTO Events (name, comment, date, heure, resId) values (?,?,?,?,?)");        
                $query->bind_param("ssssi", $_POST["title"], $_POST["comment"], $_POST["day"], $_POST["hour"], $res["id"]);    
                $query->execute();
                $query->close(); */                 

            }
    
        }
        if (array_key_exists("delete", $_POST)) {

            $query = $pdo->prepare('DELETE FROM Events WHERE id = ?');            
            $query->execute([$_POST["delete"]]);
            $delete = $query->fetchAll(PDO::FETCH_ASSOC);

           /*  $query = $mysqli->prepare("DELETE FROM Events WHERE id = ?");        
            $query->bind_param("i", $_POST["delete"]);    
            $query->execute();
            $query->close();  */            

            $query = $pdo->prepare('DELETE FROM Reservation WHERE id = ?');            
            $query->execute([$_POST["res"]]);
            $delete = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("DELETE FROM Reservation WHERE id = ?");        
            $query->bind_param("i", $_POST["res"]);    
            $query->execute();
            $query->close();     */        

        }
        if (array_key_exists("modif", $_POST)) {
            $query = $pdo->prepare('UPDATE Events SET name = ?, comment = ? WHERE id = ?');            
            $query->execute([$_POST["title"], $_POST["comment"], $_POST["id"]]);
            $edit = $query->fetchAll(PDO::FETCH_ASSOC); 

            /* $query = $mysqli->prepare("UPDATE Events SET name = ?, comment = ? WHERE id = ?");        
            $query->bind_param("ssi", $_POST["title"], $_POST["comment"], $_POST["id"]);    
            $query->execute();
            $query->close();     */
        }

    }

    $query = $pdo->prepare('SELECT * FROM `Events`');
    $query->execute();
    $events = $query->fetchAll(PDO::FETCH_ASSOC);

    /* $query = $mysqli->prepare("SELECT * FROM `Events`");
    $query->execute();
    $events = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    $query->close();   */ 
      


    $template = 'evenements';
    include 'layout.phtml';


?>