<?php
    require "config.php";
    $errors = array();

if (isset($_POST['submit'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    $repassword = isset($_POST['repassword'])?$_POST['repassword']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $role = isset($_POST['role'])?$_POST['role']:'';

    if ($password != $repassword) {
        $errors[] = array('msg'=>'password doesnt match');
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
    <head>
        <title>Sign Up</title>        
    </head>
    <body>
        <div id = "errors">
            <?php foreach ($errors as $key=>$value) { ?>
                <li> 
                    <?php echo $errors[$key]['msg'];
            } ?> 
                </li>
        </div>
        <div id="login-form">
            <h2>Register</h2>
            <form action="signup.php" method="POST">
                <p>
                    <label for="username">Username: <input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="text" name="password" required></label>
                </p>
                <p>
                    <label for="repassword">Re-Password: <input type="text" name="repassword" required></label>
                </p>
                <p>
                    <label for="email">Email: <input type="email" name="email" required></label>
                </p>
                <p>
                    <label for="role">Role: <input type="text" name="role" required></label><span> User/Admin</span>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
            <form action="login.php" method="POST">
                <p>
                    <input type="submit" name="signup" value="Login">
                </p>
            </form>
        </div>
    </body>
</html>