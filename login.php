<?php
    session_start();
    if(isset($_SESSION['userinfor'])) {
        header('Location: ../Tour/index.php');
        die();
    }
	
    if(!empty($_POST)) {
	require_once('../Tour/db/dbhelper.php');
	$email = $password = '';
        
	if(isset($_POST['email'])) {
            $email = $_POST['email'];
	}
	
        if(isset($_POST['password'])) {
            $password = $_POST['password'];
	}
		
	if(!empty($email)) {
            $password = md5($password);
            $sql = "SELECT * FROM `user` where email='$email' and password='$password'";
            $result = executeResult($sql);
            if($result != null && count($result) > 0) {
		//login success
		$_SESSION['userinfor'] = $result[0];
                header('Location: ../Tour/index.php');
		die();
            }
	}
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Đăng nhập</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
        <style>
            .btn {
                background: #ff5722;
                color: #fff;
                font-weight: bold;
            }
            
            .vertical-center {
                min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
                min-height: 100vh; /* These two lines are counted as one :-)       */               
                display: flex;
                align-items: center;
            }
              
            .container {
                border: 1px gray solid;
                border-radius: 10px;
                padding: 30px;
            }
        </style>
</head>
<body>
    <div class="vertical-center">
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="text-center">Đăng nhập</h2>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required="true" type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mật khẩu:</label>
                            <input required="true" type="password" class="form-control" id="password" name="password">
                        </div>
                        <button class="btn" type="submit" name="submit">ĐĂNG NHẬP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>