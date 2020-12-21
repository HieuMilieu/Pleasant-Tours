<?php
    session_start();
    require_once ('../Tour/db/dbhelper.php');
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
        <link rel="stylesheet" type="text/css" href="../Tour/css/style.css">
        
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
        <a href="../Tour/tour/searchTour.php">Tham quan & giải trí</a>
        <a href="../Tour/blog.php" target="blank">Cẩm nang du lịch</a>
        <a href="#" class="active">Liên hệ</a>
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
        <div class="main mt-2">                                    
            <div class="container">
      <div class="row">
          <div class="col-lg-8 offset-lg-2 col-12">
              <div class="row">
                  <div class="col-lg-12 col-12 p-0 contact-us">
                    <h4 class="">CONTACT US</h4><hr>
                  </div>
              </div>
              <div class="row bg-light pt-3 pb-3 mb-4">
                  <div class="col-lg-12">
                    <h6>ADDRESS :</h6>
                  </div>
                  <div class="col-lg-4 col-4">
                      Số 65, Hoàng Quốc Việt, Cầu Giấy, Hà Nội                      
                  </div>
                  <div class="col-lg-4 col-4">
                  <p class="m-0 text-danger"><i class="fa fa-phone-square" aria-hidden="true"></i>
                      093.434.5334
                  </p>
                  <p class="m-0 text-info"><i class="fa fa-envelope" aria-hidden="true"></i>
                      pleasantour@gmail.com
                  </p>
                  </div>
                  <div class="col-lg-4 col-4 address-icon text-center text-danger">
                      <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
              </div>
              <div class="row bg-light pt-3 pb-3 mb-4">
                  <div class="col-lg-6 col-12">
                    <form>
                      <div class="form-row mb-3">
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Name :">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Company :">
                        </div>
                      </div>
                      <div class="form-row mb-3">
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Email :">
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Mobile :">
                        </div>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message :"></textarea>
                      </div>
                      <button type="submit" class="btn btn-danger mb-4">Send</button>
                    </form>
                  </div>
                  <div class="col-lg-6 col-12">
                      <div style="width: 100%">
                            <iframe src="https://www.google.com/maps?q=Số 65, Hoàng Quốc Việt, Cầu Giấy, Hà Nội&output=embed" style="width: 100%; height: 300px; border: none"></iframe>
                      </div>
                      <div class="icons">
                          <a href=""><i class="fa fa-facebook"></i></a>
                          <a href=""><i class="fa fa-twitter"></i></a>
                          <a href=""><i class="fa fa-linkedin"></i></a>
                          <a href=""><i class="fa fa-github"></i></a>
                      </div>
                  </div>
              </div>
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
                            <a href="#" target="blank"><img src="img/logoSaleNoti.png" style="width: 100px;height: 40px;"></a>
                        </div>
                        <div class="col-3">
                            <h5>Về Pleasant Tours</h5>
                            <ul>
                                <li><a href="#">Chúng tôi</a></li>
                                <li><a href="../Tour/blog.html">Pleasant Tours Blog</a></li>
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
            </div>
        </div>
        
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
            
        <script>
            $(document).ready(function () {
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function (p) {
                        showUserDetails(p.coords.latitude, p.coords.longitude);
                    }, function (e) {
                        ipLookup();
                    });
                } else
                    ipLookup();
            });
        </script>
    </body>
</html>