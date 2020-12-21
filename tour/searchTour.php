<?php
    session_start();
    require_once ('../db/dbhelper.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title -->
        <title>Pleasant Tours</title>

        <!-- jQuery library -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

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
    echo '<a class="logo" href="#">PLEASANT TOURS</a>';
}
?>
    <div class="menu">
        <a href="../index.php">Trang chủ</a>
        <a href="#" class="active">Tham quan & giải trí</a>
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
    
        <!-- Main Page -->                                 
        <div class="container main" style="max-width: 1800px;">
                <h4>Tìm kiếm các tour du lịch</h4>
                <hr>
                <div class="row">
                    <div class="col-3" style="border-right: solid 1px #c8c9ce; padding-right: 30px;">
                        <h6>Lọc theo điểm đến</h6>
                        <div>
                            <label for="category">Chọn Danh Mục:</label>
                            <form method="get">
                                <select class="form-control" name="category" id="category">
                                    <option value="" selected disabled>-- Lựa chọn danh mục --</option>
<?php 
    $sql = 'select * from tour_category';
    $categoryList = executeResult($sql);
    
    foreach($categoryList as $item) {
        if($item['id'] == $id_category) {
            echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
        } else {
            echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
        }
    }
?>      
                                </select>
                                <button class="btn btn-orange mt-2 text-white" type="submit">Tìm kiếm</button>
<?php
    if(isset($_GET['category'])){
        echo '<a href="../Tour/tour/searchTour.php"><button class="btn btn-orange2 mt-2">Thoát</button></a>';
    }
?>
                                <a href="priceList.php" class="btn btn-orange btn-block mt-2 text-white" type="submit">In bảng giá</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-9" style="padding-left: 40px;">
                        <div class="row">
<?php
    $sql         = 'select tour.id, tour.name, tour.place, tour.price, tour.duration, tour.thumbnail, tour.updated_at, tour_category.name as category_name from tour left join tour_category on tour.id_category = tour_category.id';
    $productList = executeResult($sql);
    if(isset($_GET['category'])){
        $category = $_GET['category'];
        $sql         = 'select tour.id, tour.name, tour.place, tour.price, tour.duration, tour.thumbnail, tour.updated_at, tour_category.name as category_name from tour left join tour_category on tour.id_category = tour_category.id where tour_category.id ='.$category;
        $productList = executeResult($sql);
    }
    foreach ($productList as $item) {
    echo '<div class="col-sm-4 mb-3">
        <div class="card mb-4 shadow-sm">
            <img class="card-img-top" src="'.$item['thumbnail'].'" alt="Card image cap" />
            <div class="card-body">    
                <div style="height: 45px">
                    <h5 class="card-title">'.$item['name'].'</h5>
                </div>
                <p>
                    <i class="far fa-calendar-alt text-success"></i>
                    <span class="text-success">'.$item['duration'].'</span>
                </p>
                <p>
                    <i class="fas fa-map-marker-alt" style="color: #9403fc"></i>
                    <span style="color: #9403fc">'.$item['place'].'</span>
                </p>
                <p class="card-subtitle mb-2 text-muted">Giá 1 khách</p>
                <h4 class="text-danger font-weight-bold">'.number_format($item['price'], 0, ",", ".").'</h4>
                <a href="details.php?id='.$item['id'].'">
                    <button type="button" class="btn btn-block" style="background: #ff5722; font-weight: bold; color: #fff; margin-top: 15px;">CHI TIẾT</button>
                </a>
            </div>
        </div>
    </div>';

} ?>
                        </div>
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
