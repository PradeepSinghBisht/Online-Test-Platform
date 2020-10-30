<?php
    include "config.php";
    session_start();
?>

<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <?php 
                if (isset($_SESSION['userdata'])) {
                    echo "<h1>Welcome " . $_SESSION['userdata']['username'] . "</h1>";
                } else {
                    header('location:login.php');
                }?>
                <?php echo  "<h3><a href='logout.php'>LOGOUT</a></h3>" ?>
            </div>
            <div id="content">
                <?php
                    $sql = "SELECT * FROM test";
                    $result = $conn->query($sql);
                    echo "<h2>Select a Quiz Out of the following List</h2>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<h3><li><a href='quiz.php?id=".$row['test_id']."'>" .$row['testname']. "</a></li></h3>";
                    }    
                ?>
            </div>
        </div>
    </body>
</html>