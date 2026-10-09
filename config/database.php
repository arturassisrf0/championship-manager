<?php

require __DIR__ .'/../vendor/autoload.php'; 

use Dotenv\Dotenv;

$dotenv = Dotenv::createMutable(dirname(__DIR__) .'');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_NAME'];
$dbuser = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

try {

    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$dbname",
    $dbuser,
    $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

   /* if($pdo){
        echo"conection ok";
    }
*/  

} catch (PDOException $e) {
    echo "Conection error ". $e->getMessage();
    exit();
}

?>