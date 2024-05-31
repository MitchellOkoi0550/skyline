<?php
$dbHOST = $_ENV['MYSQLHOST'] ?? 'localhost';
$dbUSER = $_ENV['MYSQLUSER'] ?? 'root';
$dbPASSWORD = $_ENV['MYSQLPASSWORD'] ?? '';
$dbPORT = $_ENV['MYSQLPORT'] ?? 3306;
$dbname = $_ENV['MYSQLDATABASE'] ?? 'skyline';
$dsn = "mysql:host={$dbHOST};dbname={$dbname}";
// $dbusername = "root";
// $dbpassword = "";
// $dbusername = "root";
// $dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbUSER, $dbPASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "conncetion failed: " . $e->getMessage();
}