<?php
    require_once ('../../Tour/db/dbhelper.php');
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
                    <li class="menu-item-has-children">
                        <a href="../tour/tourProduct.php"> 
                            <i class="menu-icon fa fa-laptop"></i>
                            <span>Tất cả các tour</span>
                        </a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="../tour_category/tourList.php">
                            <i class="menu-icon fa fa-th"></i>
                            <span>Danh mục tour</span>
                        </a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="../tour/addTourProduct.php"> 
                            <i class="menu-icon fa fa-table"></i>
                            <span>Thêm Tour mới</span>
                        </a>
                    </li>                       
                    <li class="menu-item-has-children">
                        <a href="../tour_category/addTourCategory.php">
                            <i class="menu-icon fa fa-th"></i>
                            <span>Thêm danh mục mới</span>
                        </a>
                    </li>

                    <h3 class="menu-title">Blog</h3>
                    <li class="menu-item-has-children">
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
                    <li class="menu-item-has-children active">
                        <a href="#">
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
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Quản Lý Danh Mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../blog/blogList.php">Quản Lý Bài Viết</a>
                </li>
            </ul>

	<div class="container">
            <div class="panel panel-primary">
		<div class="panel-heading">
                    <h2 class="text-center">Quản Lý Danh Mục Blog</h2>
		</div>
		<div class="panel-body">
                    <a href="../blog_category/addBlogCategory.php">
			<button class="btn btn-success" style="margin-bottom: 15px;">Thêm Danh Mục</button>
                    </a>
                    <table class="table table-bordered table-hover">
			<thead>
                            <tr>
				<th width="50px">STT</th>
				<th>Tên Danh Mục</th>
				<th width="50px"></th>
				<th width="50px"></th>
                            </tr>
			</thead>
			<tbody>
                        <?php
                        //Lay danh sach danh muc tu database
                        $limit = 5;
                        $page = 1;
                        if(isset($_GET['page'])) {
                            $page = $_GET['page'];
                        }
                        if($page <= 0) {
                            $page = 1;
                        }
                        $firstIndex = ($page - 1)*$limit;
                        //Trang can lay san pham, so phan tu tren 1 trang: $limit
                        $sql          = 'select * from blog_category where 1 limit '.$firstIndex.', '.$limit;
                        $categoryList = executeResult($sql);
                        
                        $sql            = 'select count(id) as total from blog_category';
                        $countResult    = executeSingleResult($sql);
                        $count          = $countResult['total'];
                        $number         = ceil($count/$limit);
                        foreach ($categoryList as $item) {
                            echo '<tr>
                                <td>'.(++$firstIndex).'</td>
                                <td>'.$item['name'].'</td>
                                <td>
                                    <a href="add.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
                                </td>
                                <td>
                                    <button class="btn btn-danger" onclick="deleteCategory('.$item['id'].')">Xoá</button>
                                </td>
                            </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php 
                        if($number > 1) {
                    ?>
                    <ul class="pagination">
                        <?php
                        if($page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page='.($page - 1).'">Previous</a></li>';
                        }
                        ?>
                        
                        <?php
                        for($i = 0; $i < $number; $i++) {
                            if($page == ($i+1)) {
                                echo '<li class="page-item active"><a class="page-link" href="#">'.($i+1).'</a></li>';                            
                            } 
                            else {
                                echo '<li class="page-item"><a class="page-link" href="?page='.($i+1).'">'.($i+1).'</a></li>';
                            }
                        }
                        ?>
                        
                        <?php
                        if($page < ($number)) {
                            echo '<li class="page-item"><a class="page-link" href="?page='.($page + 1).'">Next</a></li>';
                        }
                        ?>
                        
                    </ul>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
                    
        <script type="text/javascript">
            function deleteCategory(id) {
                var option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?');
                if(!option) {
                    return;
                }
                console.log(id)
                //ajax - lenh post
                $.post('ajax.php', {
                    'id': id,
                    'action': 'delete'
                }, function(data) {
                    location.reload()
                })
            }
        </script>

	</div>
    </div>   
</body>
</html>