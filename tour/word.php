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
    <div class="container">
        <button class="btn btn-primary" onclick="printDiv('MyPrint')">
                <i class="fas fa-print"></i>
                <span>In hành trình</span>
        </button>
        <a class="btn btn-warning" href="../index.php">
            <i class="fas fa-print"></i>
            <span>Quay lại</span>
        </a>
	<div id = "MyPrint">
            <div class="container">
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
	        <div class="row mt-2">
	        	<h5>Hành trình chuyến đi</h5>
	        	<div class="col-12">
	        		<?=$content?>
	        	</div>
	        </div>	        
            </div>
	</div>
    </div>
<script type="text/javascript">
  function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;

       window.print();

       document.body.innerHTML = originalContents;
  }
</script>
</body>
</html>