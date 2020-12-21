<?php
    require_once('../Tour/db/dbhelper.php');   
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

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d1b9594106.js" crossorigin="anonymous"></script>

    <!-- Style CSS -->
    <link rel="stylesheet" href="../Tour/css/style_admin.css">
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#">PLEASANT TOURS</a>
                <a class="navbar-brand hidden" href="#">
                    <img src="img/avatar_48.png" alt="Logo">
                    <span style="margin-left: 50px">Admin</span>
                </a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#">
                            <i class="menu-icon fa fa-dashboard"></i>
                            <span>Thông tin chính</span>
                        </a>
                    </li>
                    
                    <h3 class="menu-title">TOUR DU LỊCH</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="../Tour/tour/tourProduct.php"> 
                            <i class="menu-icon fa fa-laptop"></i>
                            <span>Tất cả các tour</span>
                        </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="../Tour/tour_category/tourList.php">
                            <i class="menu-icon fa fa-th"></i>
                            <span>Danh mục tour</span>
                        </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="../Tour/tour/addTourProduct.php"> 
                            <i class="menu-icon fa fa-table"></i>
                            <span>Thêm Tour mới</span>
                        </a>
                    </li>                       
                    <li class="menu-item-has-children dropdown">
                        <a href="../Tour/tour_category/addTourCategory.php">
                            <i class="menu-icon fa fa-th"></i>
                            <span>Thêm danh mục mới</span>
                        </a>
                    </li>

                    <h3 class="menu-title">Blog</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="../Tour/blog/blogList.php">
                            <i class="menu-icon fa fa-tasks"></i>
                            <span>Tất cả các bài</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Tour/blog/addBlog.php">
                            <i class="menu-icon far fa-newspaper"></i>
                            <span>Bài mới</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Tour/blog_category/blogCategory.php">
                            <i class="menu-icon fas fa-list"></i>
                            <span>Chuyên mục</span>
                        </a>
                    </li>

                    <h3 class="menu-title">KHÁC</h3>
                    <li class="menu-item-has-children">
                        <a href="../Tour/index.php">
                            <i class="menu-icon fa fa-paper-plane"></i>
                            <span>Thoát</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel" style="background: #d9d9d9;">
        <div class="header">
            <h4>THỐNG KÊ</h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p style="font-weight: bold; font-size: 30px; margin-bottom: 5px;">
                            <?php
                            $sql = "SELECT COUNT(*) FROM user";
                            $result = executeSingleResult($sql);
                            $count = $result['COUNT(*)'];
                            echo $count;
                            ?>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted">người dùng</h6>
                        </div> 
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p style="font-weight: bold; font-size: 30px; margin-bottom: 5px;">
                            <?php
                            $sql = "SELECT COUNT(*) FROM tour";
                            $result = executeSingleResult($sql);
                            $user_count = $result['COUNT(*)'];
                            echo $user_count;
                            ?>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted">sản phẩm tour</h6>
                        </div> 
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p style="font-weight: bold; font-size: 30px; margin-bottom: 5px;">
                            <?php
                            $sql = "SELECT COUNT(*) FROM tour_category";
                            $result = executeSingleResult($sql);
                            $user_count = $result['COUNT(*)'];
                            echo $user_count;
                            ?>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted">loại tour</h6>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p style="font-weight: bold; font-size: 30px; margin-bottom: 5px;">
                            <?php
                            $sql = "SELECT COUNT(*) FROM blog_post";
                            $result = executeSingleResult($sql);
                            $count = $result['COUNT(*)'];
                            echo $count;
                            ?>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted">bài blog</h6>
                        </div> 
                    </div>
                </div>
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <p style="font-weight: bold; font-size: 30px; margin-bottom: 5px;">
                            <?php
                            $sql = "SELECT COUNT(*) FROM blog_category";
                            $result = executeSingleResult($sql);
                            $count = $result['COUNT(*)'];
                            echo $count;
                            ?>
                            </p>
                            <h6 class="card-subtitle mb-2 text-muted">danh mục blog</h6>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
</html>