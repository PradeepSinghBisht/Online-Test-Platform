<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Dashboard
    </title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="navbar">
        <a href="#">Dashboard</a>
        <div class="dropdown">
            <button class="dropbtn">Test</button>
            <div class="dropdown-content">
            <a href="addtest.php">Add</a>
            <a href="managetest.php">Manage</a>
            </div>
        </div> 
        <div class="dropdown">
            <button class="dropbtn">Users </button>
            <div class="dropdown-content">
            <a href="adduser.php">Add</a>
            <a href="manageuser.php">Manage</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Scores </button>
            <div class="dropdown-content">
            <a href="managescore.php">Manage</a>
            </div>
        </div>
        <a href="../logout.php">Logout</a>
    </div><br>
    <?php echo "<h1>Welcome " . $_SESSION['userdata']['username'] . "</h1>";?>
    
</body>
</html>
