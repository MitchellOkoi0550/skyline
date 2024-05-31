<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $username = $_POST["username"];
    $email = $_POST["email"];
    $services = $_POST["floatingSelect"];

    try {
        require_once "dbhinc.php";

        $query = "INSERT INTO quotes (username, email, services) VALUES (:username, :email, :floatingSelect);";

        $stmt  = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":floatingSelect", $services);

        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record saved successfully.";

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php"); 
 
        die();
    } catch (PDOException $m) {
        die("Query failed: " . $m ->getMessage());
    }
}
else {
    header("Location: ../index.php");
}
?>
