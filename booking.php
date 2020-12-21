<?php 
    session_start();
    require_once ('../Tour/db/dbhelper.php');
    $id = $name = $place = $price = $price_child = $duration = $transport = $thumbnail = $content = $id_category = '';
    $user_name = $phone = $email = '';
    if (!empty($_POST)) {
        if (isset($_POST['user_name'])) {
            $user_name = $_POST['user_name'];
            $user_name = str_replace('"', '\\"',  $user_name);
        }
        
        if (isset($_POST['user_id'])) {
            $id_user = $_POST['user_id'];
        }
        
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $email = str_replace('"', '\\"',  $email);
        }
        
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
        }
                               
        if (isset($_POST['adult'])) {
            $adult = $_POST['adult'];
        }
                    
        if (isset($_POST['children'])) {
            $children = $_POST['children'];
        }
        
        if (isset($_POST['payment'])) {
            $payment = $_POST['payment'];
        }
        
        if (isset($_GET['id'])) {
            $id_tour  = $_GET['id'];
            $sql      = 'select * from tour where id = '.$id_tour;
            $tour = executeSingleResult($sql);
            if ($tour != null) {
                $price = $tour['price'];
                $price_child = $tour['price_child'];                
            }
        }
        
        if ($_SESSION['userinfor']) {
            $info      = $_SESSION['userinfor'];
            $user      = $info['idUser'];
            $sql       = 'select * from user where idUser = '.$user;
            $customer  = executeSingleResult($sql);
            if ($customer != null) {
                $user_name = $customer['name'];
                $email = $customer['email'];
                $phone = $customer['phone'];
            }
        }   
        
        if (!empty($user_name)) {
            $created_at = date('Y-m-d H:s:i');
            if ($id == '') {
                $status = 1;
                $sum_price = (($price * $adult) + ($price_child * $children));       
                $sql = "insert into booking(id_tour, name, phone, email, adults_count, children_count, sum_price, created_at, status) "
                        . "values ('$id_tour','$user_name', '$phone', '$email', '$adult', '$children', '$sum_price', '$created_at' , '$status')";
                    }
                    execute($sql);
                    
            }
        header("Location: success.php");
    }
    if (isset($_GET['id'])) {
        $id_tour       = $_GET['id'];
        $sql      = 'select * from tour where id = '.$id_tour;
        $tour = executeSingleResult($sql);
        if ($tour != null) {
            $name = $tour['name'];
            $place = $tour['place'];
            $price = $tour['price'];
            $price_child = $tour['price_child'];
            $thumbnail = $tour['thumbnail'];
            $content = $tour['content'];
            $id_category = $tour['id_category'];
            $duration = $tour['duration'];
            $transport = $tour['transport'];
        }
    }
    
    if (!empty($_SESSION['userinfor'])) {
            $info      = $_SESSION['userinfor'];
            $user      = $info['idUser'];
            $sql       = 'select * from user where idUser = '.$user;
            $customer  = executeSingleResult($sql);
            if ($customer != null) {
                $user_name = $customer['name'];
                $email = $customer['email'];
                $phone = $customer['phone'];
            }
        }  
        
    if (empty($_SESSION['userinfor'])) {
        $user_name = $email = '';
    }     
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Pleasant Tours</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="../Tour/css/style.css?version=1">
        
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d1b9594106.js" crossorigin="anonymous"></script>       
</head>
<body>
    <!-- Header -->
        <div class="topnav" id="myTopnav">
<?php
if(isset($_SESSION['userinfor'])) {
    $info      = $_SESSION['userinfor'];
    $username  = $info['user_type'];
    if($username == 'admin') {
        echo '<a class="logo" href="../Tour/admin.php">PLEASANT TOURS</a>';
    }
    if($username == 'user') {
        echo '<a class="logo" href="#">PLEASANT TOURS</a>';
    }
}
else {
    echo '<a class="logo" href=".#">PLEASANT TOURS</a>';
}
?>
            <div class="menu">
                <a href="../Tour/index.php">Trang chủ</a>
                <a href="#" class="active">Tham quan & giải trí</a>
                <a href="../Tour/blog.php" target="blank">Cẩm nang du lịch</a>
                <a href="../Tour/contact.php">Liên hệ</a>
            </div>
            <div class="buttons">
            <?php
                    if(!isset($_SESSION['userinfor'])) {
                        echo '  <a class="btn btn-orange mr-sm-2" href="../Tour/login.php">Đăng nhập</a>
                                <a class="btn btn-orange2" href="../Tour/register.php">Đăng ký</a>';                
                    }
                    if(isset($_SESSION['userinfor'])) {
                        $info      = $_SESSION['userinfor'];
                        $username  = $info['name'];                        
                        echo '  <a class="logo" href="#">
                                    <span class="text">Xin chào, </span>
                                    <span class="text">'.$username.'</span>
                                </a>
                                <a href="../Tour/logout.php" style="border-left: solid 1px #f2f2f2">Thoát</a>';                       
                    }
                ?>
            </div>
                
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
        </div>   
    
    <!-- Page Content -->
        <div class="container main">
            <div class="row">
                <div class="col-12">
                    <div class="title_2 text-center">Thông tin tour</div>
                </div>
                <div class="col-3 text-center">
                    <img src="<?=$thumbnail?>" style="max-width: 100% !important; max-height: 130px !important;"/>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="name_2"><?=$name?></div>
                        </div>
                        <hr>
                        <div class="col-6">
                            Địa điểm:
                            <span class="info"><?=$place?></span>
                        </div>
                        <div class="col-6">
                            Phương tiện:
                            <span class="info"><?=$transport?></span>
                        </div>
                        <div class="col-6">
                            Ngày khởi hành:
                            <span class="info">12/11/2020</span>
                        </div>
                        <div class="col-6">
                            Số ngày: 
                            <span class="info"><?=$duration?></span>
                        </div>
                        <div class="col-6">
                            Giá: 
                            <span class="info"><?=number_format($price, 0, ",", ".")?> VND</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row"">
                <div class="col-12">
                    <div class="title_2 text-center">Giá tour cơ bản</div>
                </div>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Số lượng gười lớn (Từ 18 tuổi trở lên)</th>
                            <th scope="col">Số lượng trẻ em (Từ 0 tuổi đến dưới 18 tuổi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=number_format($price, 0, ",", ".")?> VND</td>
                            <td><?=number_format($price_child, 0, ",", ".")?> VND</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="title_2 text-center">Thông tin liên lạc</div>
                </div>
                <div class="container">
                    <form method="post">
                        <div class="row font-weight-bold">              
                            <div class="col-6" style="margin-top: 20px;">
                                <label for="user_name">Họ tên (<span class="text-danger">*</span>): </label>
                                <input type="text" name="user_id" value="<?=$id?>" hidden="true">
                                <input required="true" type="text" class="form-control" id="user_name" name="user_name" value="<?=$user_name?>">
                            </div>

                            <div class="col-6" style="margin-top: 20px;">
                                <label for="email">Email (<span class="text-danger">*</span>): </label>
                                <input required="true" type="text" class="form-control" id="email" name="email" value="<?=$email?>">
                            </div>

                            <div class="col-6" style="margin-top: 20px;">
                                <label for="phone">Di động (<span class="text-danger">*</span>): </label>
                                <input required="true" type="text" class="form-control" id="phone" name="phone" value="<?=$phone?>">
                            </div>

                            <div class="col-6" style="margin-top: 20px;">
                                <label for="address">Địa chỉ:</label>
                                <input required="true" type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="col-6" style="margin-top: 20px;">
                                <label for="adult">Người lớn (từ 18 tuổi trở lên):</label>
                                <input required="true" type="number" class="form-control" id="adult" name="adult">
                            </div>

                            <div class="col-6" style="margin-top: 20px;">
                                <label for="children">Trẻ em (từ 0 đến 17 tuổi):</label>
                                <input required="true" type="number" class="form-control" id="children" name="children">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="title_2 text-center">Hình thức thanh toán</div>
                            </div>
                            <div class="container" style="background: #F2F2F2; width: 100%;">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="radio" name="payment" <?php if (isset($payment) && $payment=="cash") echo "checked";?> value="cash">
                                        <label for="male" style="margin: 10px;">Tiền mặt</label><br>
                                    </div>
                                    <div class="col-12">
                                        <input type="radio" name="payment" <?php if (isset($payment) && $payment=="transact") echo "checked";?> value="transact">
                                        <label for="female" style="margin: 10px;">Chuyển khoản</label><br>
                                    </div>
                                    <div class="col-12">
                                        <input type="radio" name="payment" <?php if (isset($payment) && $payment=="atm") echo "checked";?> value="atm">
                                        <label for="other" style="margin: 10px;">ATM / Internet Banking</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="radio" name="payment" <?php if (isset($payment) && $payment=="card") echo "checked";?> value="card">
                                        <label for="other" style="margin: 10px;">Thẻ tín dụng</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center" style="margin: 50px;">
                            <button type="submit" class="btn btn-danger">
                                <span>Đặt tour</span>&nbsp;
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>		
                </div>
            </div>
        </div>
      
        <!-- Footer -->
        <div class="container-fluid px-0" style="border-top: solid 1px #d9d9d9;">
            <div class="container"> 
                <div class="row bg-footer">
                    <div class="col-3 text-center">
                        <p>Được chứng nhận</p>
                        <a href="#" target="blank"><img src="../Tour/img/logoSaleNoti.png" style="width: 100px;height: 40px;"></a>
                    </div>
                    <div class="col-3">
                        <h5>Về Pleasant Tours</h5>
                        <ul>
                            <li><a href="#">Chúng tôi</a></li>
                            <li><a href="../Tour/blog.php">Pleasant Tours Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-3">
                        <h5>Thông tin cần biết</h5>
                        <ul>                                
                            <li><a href="#">Điều kiện & Điều khoản</a></li>
                            <li><a href="#">Quy chế hoạt động</a></li>
                            <li><a href="#">Câu hỏi thường gặp</a></li>
                        </ul>
                    </div>
                        <div class="col-3">
                            <h5>Đối tác & Liên kết</h5>
                            <ul>
                                <li><a href="https://www.vietnamairlines.com/vn/vi/home" target="_blank">Vietnam Airlines</a></li>
                                <li><a href="https://www.vietjetair.com/sites/web/vi-vn/home" target="_blank">Vietjets</a></li>
                                <li><a href="https://vnexpress.net/" target="_blank">VNExpress</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <div class="container-fluid footer">            
                <div class="container">
                    <div class="row">
                        <div class="col1">
<iframe src="https://www.google.com/maps?q=Số 65, Hoàng Quốc Việt, Cầu Giấy, Hà Nội&output=embed" style="width: 100%; border: none"></iframe>
                        </div>
                        <div class="col2">
                            <h6>pleasantTours.com © 2020 - Đại lý Du lịch Trực tuyến Hàng đầu Việt Nam 2020</h6>
                            <ul>                             
                                <li>Số 65, Hoàng Quốc Việt, Cầu Giấy, Hà Nội</li>
                                <li>Email: pleasantour@gmail.com</li>
                                <li>SĐT: 093.434.5334</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>  
        </div>       
</body>
</html>