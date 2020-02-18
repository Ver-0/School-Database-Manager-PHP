<?php
session_start();

try {
    if (($_POST["login"]=="") || ($_POST["password"]=="")) {
        $_SESSION["errors"] = "Fill login and password";
        header("Location: index.php");
        exit();
    }

    $login = $_POST["login"];
    $password = $_POST["password"];

    $login = htmlentities($login,ENT_QUOTES,"UTF-8");
    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    $conn = new mysqli($host,$db_user,$db_pass,$db_name);

    if ($conn->connect_errno!=0) {
        throw new Exception("No connection to SQL database");
    } else {
        $sql = sprintf("SELECT * FROM users WHERE login='%s'",mysqli_real_escape_string($conn,$login) );

        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception("Query error"); 
        } else {
            $result_num = $result->num_rows;

            if ($result_num>0) {
                $table = $result->fetch_assoc();
                if (password_verify($password,$table['password'])) {
                    $_SESSION["id_user"] = $table['id_user'];
                    $_SESSION["perm"] = $table['perm'];

                    $conn->close();

                    if ($_SESSION["perm"] == "admin") {
                        header("Location: admin/admin.php");
                        exit();
                    } else if ($_SESSION["perm"] == "teacher") {
                        header("Location: teacher/teacher.php");
                        exit();
                    } else if ($_SESSION["perm"] == "student") {
                        header("Location: student/student.php");
                        exit();
                    }

                } else {
                    $_SESSION["errors"] = "Wrong login or password";
                    $conn->close();
                    header("Location: index.php");
                    exit();
                } 
                } else {
                    $_SESSION["errors"] = "Wrong login or password";
                    $conn->close();
                    header("Location: index.php");
                    exit();
            }
        }
    }

}

catch(Exception $e) {
    echo "<span style='color:red;'>Server error</span>";
    echo "<br> Developer info: ".$e;
}

$conn->close();