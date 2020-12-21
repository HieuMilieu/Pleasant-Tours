<?php 
    session_start();
    require_once ('../db/dbhelper.php');
    $id = $name = $place = $price = $duration = $transport = $thumbnail = $content = $id_category = '';
    if (isset($_GET['id'])) {
        $id       = $_GET['id'];
        $sql      = 'select * from tour where id = '.$id;
        $tour = executeSingleResult($sql);
        if ($tour != null) {
            $name = $tour['name'];
            $place = $tour['place'];
            $price = $tour['price'];
            $thumbnail = $tour['thumbnail'];
            $content = $tour['content'];
            $id_category = $tour['id_category'];
            $duration = $tour['duration'];
            $transport = $tour['transport'];
        }
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
    <link rel="stylesheet" type="text/css" href="../css/style.css?version=51">
        
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
        <a href="../index.php">Trang chủ</a>
        <a href="../tour/searchTour.php" class="active">Tham quan & giải trí</a>
        <a href="../blog.php" target="blank">Cẩm nang du lịch</a>
        <a href="../contact.php">Liên hệ</a>
    </div>
    <div class="buttons">            
<?php
if(!isset($_SESSION['userinfor'])) {
    echo '  <a class="btn btn-orange mr-sm-2" href="../Tour/login.php">Đăng nhập</a>'
    . '<a class="btn btn-orange2" href="../Tour/register.php">Đăng ký</a>';                
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
            <h1 class="tour-name"><?=$name?></h1>
            <div class="row" style="border: solid 1px #d9d9d9; margin: 0;">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pos-relative" style="padding: 0;">               
                    <img class="d-block w-100" src="<?=$tour['thumbnail']?>" alt="First slide">
                </div> 
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" style="padding: 20px;">
                    <div class="row">
                        <div class="col-12">
                            <div style="float: left; margin-top:8px" class="hidden-xs">
                                <strong>4.63</strong>
                                <strong>/ 5</strong> trong
                                <strong>366</strong> Đánh giá                                
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fas fa-eye" style="color: #777"></i>&nbsp;
                                    <span>581</span>
                                </div>
                                <div class="col-3">
                                    <i class="far fa-thumbs-up" style="color: #777"></i>&nbsp;
                                    <span>126</span>
                                </div>
                                <div class="col-3">
                                    <i class="far fa-comment" style="color: #777"></i>&nbsp;
                                    <span>0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mg-bot10">
                        <div class="col-lg-4 col-md-2 col-sm-3 col-xs-6">Khởi hành:</div>
                        <div class="col-lg-8 col-md-10 col-sm-9 col-xs-6">
                            12/11/2020
                        </div>
                    </div>
                    <div class="row mg-bot10">
                        <div class="col-lg-4 col-md-2 col-sm-3 col-xs-6">Thời gian:</div>
                        <div class="col-lg-8 col-md-10 col-sm-9 col-xs-6" style="color: #ff5722; font-weight: bold;"><?=$duration?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">Giá:</div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                            <p class="text-danger font-weight-bold text-right" style="font-size: 30px"><?=number_format($price, 0, ",", ".") ?> VND</p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="../booking.php?id=<?=$id?>" class="btn btn-orange btn-md btn-block">
                                <i class="fas fa-cart-plus"></i>&nbsp;&nbsp;
                                Đặt ngay
                            </a>
                            <a href="../tour/word.php?id=<?=$id?>" target="blank" class="btn btn-orange2 btn-md btn-block">
                                In hành trình
                            </a>
                        </div>
                    </div>
                </div>               
            </div>            
            <div class="row" style="margin: 20px 0;">
                <div class="col-12" style="text-transform: uppercase; font-weight: 500; font-size: 20px; background: #e1e1e1; padding: 15px;">
                    Thông tin về chuyến đi
                </div>
                <div class="col-12" style="background: #f1f1f1; padding: 10px 15px 15px 15px; font-size: 20px;">
                    <?=$content?>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="container-fluid px-0" style="border-top: solid 1px #d9d9d9;">
            <div class="container"> 
                <div class="row bg-footer">
                    <div class="col-3 text-center">
                        <p>Được chứng nhận</p>
                        <a href="#" target="blank"><img src="../img/logoSaleNoti.png" style="width: 100px;height: 40px;"></a>
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