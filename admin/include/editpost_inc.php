<?php
// Include the database connection details
require_once "dbcon_inc.php";

// Define the function to fetch a record by ID
function fetchRecordById($record_id) {
    global $host, $dbname, $username, $password;

    try {
        $dbHOST = $_ENV['MYSQLHOST'] ?? 'localhost';
        $dbUSER = $_ENV['MYSQLUSER'] ?? 'root';
        $dbPASSWORD = $_ENV['MYSQLPASSWORD'] ?? '';
        $dbPORT = $_ENV['MYSQLPORT'] ?? 3306;
        $dbname = $_ENV['MYSQLDATABASE'] ?? 'skyline';
        $dsn = "mysql:host={$dbHOST};dbname={$dbname}";
        $pdo = new PDO($dsn, $dbUSER, $dbPASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement to fetch record by ID
        $stmt = $pdo->prepare("SELECT * FROM my_post WHERE post_id = :record_id");
        // Bind the parameter
        $stmt->bindParam(':record_id', $record_id);
        // Execute the query
        $stmt->execute();

        // Fetch the record
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        return $record; // Return the fetched record
    } catch(PDOException $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
        return null; // Return null if an error occurs
    } finally {
        // Close the database connection
        $pdo = null;
    }
}
?>
