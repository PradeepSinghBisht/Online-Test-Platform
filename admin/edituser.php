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
    $_SESSION['userdata'] = array();
    session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM users WHERE `user_id`='".$id."'";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['userdata'] = array('user_id'=>$row['user_id'],
                        'username'=>$row['username'],
                        'email'=>$row['email'],
                        'role'=>$row['role']);
        }
    }
}

if (isset($_POST['submit'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
    $newpassword = isset($_POST['password'])?$_POST['password']:'';
    $confirmpassword = isset($_POST['password2'])?$_POST['password2']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $role = isset($_POST['role'])?$_POST['role']:'';

    if ($newpassword != $confirmpassword) {
        $errors[] = array('input'=>'password', 'msg'=>'password doesnt match');
    }

    $sql2 = "SELECT * FROM users WHERE `username`='".$username."'
             OR `email`='".$email."'";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $_SESSION['userdata']['user_id'];
            if ($user_id != $row['user_id'] && $username == $row['username']) {
                 $errors[] = array('input'=>'username',
                             'msg'=>'username already exists.');
            }
            if ($user_id != $row['user_id'] && $email == $row['email']) {
                $errors[] = array('input'=>'email',
                            'msg'=>'email already exists.');
            }
        }
    }

    if (sizeof($errors) == 0) {
        $sql = "UPDATE users SET `username` = '".$username."',
                `password` = '".$newpassword."', `email` = '".$email."',
                 `role` = '".$role."'
                WHERE `user_id` = '".$_SESSION['userdata']['user_id']."'";
     
        if ($conn->query($sql) === true) {
            echo "<br> Updated successfully";
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
        Edit User
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
            <h2>Edit User Details</h2>
            <form action="edituser.php" method="POST">
                <p>
                    <label for="username">Username: <input type="text" 
                    name="username" value="<?php 
                    echo $_SESSION['userdata']['username'];?>" required></label>
                </p>
                <p>
                    <label for="email">Email: <input type="email" 
                    name="email" value="<?php 
                    echo $_SESSION['userdata']['email'];?>"required></label>
                </p>
                <p>
                    <label for="password">New-Password: <input type="password"
                           name="password" required></label>
                </p>
                <p>
                    <label for="password2">Confirm-Password: <input type="password"
                           name="password2" required></label>
                </p>
                <p>
                    <label for="role">Role: <input type="text" 
                    name="role" value="<?php 
                    echo $_SESSION['userdata']['role'];?>"required></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Update">
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