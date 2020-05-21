<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';


    if (!empty([$_POST])) {
      $query = $pdo->prepare('SELECT * FROM `Account` WHERE id =?');
      $query->execute([$_SESSION["id"]]);
      $user = $query->fetch(PDO::FETCH_ASSOC);

      /* $query = $mysqli->prepare("SELECT * FROM `Account` WHERE id =?");
      $query->bind_param("i", $_SESSION["id"]);
      $query->execute();
      $user = $query->get_result()->fetch_assoc();
      $query->close(); */



      if(isset($_POST["lastName"])){
          if($_POST["lastName"] != $user["lastName"]){
            $query = $pdo->prepare('UPDATE Account SET lastName = ? WHERE id = ?');
            $query->execute([$_POST["lastName"], $_SESSION["id"]]);
            $edit = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("UPDATE Account SET lastName = ? WHERE id = ?");        
            $query->bind_param("si", $_POST["lastName"], $_SESSION["id"]);    
            $query->execute();
            $query->close(); */
          }
      }

      if(isset($_POST["firstName"])){
        if($_POST["firstName"] != $user["firstName"]){
          $query = $pdo->prepare('UPDATE Account SET firstName = ? WHERE id = ?');
          $query->execute([$_POST["firstName"], $_SESSION["id"]]);
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET firstName = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["firstName"], $_SESSION["id"]);    
          $query->execute();
          $query->close(); */
        }
     }
     if(isset($_POST["birthday"])){
        if($_POST["birthday"] != $user["birthDate"]){
          $query = $pdo->prepare('UPDATE Account SET birthDate = ? WHERE id = ?');
          $query->execute([$_POST["birthday"], $_SESSION["id"]]);
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET birthDate = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["birthday"], $_SESSION["id"]);    
          $query->execute();
          $query->close(); */
        }
      }
      if(isset($_POST["mailAdress"])){
        $query = $pdo->prepare('SELECT * FROM Account WHERE email =?');
        $query->execute([$_POST["mailAdress"]]);
        $verifyMail = $query->fetchAll(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("SELECT * FROM Account WHERE email =?");
        $query->bind_param("s", $_POST["mailAdress"]);
        $query->execute();
        $verifyMail = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        $query->close(); */

        if($_POST["mailAdress"] != $user["email"] && empty($verifyMail)){           
            $query = $pdo->prepare('UPDATE Account SET email = ? WHERE id = ?');            
            $query->execute([$_POST["mailAdress"], $_SESSION["id"]]);           
            $edit = $query->fetchAll(PDO::FETCH_ASSOC);

            /* $query = $mysqli->prepare("UPDATE Account SET email = ? WHERE id = ?");        
            $query->bind_param("si", $_POST["mailAdress"], $_SESSION["id"]);    
            $query->execute();
            $query->close(); */
        }
      }
      if(isset($_POST["phone"])){
        if($_POST["phone"] != $user["phoneNumber"]){
          $query = $pdo->prepare('UPDATE Account SET phoneNumber = ? WHERE id = ?');       
          $query->execute([$_POST["phone"], $_SESSION["id"]]);       
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET phoneNumber = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["phone"], $_SESSION["id"]);    
          $query->execute();
          $query->close();   */
        }
      }
      if(isset($_POST["mobile"])){
        if($_POST["mobile"] != $user["mobileNumber"]){
          $query = $pdo->prepare('UPDATE Account SET mobileNumber = ? WHERE id = ?');        
          $query->execute([$_POST["mobile"], $_SESSION["id"]]);       
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET mobileNumber = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["mobile"], $_SESSION["id"]);    
          $query->execute();
          $query->close();  */ 
        }
      }
      if(isset($_POST["address"])){
        if($_POST["address"] != $user["address"]){
          $query = $pdo->prepare('UPDATE Account SET address = ? WHERE id = ?');        
          $query->execute([$_POST["address"], $_SESSION["id"]]);        
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET address = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["address"], $_SESSION["id"]);    
          $query->execute();
          $query->close(); */    
        }
      }
      if(isset($_POST["city"])){
        if($_POST["city"] != $user["city"]){
          $query = $pdo->prepare('UPDATE Account SET city = ? WHERE id = ?');        
          $query->execute([$_POST["city"], $_SESSION["id"]]);        
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET city = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["city"], $_SESSION["id"]);    
          $query->execute();
          $query->close();  */     
        }
      }
      if(isset($_POST["country"])){
        if($_POST["country"] != $user["country"]){
          $query = $pdo->prepare('UPDATE Account SET country = ? WHERE id = ?');        
          $query->execute([$_POST["country"], $_SESSION["id"]]);        
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET country = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["country"], $_SESSION["id"]);    
          $query->execute();
          $query->close();  */    
        }
      }
      if(isset($_POST["userName"])){
        $query = $pdo->prepare('SELECT * FROM Account WHERE userName =?');
        $query->execute([$_POST["userName"]]);
        $verifyName = $query->fetchAll(PDO::FETCH_ASSOC);

        /* $query = $mysqli->prepare("SELECT * FROM Account WHERE userName =?");
        $query->bind_param("s", $_POST["userName"]);
        $query->execute();
        $verifyName = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        $query->close();  */

        if($_POST["userName"] != $user["userName"] && empty($verifyName)){
          $query = $pdo->prepare('UPDATE Account SET userName = ? WHERE id = ?');        
          $query->execute([$_POST["userName"], $_SESSION["id"]]);        
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET userName = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["userName"], $_SESSION["id"]);    
          $query->execute();
          $query->close();     */
        }
      }
      if(isset($_POST["password"])){
        $hashPassword = hashPassword($_POST['password']);
          $query = $pdo->prepare('UPDATE Account SET password = ? WHERE id = ?');        
          $query->execute([$hashPassword, $_SESSION["id"]]);        
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET password = ? WHERE id = ?");        
          $query->bind_param("si", $hashPassword, $_SESSION["id"]);    
          $query->execute();
          $query->close();  */    
      }
      if(isset($_POST["type"])){
        if($_POST["type"] != $user["type"]){
          $query = $pdo->prepare('UPDATE Account SET type = ? WHERE id = ?');        
          $query->execute([$_POST["type"], $_SESSION["id"]]);
          $edit = $query->fetchAll(PDO::FETCH_ASSOC);

          /* $query = $mysqli->prepare("UPDATE Account SET type = ? WHERE id = ?");        
          $query->bind_param("si", $_POST["type"], $_SESSION["id"]);    
          $query->execute();
          $query->close(); */   
        }
      }
    }


  $query = $pdo->prepare('SELECT * FROM `Account` WHERE id =?');
  $query->execute([$_SESSION["id"]]);
  $account = $query->fetch(PDO::FETCH_ASSOC);

  /* $query = $mysqli->prepare("SELECT * FROM `Account` WHERE id =?");
  $query->bind_param("i", $_SESSION["id"]);
  $query->execute();
  $account = $query->get_result()->fetch_assoc();
  $query->close();    */

    $template = 'compte';
    include 'layout.phtml';


?>