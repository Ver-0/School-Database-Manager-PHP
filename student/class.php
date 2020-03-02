<?php
session_start();
require_once "../connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

$id_user = $_SESSION["id_user"];
$id_class = $_SESSION["class_id"];
/*
try {
    $conn = new mysqli($host,$db_user,$db_pass,$db_name);

    if($conn->connect_errno!=0){
        throw new Exception("No connection to SQL database");
    } else {
        $sql = "SELECT students.id_student, students.id_class , students.Name, students.Last_Name, students.Birthday, students.Adress, students.Phone_Number FROM students,users WHERE users.id_user = '$id_user' AND users.id_user = students.id_user";

        $result = $conn->query($sql);

        if(!$result) {
            throw new Exception("Query error"); 
        } else {
            $table = $result->fetch_assoc();

            $id_class = $table['id_class'];
            $id_student = $table['id_student'];
            $name = $table['Name'];
            $last_name = $table['Last_Name'];
            $birthday = $table['Birthday'];
            $adress = $table['Adress'];
            $phone_number = $table['Phone_Number'];
        }

        $conn->close();
    }
}

catch(Exception $e) {
    echo "<span style='color:red;'>Server error</span>";
    echo "<br> Developer info: ".$e;
}

*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student panel</title>
</head>
<body>
    <div id="container">
    <div id="logo">
    <?php echo "<h1>Hello ".$_SESSION["user_name"]."</h1>" ?>
    <a href="../logout.php">Logout</a>
    </div>
    <div id="nav">
    <a href="student.php"><div class="button">About me</div></a>
    <a href="degrees.php"><div class="button">Degrees</div></a>
    <a href="teachers.php"><div class="button">Teachers</div></a>
    <a href="class.php"><div style="background-color: rgb(185, 185, 185);" class="button">Class</div></a>
    </div>
    <div id="content">
    <?php
    echo "<h2>Class: ".$_SESSION["class_n"]."</h2>";
    echo "<h2>Profile: ".$_SESSION["class_p"]."</h2>";
    echo "<h2>Tutor: ".$_SESSION["class_t"]."</h2>";
    echo "<h2>Colleagues: </h2>";


    echo "<table>";
    echo "<tr><th style='width:10%;'>No.</th><th>Name</th><th>Email</th></tr>";
    
    try {
    $conn = new mysqli($host,$db_user,$db_pass,$db_name);

    if($conn->connect_errno!=0){
        throw new Exception("No connection to SQL database");
    } else {
        $sql = "SELECT students.Name, students.Last_Name, users.email, users.id_user FROM students,users WHERE students.id_class = '$id_class' AND users.id_user = students.id_user ORDER BY students.Last_Name";

        $result = $conn->query($sql);

        if(!$result) {
            throw new Exception("Query error"); 
        } else {
            $i = 0;
            while($table = $result->fetch_assoc()) {
                $i++;
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$table['Name']." ".$table['Last_Name'];

                if($table['id_user'] == $id_user) {
                    echo "<i style='color: grey;'> (You)</i>";
                }


                echo "</td>";
                echo "<td>".$table['email']."</td>";
                echo "</tr>";
            }
        }

        $conn->close();
        }
    }

    catch(Exception $e) {
        echo "<span style='color:red;'>Server error</span>";
        echo "<br> Developer info: ".$e;
    }



    echo "</table>";
    ?>
    
    </div>
    </div>
</body>
</html>