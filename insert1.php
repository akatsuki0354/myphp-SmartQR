<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "chester-db";

$conn = new mysqli($server,$username,$password,$dbname);
if(($conn -> connect_error)){
    die("Connection failed" . $conn->connect_error);
}

if(isset($_POST['text'])){

    $text = $_POST['text'];
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $sql = "SELECT * FROM table_attendance WHERE STUDENTID = '$text' AND LOGDATE='$date' AND STATUS='0'";
    $query = $conn->query($sql);
    if($query -> num_rows>0){
        $sql = "UPDATE table_attendance SET TIMEOUT=NOW(), STATUS='1' WHERE STUDENTID='$text' AND LOGDATE='$date'";
        $query = $conn->query($sql);
        $_SESSION['success'] = 'successfully time out';
    }else{
        $sql = "INSERT INTO table_attendance(STUDENTID,TIMEIN,LOGDATE,STATUS) VALUES('$text','$time','$date' ,'0' )";
        if($conn ->query($sql) === TRUE){
            $_SESSION['success'] = 'successfully time in';
        }else{
            $_SESSION['error'] = $conn->error;
        }
    }
}else{
    $_SESSION['error'] = 'please scan your qr-code';
}
header("Refresh: 2; url=index.php");
$conn->close();

?>