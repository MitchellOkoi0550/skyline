<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $team_name = $_POST["teamname"];
    $team_position = $_POST["teamposition"];
    $team_image = file_get_contents($_FILES["teamimage"]["tmp_name"]);

    try {
        require_once "dbcon_inc.php";

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO my_team (team_name, team_position, team_image) VALUES (:teamname, :teamposition, :teamimage);";
        $stmt  = $pdo->prepare($query);

        $stmt->bindParam(":teamname", $team_name);
        $stmt->bindParam(":teamposition", $team_position);
        $stmt->bindParam(":teamimage", $team_image, PDO::PARAM_LOB);

        $stmt->execute();

        session_start();
        $_SESSION['success_message'] = "Record saved successfully.";

        $pdo = null;
        $stmt = null;

        header("Location: ../addteam.php"); 
        exit();
    } catch (PDOException $q) {
        die("Query failed: " . $q->getMessage());
    }
}
else {
    header("Location: ../addteam.php");
    exit();
}
?>
