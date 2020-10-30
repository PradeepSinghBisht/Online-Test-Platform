<?php
/**
 * Template File Doc Comment
 * 
 * PHP version 7
 * 
 * @category Template_Class
 * @package  Template_Class
 * @author   Author <author@domain.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */
require "../config.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM users WHERE 
    `user_id`= '".$id."'";

    if ($conn->query($sql) === true) {
        echo "<br> Deleted successfully";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Delete Test
    </title>
</head>
<body>
    <div id="wrapper">
        <p>
            <a href="dashboard.php">Admin Home</a>
        </p>
    </div>
</body>
</html>