<?php
    require "../config.php";

    $sql1 = "SELECT * FROM test";
    $result1 = $conn->query($sql1);
    
    if ($result1->num_rows > 0) {
        $html1 = '<table style="font-size:22px"><caption>Test List</caption>
                    <tr> <th>Test ID</th> <th>Testname</th> <th>Action</th></tr>';
        while ($row = $result1->fetch_assoc()) {
            $html1 .= '<tr> <td>'.$row['test_id'].'</td> 
                        <td>'.$row['testname'].'</td>
                        <td><a href="deletetest.php?id='.$row['test_id'].'">
                        Delete</a></td></tr>';
        }
        $html1 .= '</table>';
        echo $html1;
    }
?>
<!DOCTYPE html>
    <head>
        <title>
            Manage Test
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