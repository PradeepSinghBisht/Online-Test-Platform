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
    
    $sql = "DELETE FROM test WHERE `test_id`= '".$id."'";
    $result = $conn->query($sql);

    $sql = "DELETE FROM questions WHERE `test_id`= '".$id."'";
    $result = $conn->query($sql);

    $start = (($id-1) * 8)+1;
    $end = ($id * 8);

    $sql = "DELETE FROM answers WHERE `a_id` BETWEEN '".$start."' AND '".$end."'";
    $result = $conn->query($sql);

    echo "<br> Deleted successfully";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Delete User
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