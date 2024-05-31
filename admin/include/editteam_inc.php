<?php
// Include the database connection details
require_once "dbcon_inc.php";

// Define the function to fetch a record by ID
function fetchRecordById($record_id) {
    global $host, $dbname, $username, $password;

    try {
        $dsn = "mysql:host=localhost;dbname=skyline";
        $dbusername = "root";
        $dbpassword = "";
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to fetch record by ID
        $stmt = $pdo->prepare("SELECT * FROM my_team WHERE team_id = :record_id");
        // Bind the parameter
        $stmt->bindParam(':record_id', $record_id);
        // Execute the query
        $stmt->execute();

        // Fetch the record
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return $record; // Return the fetched record
    } catch(PDOException $q) {
        // Handle database connection errors
        echo "Connection failed: " . $q->getMessage();
        return null; // Return null if an error occurs
    } finally {
        // Close the database connection
        $pdo = null;
    }
}
?>
