<?php
require './cauhinh/connection.php'; // Sử dụng file config
session_start();
if(!isset($_SESSION['users_role']) || $_SESSION['users_role'] != 'giangvien'){
    header("Location: login.php");
    exit();
}
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome </title>
 
<link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/styles_admin.css">

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/lumino.glyphs.js"></script>
<script src="js/bootstrap.min.js"></script>

<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
            <a class="navbar-brand text-hide" href="#">User</a>            
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<ul class="user-menu">
					<li class="dropdown pull-right">                      
					  <a href="" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user">
                        <use xlink:href="#stroked-male-user"></use></svg><span style="color: white;"> 
                        <?php if(isset($_SESSION['users_username'])):?>Xin chào, <?php echo $_SESSION['users_username']; ?></span></a>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown"><span style="color: white;"><?php endif; ?></span></a>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="quantri.php?page_layout=ThongTin_TK&users_id= <?php if(isset($_SESSION['users_id'])):?><?php echo $_SESSION['users_id'];?>"><?php endif; ?><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Thông tin thành viên</a></li>
                                <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Cài đặt</a></li>
                                <li><a href="./chucnang/logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>
                            </ul> 
                    </li>
			  </ul>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar" style="z-index:9999;">
		
		<ul class="nav menu">			
			<li class="parent ">
				<a href="">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down">
					<use xlink:href="#stroked-chevron-down"></use></svg></span> 
					Giảng viên
				</a>
                <ul class="children collapse in" id="sub-item-1">   
							
							<li>						
								<a href="quantri.php?page_layout=event" class="">
									<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> 
									Xem tiến độ khóa luận
								</a>								
							</li>
                            
							</ul>	
							<ul class="children collapse in" id="sub-item-1">   
							
							<li>						
								<a href="quantri.php?page_layout=chat" class="">
									<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> 
									Tin nhắn
								</a>								
							</li>
                            
							</ul>				
			</li>
            <li class="parent ">
				<a href="">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down">
					<use xlink:href="#stroked-chevron-down"></use></svg></span> 
					Hệ thống
                </a>
                    <ul class="children collapse in" id="sub-item-1">
                   
					<li><a href="./chucnang/logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>				
                </ul>                
            </li>   				
            <li role="presentation" class="divider"></li>    
                
		</ul>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <?php  
                //master page
                if(isset($_GET['page_layout'])){
                    switch ($_GET['page_layout']) {
                        case 'event':include_once'./chucnang/QL_TiendoKL/event.php';
                            break;
						case 'chat':include_once'./chucnang/QL_TiendoKL/chat.php';
                            break;
						
					 default:include_once'./quantri.php';
                    }
                }
                else{
                    include_once'./quantri.php';
                }
            ?>
	


</body>

</html>
<?php ob_end_flush(); 