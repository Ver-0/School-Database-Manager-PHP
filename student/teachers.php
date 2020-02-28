<?php
session_start();
require_once "../connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

//$id_user = $_SESSION["id_user"];

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
    <a href="class.php"><div class="button">Class</div></a>
    </div>
    <div id="content">
    <?php
    echo "<h1>Teachers:</h1>";

    echo "<table>";
    echo "<tr><th>Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th><th>Subject</th></tr>";

    try {
    $conn = new mysqli($host,$db_user,$db_pass,$db_name);

    if($conn->connect_errno!=0){
        throw new Exception("No connection to SQL database");
    } else {
        $sql = "SELECT teachers.Name, teachers.Last_Name, teachers.Phone_Number, users.email, subjects.Sub_Name FROM teachers,users,subjects WHERE teachers.id_user = users.id_user AND teachers.id_subject = subjects.id_subject ORDER BY teachers.Last_Name";

        $result = $conn->query($sql);

        if(!$result) {
            throw new Exception("Query error"); 
        } else {
            while($table = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$table['Name']."</td>";
                echo "<td>".$table['Last_Name']."</td>";
                echo "<td>".$table['Phone_Number']."</td>";
                echo "<td>".$table['email']."</td>";
                echo "<td>".$table['Sub_Name']."</td>";
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