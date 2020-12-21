<?php
    session_start();
    if(isset($_SESSION['userinfor'])) {
        header('Location: ../Tour/login.php');
        die();
    }
	
    if(!empty($_POST)) {
        require_once('../Tour/db/dbhelper.php');

        $name = $phone = $email = $password = $confirmation_pwd = '';
        if(isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        
        if(isset($_POST['phone'])) {
            $phone = $_POST['phone'];
        }
		
        if(isset($_POST['email'])) {
            $email = $_POST['email'];
	}
        		
        if(isset($_POST['password'])) {
            $password = $_POST['password'];
	}
		
        if(isset($_POST['confirmation_pwd'])) {
            $confirmation_pwd = $_POST['confirmation_pwd'];
	}

        if($password == $confirmation_pwd && !empty($name) && !empty($email)) {
            $created_at = $updated_at = date('Y-m-d H:s:i');
            $password = md5($password);
            $type = 'user';
            $sql = "insert into user(name, email, phone, password, user_type, created_at, updated_at) values ('$name', '$email', '$phone', '$password', '$type','$created_at', '$updated_at')";
            execute($sql);
            header('Location: ../Tour/login.php');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký tài khoản</title>
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
                    <h2 class="text-center">Đăng ký tài khoản</h2>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Họ và tên:</label>
                            <input required="true" type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="phone">SĐT:</label>
                            <input required="true" type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required="true" type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mật khẩu:</label>
                            <input required="true" type="password" class="form-control" id="pwd" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirmation_pwd">Nhập lại mật khẩu:</label>
                            <input required="true" type="password" class="form-control" id="confirmation_pwd" name="confirmation_pwd">
                        </div>
                        <button class="btn" type="submit">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>