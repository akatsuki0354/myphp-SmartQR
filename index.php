<?php session_start(); ?>
<html>

<head>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="index.js" type="module"></script>
    <link rel="stylesheet" href="style.css">
    <title>Smart-QR</title>
</head>

<body>
    <div class="main">
        <div class="col-md-6">
            <video id="preview" width="100%"></video>
            <?php
            if (isset($_SESSION['success'])) {
                echo "
                        <div class='alert alert-success'>
                         <h4>Success!</h4>
                         " . $_SESSION['success'] . "
                        </div>
                        ";
            }
            ?>
        </div>
        <div>
            <form action="insert1.php" method="post" class="form-horizontal">
                <input type="text" readonly id="text" name="text" placeholder="Student Name" class="form-control">
            </form>
        </div>
    </div>
    <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <!-- <td>ID</td> -->
                            <td>STUDENT No.</td>
                            <td>TIME IN</td>
                            <td>TIME OUT</td>
                            <td>LOGDATE</td>
                            <td>STATUS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $server = "localhost";
                        $username="root";
                        $password="";
                        $dbname="chester-db";
                    
                        $conn = new mysqli($server,$username,$password,$dbname);
						$date = date('Y-m-d');
                        if($conn->connect_error){
                            die("Connection failed" .$conn->connect_error);
                        }
                           $sql ="SELECT * FROM table_attendance WHERE DATE(LOGDATE)=CURDATE()";
                           $query = $conn->query($sql);
                           while ($row = $query->fetch_assoc()){
                        ?>
                            <tr>
                             
                                <td><?php echo $row['STUDENTID'];?></td>
                                <td><?php echo $row['TIMEIN'];?></td>
                                <td><?php echo $row['TIMEOUT'];?></td>
                                <td><?php echo $row['LOGDATE'];?></td>
                                <td><?php echo $row['STATUS'];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                  </table>

    <script>
        setTimeout(function () {
            document.querySelector('.alert').style.display = 'none';
        }, 3000);
    </script>
</body>
</html>