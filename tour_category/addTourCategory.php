<!-- PHP -->
<?php
    require_once ('../../Tour/db/dbhelper.php');

    $id = $name = '';
    if (!empty($_POST)) {
            if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                    $name = str_replace('"', '\\"',  $name);
            }
            if (isset($_POST['id'])) {
                    $id = $_POST['id'];
            }

            if (!empty($name)) {
                    $created_at = $updated_at = date('Y-m-d H:s:i');
                    //Luu vao database
                    if ($id == '') {
                            $sql = 'insert into tour_category(name, created_at, updated_at) values ("'.$name.'", "'.$created_at.'", "'.$updated_at.'")';
                    } else {
                            $sql = 'update tour_category set name = "'.$name.'", updated_at = "'.$updated_at.'" where id = '.$id;
                    }

                    execute($sql);

                    header('Location: ../tour_category/tourList.php');
                    die();
            }
    }

    if (isset($_GET['id'])) {
            $id       = $_GET['id'];
            $sql      = 'select * from tour_category where id = '.$id;
            $category = executeSingleResult($sql);
            if ($category != null) {
                    $name = $category['name'];
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

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d1b9594106.js" crossorigin="anonymous"></script>

    <!-- Style CSS -->
    <link rel="stylesheet" href="../../Tour/css/style_admin.css">       
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
                    <img src="../img/avatar_48.png" alt="Logo">
                    <span style="margin-left: 50px">Admin</span>
                </a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="../admin.php">
                            <i class="menu-icon fa fa-dashboard"></i>
                            <span>Thông tin chính</span>
                        </a>
                    </li>
                    
                    <h3 class="menu-title">TOUR DU LỊCH</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="../tour/tourProduct.php"> 
                            <i class="menu-icon fa fa-laptop"></i>
                            <span>Tất cả các tour</span>
                        </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="../tour_category/tourList.php">
                            <i class="menu-icon fa fa-th"></i>
                            <span>Danh mục tour</span>
                        </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="../tour/addTourProduct.php"> 
                            <i class="menu-icon fa fa-table"></i>
                            <span>Thêm Tour mới</span>
                        </a>
                    </li>                       
                    <li class="menu-item-has-children dropdown active">
                        <a href="#">
                            <i class="menu-icon fa fa-th"></i>
                            <span>Thêm danh mục mới</span>
                        </a>
                    </li>

                    <h3 class="menu-title">Blog</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="../blog/blogList.php">
                            <i class="menu-icon fa fa-tasks"></i>
                            <span>Tất cả các bài</span>
                        </a>
                    </li>
                    <li>
                        <a href="../blog/addBlog.php">
                            <i class="menu-icon far fa-newspaper"></i>
                            <span>Bài mới</span>
                        </a>
                    </li>
                    <li>
                        <a href="../blog_category/blogCategory.php">
                            <i class="menu-icon fas fa-list"></i>
                            <span>Chuyên mục</span>
                        </a>
                    </li>

                    <h3 class="menu-title">KHÁC</h3>
                    <li class="menu-item-has-children">
                        <a href="../index.php">
                            <i class="menu-icon fa fa-paper-plane"></i>
                            <span>Thoát</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <div class="container">
            <div class="panel panel-primary">
		<div class="panel-heading">
                    <h2 class="text-center">Thêm/Sửa Danh Mục Tour</h2>
		</div>
		<div class="panel-body">
                    <form method="post">
			<div class="form-group">
                            <label for="name">Tên Danh Mục:</label>
                            <input type="text" name="id" value="<?=$id?>" hidden="true">
                            <input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
			</div>
			<button class="btn btn-success">Lưu</button>
                    </form>
		</div>
            </div>
	</div>
    </div>   
</body>
</html>