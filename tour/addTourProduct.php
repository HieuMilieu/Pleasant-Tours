<!-- PHP -->
<?php
    require_once ('../../Tour/db/dbhelper.php');

    $id = $name = $place = $price = $price_child = $duration = $transport = $thumbnail = $content = $id_category = '';
    if (!empty($_POST)) {
            if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                    $name = str_replace('"', '\\"',  $name);
            }
            if (isset($_POST['id'])) {
                    $id = $_POST['id'];
            }
            if (isset($_POST['place'])) {
                    $place = $_POST['place'];
                    $place = str_replace('"', '\\"',  $place);
            }
            if (isset($_POST['price'])) {
                    $price = $_POST['price'];
            }
            if (isset($_POST['price_child'])) {
                    $price_child = $_POST['price_child'];
            }
            if (isset($_POST['duration'])) {
                    $duration = $_POST['duration'];
                    $duration = str_replace('"', '\\"',  $duration);
            }
            if (isset($_POST['transport'])) {
                    $transport = $_POST['transport'];
                    $transport = str_replace('"', '\\"',  $transport);
            }
            if (isset($_POST['thumbnail'])) {
                    $thumbnail = $_POST['thumbnail'];
                    $thumbnail = str_replace('"', '\\"',  $thumbnail);
            }
            if (isset($_POST['content'])) {
                    $content = $_POST['content'];
                    $content = str_replace('"', '\\"',  $content);
            }
            if (isset($_POST['id_category'])) {
                    $id_category = $_POST['id_category'];
            }

            if (!empty($name)) {
                    $created_at = $updated_at = date('Y-m-d H:s:i');
                    //Luu vao database
                    if ($id == '') {
                            $sql = 'insert into tour(name, place, price, price_child, duration, transport, thumbnail, id_category, content, created_at, updated_at) values ("'.$name.'", "'.$place.'", "'.$price.'", "'.$price_child.'","'.$duration.'", "'.$transport.'", "'.$thumbnail.'", "'.$id_category.'", "'.$content.'","'.$created_at.'", "'.$updated_at.'")';
                    } else {
                            $sql = 'update tour set name = "'.$name.'", place = "'.$place.'",price = "'.$price.'", price_child = "'.$price_child.'",thumbnail = "'.$thumbnail.'", id_category = "'.$id_category.'", content = "'.$content.'", updated_at = "'.$updated_at.'" where id = '.$id;
                    }

                    execute($sql);

                    header('Location: ../../Tour/tour/tourProduct.php');
                    die();
            }
    }

    if (isset($_GET['id'])) {
            $id       = $_GET['id'];
            $sql      = 'select * from tour where id = '.$id;
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
    
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    
    <!-- cloudinary -->
    <script src="../cloudinary/upload.js"></script>   
    <script>
        function uploadFile(that) {
            uploadURLCloudinary(that.files[0], function(path) {
                $('#thumbnail').val(path)
                $('#img_thumbnail').attr('src', path)
            })
        }
    </script>
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
                    <li class="menu-item-has-children dropdown active">
                        <a href="../tour/addTourProduct.php"> 
                            <i class="menu-icon fa fa-table"></i>
                            <span>Thêm Tour mới</span>
                        </a>
                    </li>                       
                    <li class="menu-item-has-children dropdown">
                        <a href="../tour_category/addTourCategory.php">
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
                    <h2 class="text-center">Thêm/Sửa Sản Phẩm Tour</h2>
		</div>
		<div class="panel-body">
                    <form method="post">
			<div class="form-group">
                            <label for="name">Tên Sản Phẩm:</label>
                            <input type="text" name="id" value="<?=$id?>" hidden="true">
                            <input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
			</div>
                        
                        <div class="form-group">
                            <label for="place">Địa chỉ:</label>
                            <input required="true" type="text" class="form-control" id="place" name="place" value="<?=$place?>">
			</div>
                        
                        <div class="form-group">
                            <label for="price">Giá người lớn (từ 18 tuổi trở lên):</label>
                            <input required="true" type="number" class="form-control" id="price" name="price" value="<?=$price?>">
			</div>
                        
                        <div class="form-group">
                            <label for="price_child">Giá trẻ em (dưới 18 tuổi):</label>
                            <input required="true" type="number" class="form-control" id="price_child" name="price_child" value="<?=$price_child?>">
			</div>
                        
                        <div class="form-group">
                            <label for="price">Thời gian:</label>
                            <input required="true" type="text" class="form-control" id="duration" name="duration" value="<?=$duration?>">
			</div>
                        
                        <div class="form-group">
                            <label for="price">Phương tiện:</label>
                            <input required="true" type="text" class="form-control" id="transport" name="transport" value="<?=$transport?>">
			</div>
                        
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail:</label>                           
                            <div>
                                <input type="text" name="thumbnail" id="thumbnail" style="display: none"/>
                                <input id="fileupload" onchange="uploadFile(this)" type="file" accept="image/gif, image/jpeg, image/png">
                            </div>
                            <img src="<?=$thumbnail?>" style="max-width: 200px;" id="img_thumbnail">
			</div>
                        
                        <div class="form-group">
                            <label for="category">Chọn Danh Mục:</label>
                            <select class="form-control" name="id_category" id="id_category">
                                <option>-- Lựa chọn danh mục --</option>
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
                        </div>
                                               
                        <div class="form-group">
                            <label for="content">Nội dung:</label>
                            <textarea required="true" type="text" class="form-control" id="content" name="content"><?=$content?></textarea>
			</div>
			<button class="btn btn-success">Lưu</button>
                    </form>
		</div>
            </div>
	</div>
    </div>
    
    <script type="text/javascript">       
        $(function() {
            // Đợi website load nội dung => xử lý phần js
            $('#content').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
        });
    </script>
</body>
</html>