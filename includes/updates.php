<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $email = $_POST["email"];

    try {
        require_once "dbhinc.php";

        $query = "INSERT INTO updates (email) VALUES (:email);";

        $stmt  = $pdo->prepare($query);

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record saved successfully.";

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php"); 


        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e ->getMessage());
    }
}
else {
    header("Location: ../index.php");
}
?>
