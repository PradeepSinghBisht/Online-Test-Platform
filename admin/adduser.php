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
    $errors = array();

if (isset($_POST['submit'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    $repassword = isset($_POST['password2'])?$_POST['password2']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $role = isset($_POST['role'])?$_POST['role']:'';

    if ($password != $repassword) {
        $errors[] = array('input'=>'password', 'msg'=>'password doesnt match');
    }

    $sql2 = "SELECT * FROM users WHERE `username`='".$username."'
             OR `email`='".$email."'";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($username == $row['username']) {
                 $errors[] = array('input'=>'username',
                             'msg'=>'username already exists.');
            }
            if ($email == $row['email']) {
                $errors[] = array('input'=>'email',
                            'msg'=>'email already exists.');
            }
        }
    }

    if (sizeof($errors) == 0) {
        $sql = 'INSERT INTO users(`username`,`password`,`email`,`role`) 
		VALUES("'.$username.'","'.$password.'","'.$email.'","'.$role.'")';

        if ($conn->query($sql) === true) {
            echo "<br> Registered successfully";

        } else {
            $errors[] = array('input'=>'form', 'msg'=>$conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Add User
    </title>
</head>
<body>
    <div id="wrapper">
        <div id = "errors">
            <?php foreach ($errors as $key=>$value) { ?>
                <li> 
                    <?php echo $errors[$key]['msg'];
            } ?> 
                </li>
        </div>
        <div id="signup-form">
            <h2>Add User</h2>
            <form action="adduser.php" method="POST">
                <p>
                    <label for="username">Username: <input type="text" 
                           name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password"
                           name="password" required></label>
                </p>
                <p>
                    <label for="password2">Re-Password: <input type="password"
                           name="password2" required></label>
                </p>
                <p>
                    <label for="email">Email: <input type="email" 
                           name="email" required></label>
                </p>
                <p>
                    <label for="role">Role: <input type="text" 
                           name="role" required></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Add User">
                </p>
            </form>
            <form action="dashboard.php" method="POST">
                <p>
                    <input type="submit" name="admin" value="Admin Home">
                </p>
            </form>
        </div>
    </div>
</body>
</html>