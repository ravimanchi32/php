cat db.php 
<?php
function Createdb(){
    // Read DB credentials from environment variables, with defaults for local testing
    $servername = getenv('DB_HOST') ?: 'mysql-service';
    $username   = getenv('DB_USER') ?: 'user';
    $password   = getenv('DB_PASSWORD') ?: 'userpassword';
    $dbname     = getenv('DB_NAME') ?: 'bookstore';

    // Create connection
    $con = mysqli_connect($servername, $username, $password);

    if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }

    // Create database if not exists
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con, $sql)){
        // Reconnect to the newly created database
        $con = mysqli_connect($servername, $username, $password, $dbname);

        // Create books table if not exists
        $sql = "
            CREATE TABLE IF NOT EXISTS books(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                book_name VARCHAR(25) NOT NULL,
                book_publisher VARCHAR(20),
                book_price FLOAT
            );
        ";

        if(mysqli_query($con, $sql)){
            return $con;
        }else{
            echo "Cannot create table: " . mysqli_error($con);
        }

    }else{
        echo "Error while creating database: ". mysqli_error($con);
    }
}
?>
