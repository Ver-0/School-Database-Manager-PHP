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
        $sql = "SELECT students.Name, students.Last_Name, students.Birthday, students.Adress, students.Phone_Number FROM students,users WHERE users.id_user = '$id_user' AND users.id_user = students.id_user";

        $result = $conn->query($sql);

        if(!$result) {
            throw new Exception("Query error"); 
        } else {
            $table = $result->fetch_assoc();

            $name = $table['Name'];
            $last_name = $table['Last_Name'];
            $birthday = $table['Birthday'];
            $adress = $table['Adress'];
            $phone_number = $table['Phone_Number'];
        }
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
    <a href="">About me</a><br>
    <a href="">Degrees</a><br>
    <a href="">Teachers</a><br>
    </div>
    <div id="content">
    <?php
    echo "<h1>About me:</h1>";
    echo $name."<br>";
    echo $last_name."<br>";
    echo $birthday."<br>";
    echo $adress."<br>";
    echo $phone_number."<br>";
    echo $id_user."<br>";
    ?>
    
    </div>
    </div>
</body>
</html>