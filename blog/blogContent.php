<?php
    require_once ('../../Tour/db/dbhelper.php');
    $id = $name = $thumbnail = $content = $id_category = '';
    if (isset($_GET['id'])) {
        $id         = $_GET['id'];
        $sql        = 'select blog_post.name, blog_post.thumbnail, blog_post.content, blog_category.name as category from blog_post left join blog_category on blog_post.id_category = blog_category.id where blog_post.id = '.$id;
        $blog       = executeSingleResult($sql);
        if ($blog != null) {
            $name       = $blog['name'];
            $thumbnail  = $blog['thumbnail'];
            $content    = $blog['content'];
            $category   = $blog['category'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" type="text/css" href="../css/style_blog.css?version=51">
        
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
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
            <a href="../tour/searchTour.php" >Tham quan & giải trí</a>
            <a href="../blog.php" class="active">Cẩm nang du lịch</a>
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
    <div class="container" style="padding-bottom: 0; margin-top: 80px;">
        <div class="row">
            <div class="col-sm-12">
                <div class="row px-4">                       
                    <div class="text-primary" style="border: solid 1px #3477eb; border-radius: 30px; padding: 5px 10px 5px 10px; margin: 0 15px 15px 15px;background: #EFF6FC;"><?=$category?></div>
                    <div class="col-12">
                        <h1 style="margin-bottom: 30px;"><?=$name?></h1>
                    </div>
                    <div class="col-12">
                        <img class="img-fluid mx-auto d-block" src="<?=$thumbnail?>" style="margin-bottom: 30px;"/>
                    </div>
                    <div class="col-12"><?=$content?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5>Phù hợp với bạn</h5>
            </div>
        </div>
        <div class="row">
<?php
    $sql         = 'select blog_post.id, blog_post.name, blog_post.thumbnail, blog_post.content, blog_post.published_at, blog_category.name as category from blog_post left join blog_category on blog_post.id_category = blog_category.id ORDER BY RAND() LIMIT 3';
    $productList = executeResult($sql);
    $index = 1;
    foreach ($productList as $item) {
    echo '<div class="col-4">
        <div class="card mb-4 shadow-sm">
            <img class="card-img-top" src="'.$item['thumbnail'].'" alt="Card image cap" />
            <div class="card-body" style="padding-right: 10px;">    
                <h5 class="card-title" style="line-height: 1;">'.$item['name'].'</h5>
                <small class="text-primary font-italic my-0">'.$item['category'].'</small>
                <p class="card-text">'.mb_strimwidth(strip_tags($item['content']), 0, 125, "...").'</p>
                <i class="far fa-calendar-alt"></i>&nbsp;
                <span class="font-weight-bold">'.date("m/d/Y", strtotime($item['published_at'])).'</span>
                <a href="blogContent.php?id='.$item['id'].'">
                    <button type="button" class="btn btn-block" style="background: #ff5722; font-weight: bold; color: #fff; margin: 10px 0 10px 0;">ĐỌC</button>
                </a>
            </div>
        </div>
    </div>';
} ?>
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
                        <li><a href="../blog.php">Pleasant Tours Blog</a></li>
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
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
</html>