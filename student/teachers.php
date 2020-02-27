<?php
session_start();
require_once "../connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

$id_user = $_SESSION["id_user"];

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

        $sql2 = "SELECT id_class, id_teacher, Name, Profile FROM classes WHERE id_class = '$id_class'";

        $result2 = $conn->query($sql2);

        if(!$result2) {
            throw new Exception("Query error"); 
        } else {
            $table2 = $result2->fetch_assoc();

            $id_teacher = $table2['id_teacher'];
            $class_name = $table2['Name'];
            $class_profile = $table2['Profile'];
        }

        $sql3 = "SELECT Name, Last_Name FROM teachers WHERE id_teacher = '$id_teacher'";

        $result3 = $conn->query($sql3);

        if(!$result3) {
            throw new Exception("Query error"); 
        } else {
            $table3 = $result3->fetch_assoc();

            $tutor_name = $table3['Name'];
            $tutor_lastname = $table3['Last_Name'];
        }

        $conn->close();
    }
}

catch(Exception $e) {
    echo "<span style='color:red;'>Server error</span>";
    echo "<br> Developer info: ".$e;
}
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
    <?php echo "<h1>Hello ".$name."</h1>" ?>
    <a href="../logout.php">Logout</a>
    </div>
    <div id="nav">
    <a href="student.php"><div class="button">About me</div></a>
    <a href="degrees.php"><div class="button">Degrees</div></a>
    <a href="teachers.php"><div class="button">Teachers</div></a>
    <a href="class.php"><div class="button">Class</div></a>
    </div>
    <div id="content">
    <?php
    echo "<h1>About me:</h1>";

    echo "<table>";
    echo "<tr>";
    echo "<th>Name</th>"."<td>$name "."$last_name </td>";
    echo "</tr>";
 
    echo "<tr>";
    echo "<th>Birthday</th>"."<td>$birthday</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<th>Adress</th>"."<td>$adress</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<th>Phone number</th>"."<td>$phone_number</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<th>Class</th>"."<td>$class_name</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<th>Class profile</th>"."<td>$class_profile</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th>Your tutor</th>"."<td>$tutor_name "."$tutor_lastname </td>";
    echo "</tr>";
    echo "</table>";
    ?>
    
    </div>
    </div>
</body>
</html>