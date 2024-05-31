<?php
// Check if the post_id parameter is set in the URL
if(isset($_GET['post_id'])) {
    // Retrieve the post_id from the URL
    $post_id = $_GET['post_id'];

    $dbHOST = $_ENV['MYSQLHOST'] ?? 'localhost';
                    $dbUSER = $_ENV['MYSQLUSER'] ?? 'root';
                    $dbPASSWORD = $_ENV['MYSQLPASSWORD'] ?? '';
                    $dbPORT = $_ENV['MYSQLPORT'] ?? 3306;
                    $dbname = $_ENV['MYSQLDATABASE'] ?? 'skyline';
                    $dsn = "mysql:host={$dbHOST};dbname={$dbname}";
                    // $dbusername = "root";
                    // $dbpassword = "";

                    
                        

    // Assuming you're using PDO for database operations
    // Establish database connection
    $pdo = new PDO($dsn, $dbUSER, $dbPASSWORD);
    
    // Prepare and execute the SQL query to fetch the post details
    $stmt = $pdo->prepare("SELECT * FROM my_post WHERE post_ID = :post_id");
    $stmt->execute(['post_id' => $post_id]);
    
    // Fetch the post details
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
