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
        <div class="container mt-4">
            <button class="btn btn-primary" onclick="printDiv('MyPrint')">
                <i class="fas fa-print"></i>
                <span>In bảng giá</span>
            </button>
            <a class="btn btn-warning" href="../index.php">
                <i class="fas fa-print"></i>
                <span>Quay lại</span>
            </a>
            <div id = "MyPrint">
                <div class="container">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="text-center">Bảng giá các sản phẩm tour du lịch</h2>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="50px">STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Giá bán</th>
                                        <th>Danh Mục</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //Lay danh sach danh muc tu database
                                $sql          = 'select tour.id, tour.name, tour.place, tour.price, tour.thumbnail, tour.updated_at, tour_category.name category_name from tour left join tour_category on tour.id_category = tour_category.id';
                                $productList = executeResult($sql);
                                $index = 1;
                                foreach ($productList as $item) {
                                    echo '<tr>
                                        <td>'.($index++).'</td>
                                        <td><img src="'.$item['thumbnail'].'" style="max-width: 150px;"/></td>
                                        <td>'.$item['name'].'</td>
                                        <td>'.$item['price'].'</td>
                                        <td>'.$item['category_name'].'</td>  
                                    </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
  function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;

       window.print();

       document.body.innerHTML = originalContents;
  }
</script>
</html>
