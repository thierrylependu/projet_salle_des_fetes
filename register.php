<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    if (!empty($_POST)) {        

        $query = $pdo->prepare('SELECT * FROM Account WHERE email =?');
        $query->execute([$_POST["mailAdress"]]);
        $verifyMail = $query->fetchAll(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("SELECT * FROM Account WHERE email =?");
        $query->bind_param("s",$_POST["mailAdress"]);
        $query->execute();
        $verifyMail = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        $query->close();    */        

        $query = $pdo->prepare('SELECT * FROM Account WHERE userName =?');
        $query->execute([$_POST["userName"]]);
        $verifyName = $query->fetchAll(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("SELECT * FROM Account WHERE userName =?");
        $query->bind_param("s", $_POST["userName"]);
        $query->execute();
        $verifyName = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        $query->close();  */          

        if (empty($verifyMail) && empty($verifyName)) {

            $hashPassword = hashPassword($_POST['password']);
      
            $query = $pdo->prepare('INSERT INTO Account (lastName, birthDate, email,userName, password, type) values (?,?,?,?,?,?)');
            $query->execute([$_POST["lastName"], $_POST["birthday"], $_POST["mailAdress"], $_POST["userName"], $hashPassword, $_POST["type"]]);
            $add = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("INSERT INTO Account (lastName, birthDate, email,userName, password, type) values (?,?,?,?,?,?)");        
            $query->bind_param("ssssss", $_POST["lastName"], $_POST["birthday"], $_POST["mailAdress"], $_POST["userName"], $hashPassword, $_POST["type"]);    
            $query->execute();
            $query->close();  */              

            if (array_key_exists("firstName", $_POST)) {
                $query = $pdo->prepare('UPDATE Account SET firstName = ? WHERE userName = ?');
                $query->execute([$_POST["firstName"], $_POST["userName"]]);
                $edit = $query->fetchAll(PDO::FETCH_ASSOC);

                /* $query = $mysqli->prepare("UPDATE Account SET firstName = ? WHERE userName = ?");        
                $query->bind_param("ss", $_POST["firstName"], $_POST["userName"]);    
                $query->execute();
                $query->close();  */                  
            }
            if (array_key_exists("phone", $_POST)) {
                $query = $pdo->prepare('UPDATE Account SET phoneNumber = ? WHERE userName = ?');
                $query->execute([$_POST["phone"], $_POST["userName"]]);
                $edit = $query->fetchAll(PDO::FETCH_ASSOC);

                /* $query = $mysqli->prepare("UPDATE Account SET phoneNumber = ? WHERE userName = ?");        
                $query->bind_param("ss", $_POST["phone"], $_POST["userName"]);    
                $query->execute();
                $query->close(); */   
            }
            if (array_key_exists("mobile", $_POST)) {
                $query = $pdo->prepare('UPDATE Account SET mobileNumber = ? WHERE userName = ?');
                $query->execute([$_POST["mobile"], $_POST["userName"]]);
                $edit = $query->fetchAll(PDO::FETCH_ASSOC);    
                
                /* $query = $mysqli->prepare("UPDATE Account SET mobileNumber = ? WHERE userName = ?");        
                $query->bind_param("ss", $_POST["mobile"], $_POST["userName"]);    
                $query->execute();
                $query->close();  */                  
            }
            if (array_key_exists("address", $_POST)) {
                $query = $pdo->prepare('UPDATE Account SET address = ? WHERE userName = ?');
                $query->execute([$_POST["address"], $_POST["userName"]]);
                $edit = $query->fetchAll(PDO::FETCH_ASSOC);
                
                /* $query = $mysqli->prepare("UPDATE Account SET address = ? WHERE userName = ?");        
                $query->bind_param("ss", $_POST["address"], $_POST["userName"]);    
                $query->execute();
                $query->close(); */                  
            }
            if (array_key_exists("city", $_POST)) {
                $query = $pdo->prepare('UPDATE Account SET city = ? WHERE userName = ?');
                $query->execute([$_POST["city"], $_POST["userName"]]);
                $edit = $query->fetchAll(PDO::FETCH_ASSOC);
                
                /* $query = $mysqli->prepare("UPDATE Account SET city = ? WHERE userName = ?");        
                $query->bind_param("ss", $_POST["city"], $_POST["userName"]);    
                $query->execute();
                $query->close(); */ 
            }
            if (array_key_exists("country", $_POST)) {
                $query = $pdo->prepare('UPDATE Account SET country = ? WHERE userName = ?');
                $query->execute([$_POST["country"], $_POST["userName"]]);
                $edit = $query->fetchAll(PDO::FETCH_ASSOC);
                
                /* $query = $mysqli->prepare("UPDATE Account SET country = ? WHERE userName = ?");        
                $query->bind_param("ss", $_POST["country"], $_POST["userName"]);    
                $query->execute();
                $query->close();  */
            }

            header("Location:index.php?register=success#navbar");

        }elseif (empty($verifyMail)) {
            header("Location:register.php?error=name#navbar");
        }else{
            header("Location:register.php?error=mail#navbar");
        }

    }

    $template = 'register';
    include 'layout.phtml';


?>