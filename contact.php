<?php

    session_start();
    include 'application/bdd_connect.php';
    include 'application/lib.php';
    include 'application/unique.php';

    $mailSend = false;
    if (!empty($_POST)) {
        $query = $pdo->prepare('INSERT INTO Message (name, email,text, type, phone) values (?,?,?,?,?)');
        $query->execute([$_POST["name"],$_POST["email"],$_POST["comment"],$_POST["type"],$_POST["phone"]]);
        $add = $query->fetchAll(PDO::FETCH_ASSOC);

       /*  $query = $mysqli->prepare("INSERT INTO Message (name, email,text, type, phone) values (?,?,?,?,?)");        
        $query->bind_param("sssss", $_POST["name"],$_POST["email"],$_POST["comment"],$_POST["type"],$_POST["phone"]);    
        $query->execute();
        $query->close();   */
        $mailSend = true;
    }

    function getEmail($id){
      include 'application/bdd_connect.php';
      $query = $pdo->prepare('SELECT * FROM `Account` WHERE id =?');
      $query->execute([$id]);
      $account = $query->fetch(PDO::FETCH_ASSOC);

      /* $query = $mysqli->prepare("SELECT * FROM `Account` WHERE id =?");
      $query->bind_param("i", $id);
      $query->execute();
      $account = $query->get_result()->fetch_assoc();
      $query->close();   */ 
      return $account["email"];
    }

    function getPhone($id){
      include 'application/bdd_connect.php';
      $query = $pdo->prepare('SELECT * FROM `Account` WHERE id =?');
      $query->execute([$id]);
      $account = $query->fetch(PDO::FETCH_ASSOC);

      /* $query = $mysqli->prepare("SELECT * FROM `Account` WHERE id =?");
      $query->bind_param("i", $id);
      $query->execute();
      $account = $query->get_result()->fetch_assoc();
      $query->close();    */

      
      if ($account["phoneNumber"] !== null) {
        return $account["phoneNumber"];
      } elseif ($account["mobileNumber"] !== null) {
        return $account["mobileNumber"];
      } else{
        return 0;
      }
    }

    $template = 'contact';
    include 'layout.phtml';


?>