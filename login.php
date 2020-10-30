<?php
    require "config.php";
    $errors = array();
    session_start();

if (isset($_POST['submit'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';

    $sql = "SELECT * FROM users WHERE `username`='".$username."'
                AND `password`='".$password."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['userdata'] = array('user_id'=>$row['user_id'],
                 'username'=>$row['username'], 'email'=>$row['email'],
                 'role'=>$row['role']);
            if ($row['role'] == "admin" || $row['role'] == "Admin") {
                header('Location: admin/dashboard.php');
            } else {
                header('Location: userhome.php');
            }
        }
    } else {
        $errors[] = array('input'=>'login', 'msg'=>'Invalid Login Details');
    }
}
?>

<!DOCTYPE html>
    <head>
        <title>Login</title>        
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
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <p>
                    <label for="username">Username: <input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password" name="password" required></label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
            <form action="signup.php" method="POST">
                <p>
                    <input type="submit" name="signup" value="SignUp"><span> New User?</span>
                </p>
            </form>
        </div>
    </body>
</html>