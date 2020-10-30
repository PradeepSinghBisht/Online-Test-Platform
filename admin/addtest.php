<?php
    require "../config.php";
    $errors = array();
    session_start();

    if(isset($_POST['submit'])) {
        $testname = $_POST['testname'];

        $sql = "INSERT INTO test (`testname`) VALUES ('".$testname."')";
        if ($conn->query($sql) === true) {
            $sql3 = "SELECT * FROM test WHERE `testname`='".$testname."'";
            $result = $conn->query($sql3);
            $row = $result->fetch_assoc();

            $question = array();
            for ($i = 1; $i <= 10; $i++) {
                array_push($question, $_POST['q'.$i]);
            }

            $option = array();
            for ($i = 1; $i <= 40; $i++) {
                array_push($option, $_POST['a'.$i]);
            }

            $answer = array();
            for ($i = 1; $i <= 10; $i++) {
                array_push($answer, $_POST['ans'.$i] + (($i - 1)*4) + (($row['test_id'] - 1)* 40));
            }

            for ($i = 0; $i < count($question); $i++) {
                $sql2 = "INSERT INTO questions (`test_id`, `question`, `a_id`) VALUES ('".$row['test_id']."', '".$question[$i]."', '".$answer[$i]."')";
                $result = $conn->query($sql2);
            }

            for ($i = 0; $i < count($option); $i++) {
                $sql4 = "INSERT INTO answers (`answer`) VALUES ('".$option[$i]."')";
                $result = $conn->query($sql4);
            }
            echo "<script> alert('Test Added successfully'); </script>";
        } else {
            $errors[] = array('msg'=>$conn->error);
            echo "Error: " . $sql . "<br>" . $conn->error;
        }       
    }

?>


<!DOCTYPE html>
    <head>
        <title>Add Test</title>        
    </head>
    <body>
        <div id="form">
            <h2>Add Test</h2>
            <form action="addtest.php" method="POST">
                <p>
                    <label for="username">Test Name: </label>
                    <textarea id="textarea" name="testname" cols="50" rows="1" required></textarea>
                </p><br>
                <?php 
                $j = 0;
                for ($i = 1; $i <= 10; $i++) {
                    echo '<p>
                            <label for="q1">Question '.$i.': </label>
                            <textarea id="textarea" name="q'.$i.'" cols="134" rows="1" required></textarea><br><br>';
                            $z = 1;
                            do {
                                $j++;
                                echo '<label for="q1"> Options - '.$z.' : <input type="text" name="a'.$j.'" required></label>';
                                $z++;
                            } while ($j % 4 != 0);
                            echo '<br><br>
                            <label for="q1">Correct Answer: <input type="number" name="ans'.$i.'"></label>
                        </p><br>';    
                }
                ?>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
            <form action="dashboard.php" method="POST"> 
                <p>
                    <input type="submit" name="admin" value="Admin Home">
                </p>
             </form>
        </div>
    </body>
</html>