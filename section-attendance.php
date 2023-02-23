<?php session_start(); ?>
<html>

<head>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="index.js" type="module"></script>
    <link rel="stylesheet" href="style.css">
    <title>Smart-QR</title>
</head>

<style>
    nav {
        display: flex;
        justify-content: space-between;
        padding: 10px 20px 0px 20px;
    }

    nav a {
        font-size: 20px;
        padding: 10px;
        color: black;
    }

    nav a:hover {
        color: black;
    }

    nav a.active {
        text-decoration: underline;
    }

    .main table {
        text-align: center;
    }

    .main th {
        text-align: center;
    }

    .search-main {
        display: flex;
        justify-content: center;
    }

    .nav-searchbar {
        display: flex;
        margin-top: 20px;
    }
</style>

<body>
    <nav>
        <div>
            <h1>Smart-QR</h1>
        </div>
        <div class="nav-searchbar">
            <br>
            <div>
                <a href="/Smart-QR/about.php">About</a>
                <a href="/Smart-QR/QR-Public-attendance.php">Attendance</a>
            </div>
            <div class="search-main">
                <div class="search">
                    <div class="form-outline" style="display: flex;">
                        <input type="search" id="form1" class="form-control" placeholder="search" />
                        <button type="button" class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>

<style>
    .title h1{
        text-align: center;
        margin-bottom: 50px;
    }

</style>

<div class="title">
    <h1>St.Bernardin Attendance</h1>
</div>
<table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>STUDENT ID</td>
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
                                <td><?php echo $row['ID'];?></td>
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
</html>