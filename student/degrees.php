<?php
session_start();
require_once "../connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

$id_user = $_SESSION["id_user"];
$id_student = $_SESSION["id_student"];

function degree($hos,$db_use,$db_pas,$db_nam,$id_studen,$sub) {
    try {
        $conn = new mysqli($hos,$db_use,$db_pas,$db_nam);

        if($conn->connect_errno!=0){
            throw new Exception("No connection to SQL database");
        } else {
            $sql = "SELECT Degree FROM degrees WHERE id_student = '$id_studen' AND id_subject='$sub'";
            $result = $conn->query($sql);
            while ($table = $result->fetch_assoc()) {
                $dg = $table['Degree'];
                echo $dg." ";
            }
        }
        
    }

    catch(Exception $e) {
        echo "<span style='color:red;'>Server error</span>";
        echo "<br> Developer info: ".$e;
    }
}

function avg($hos,$db_use,$db_pas,$db_nam,$id_studen,$sub) {
    try {
        $conn = new mysqli($hos,$db_use,$db_pas,$db_nam);

        if($conn->connect_errno!=0){
            throw new Exception("No connection to SQL database");
        } else {
            $sql = "SELECT AVG(Degree) FROM degrees WHERE id_student = '$id_studen' AND id_subject='$sub'";
            $result = $conn->query($sql);
            $table = $result->fetch_assoc();
            $avg = $table['AVG(Degree)'];
            $avg = round($avg,2);
            if (!$avg==0) {
                echo $avg;
            }
            
        }
        
    }

    catch(Exception $e) {
        echo "<span style='color:red;'>Server error</span>";
        echo "<br> Developer info: ".$e;
    }
}




/*
try {
    $conn = new mysqli($host,$db_user,$db_pass,$db_name);

    if($conn->connect_errno!=0){
        throw new Exception("No connection to SQL database");
    } else {
        $sql = "SELECT * FROM degrees WHERE id_student = '$id_student' AND id_subject";
        $result = $conn->query($sql);
        while ($tablica = $result->fetch_assoc()) {
            echo $tablica['Degree'];
        }
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
    <a href="degrees.php"><div style="background-color: rgb(185, 185, 185);" class="button">Degrees</div></a>
    <a href="teachers.php"><div class="button">Teachers</div></a>
    <a href="class.php"><div class="button">Class</div></a>
    </div>
    <div id="content">
    <?php
    echo "<h1>Degrees:</h1>";

    echo "<table>";
    echo "<tr><td></td><td></td><th>Avg</th></tr>";

    echo "<tr><th>English</th><td>";
    echo degree($host,$db_user,$db_pass,$db_name,$id_student,1);
    echo "</td><td>";

    avg($host,$db_user,$db_pass,$db_name,$id_student,1);
    echo "</td></tr>";


    
    echo "<tr><th>Mathematics</th><td>";
    echo degree($host,$db_user,$db_pass,$db_name,$id_student,2);
    echo "</td><td>";
    avg($host,$db_user,$db_pass,$db_name,$id_student,2);
    echo "</td></tr>";
    
    echo "<tr><th>Geography</th><td>";
    echo degree($host,$db_user,$db_pass,$db_name,$id_student,3);
    echo "</td><td>";
    avg($host,$db_user,$db_pass,$db_name,$id_student,3);
    echo "</td></tr>";
    
    echo "<tr><th>History</th><td>";
    echo degree($host,$db_user,$db_pass,$db_name,$id_student,4);
    echo "</td><td>";
    avg($host,$db_user,$db_pass,$db_name,$id_student,4);
    echo "</td></tr>";
    
    echo "<tr><th>Chemistry</th><td>";
    echo degree($host,$db_user,$db_pass,$db_name,$id_student,5);
    echo "</td><td>";
    avg($host,$db_user,$db_pass,$db_name,$id_student,5);
    echo "</td></tr>";
    
    echo "<tr><th>Biology</th><td>";
    echo degree($host,$db_user,$db_pass,$db_name,$id_student,6);
    echo "</td><td>";
    avg($host,$db_user,$db_pass,$db_name,$id_student,6);
    echo "</td></tr>";
    
    echo "<tr><th>PE</th><td>";
    echo degree($host,$db_user,$db_pass,$db_name,$id_student,7);
    echo "</td><td>";
    avg($host,$db_user,$db_pass,$db_name,$id_student,7);
    echo "</td></tr>";

    
    echo "</table>";
    ?>
    
    </div>
    </div>
</body>
</html>