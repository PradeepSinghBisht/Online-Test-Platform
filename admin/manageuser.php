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

$sql1 = "SELECT * FROM users";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $html1 = '<table style="font-size:22px"><caption>User List</caption>
                <tr> <th>User ID</th> <th>Username</th> <th>Email</th> 
                <th>Password</th> <th>Role</th> <th>Action</th></tr>';
    while ($row = $result1->fetch_assoc()) {
        $html1 .= '<tr> <td>'.$row['user_id'].'</td> 
                    <td>'.$row['username'].'</td> 
                    <td>'.$row['email'].'</td> 
                    <td>'.$row['password'].'</td> 
                    <td>'.$row['role'].'</td>
                    <td><a href="edituser.php?id='.$row['user_id'].'">
                    Edit</a>
                    <a href="deleteuser.php?id='.$row['user_id'].'">
                    Delete</a></td></tr>';
    }
    $html1 .= '</table>';
    echo $html1;
}
?>
<!DOCTYPE html>
    <head>
        <title>
            Manage User
        </title>
    </head>
    <body>    
        <form action="dashboard.php" method="POST">
            <p>
                <input type="submit" name="admin" value="Admin Home">
            </p>
        </form>
    </body>
</html>
