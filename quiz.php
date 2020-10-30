<?php
include "config.php";
session_start();

    if (isset($_POST['submit'])) {
        $test_id = $_GET['test'];
        $sql = "SELECT * FROM questions WHERE `test_id`= '".$test_id."'";
        $result = $conn->query($sql);
        $answer = array();
        $x = ($test_id -1)*10 +1;
        while ($row = $result->fetch_assoc()) {
            array_push($answer, $_POST['q'.$x]);
            $x++;
        }
        $z = 0;
        $count = 0;
        $sql = "SELECT * FROM questions WHERE `test_id`= '".$test_id."'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($answer[$z] == $row['a_id']) {
                $count++;
            }
            $z++;
        }
        echo "<h2>Your Score is : ".$count." out of 10</h2>";
        if ($count >= 5) {
            $result = "Passed";
        } else {
            $result = "Failed";
        }
        echo "<h2>Result : ".$result."</h2>";

        $sql = "INSERT INTO scores (`user_id`, `test_id`, `score`, `result`) VALUES('".$_SESSION['userdata']['user_id']."', '".$test_id."', '".$count."', '".$result."')";
        $result = $conn->query($sql);

        $sql = "SELECT * FROM scores WHERE `user_id`= '".$_SESSION['userdata']['user_id']."' AND `test_id`='".$test_id."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $html = '<table style="font-size:22px"><caption>Your All Score In this Test Only</caption>
                        <tr> <th>User ID</th> <th>Test ID</th> <th>Username</th>
                        <th>Score</th> <th>Result</th></tr>';
            while ($row = $result->fetch_assoc()) {
                $html .= '<tr> <td>'.$row['user_id'].'</td> 
                            <td>'.$row['test_id'].'</td>
                            <td>'.$_SESSION['userdata']['username'].'</td> 
                            <td>'.$row['score'].'</td>
                            <td>'.$row['result'].'</td> </tr>';
            }
            $html .= '</table><br>';
            echo $html;
        }

        echo '<form action="userhome.php" method="POST"> 
                <p>
                    <input type="submit" name="home" value="Home">
                </p>
             </form>';    
    }
    
    if (isset($_SESSION['userdata'])) {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $start = (($id-1)*10)+1;
            $end = ($id*10);
            $j = 1;
            echo '<form action="quiz.php?test='.$id.'" method="POST">';
            for ($i=$start; $i<= $end; $i++) {
                $sql = "SELECT * FROM questions WHERE `q_id` ='".$i."'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<h2>".$j." - ".$row['question']."</h2>";
                $j++;
                $o = (($i-1) * 4) +1;
                $p = $i * 4;
                $sql = "SELECT * FROM answers WHERE `a_id` BETWEEN ".$o." AND ".$p."";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<input type='radio' name='q".$i."' value='".$row['a_id']."' required> ".$row['answer']."<br><br>";
                }
            }
            echo "<br><input type='submit' name='submit' value='Submit' >";
            echo '</form>';
        }
    } else {
        header ('location:login.php');
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Quiz
    </title>
</head>
<body>    
</body>
</html>