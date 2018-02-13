<?php require_once 'connection.php';?>

<?php 
    session_start();
    if($_SESSION['logged_in'] != 'y'){
        header("Location: ".HOST."signin.php");
    }
    if(isset($_GET['logout']) && $_GET['logout']){
        session_destroy();
        header("Location: ".HOST);
    }
    
    // $file = 'inc/nxs-functions.php';
    // $newfile = 'inc/nxs-functions-'.$id.'.php';
    
    // if (!copy($file, $newfile)) {
    //     echo "failed to copy";
    // }

    // $str = file_get_contents('inc/nxs-functions-2342353412312.php');
    // $str = str_replace("nx-snap-settings.txt", $id."-nx-snap-settings.txt",$str);
    // file_put_contents('inc/nxs-functions-2342353412312.php', $str);
    // die;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>HOME | <?php echo BASE_TITLE;?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="">MATERIAL DESIGN</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo (isset($_SESSION['logged_username'])) ? $_SESSION['logged_username'] : ''; ?></div>
                    <div class="email"><?php echo (isset($_SESSION['logged_email'])) ? $_SESSION['logged_email'] : ''; ?></div>
                    <div class="btn-group user-helper-dropdown" style="display: block;">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Add Users</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="index.php?logout=true"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Campaigns</span>
                        </a>

                        <ul class="ml-menu">
	                        
	                        <?php 
                                $result = $conn->query("SELECT id, name, description FROM campaigns");
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) { ?>
                                        <li class="<?php echo (isset($_GET['id'])) ? ($_GET['id'] == $row['id']) ? 'active' : '' : '';?>">
                                            <a href="campaign.php?id=<?php echo $row['id'];?>&name=<?php echo $row['name'];?>">
                                                <span><?php echo $row['name'];?></span>
                                            </a>
                                        </li>
                                    <?php }
                                } else {
                                    
                                }
                            ?>
	                    </ul>

                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
	        <div class="container-fluid">
	            <div class="block-header">
	                <h2>PROJECTS</h2>
	            </div>

	            <div class="row clearfix">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    <div class="card">
	                        <div class="header">
	                            <h2>
	                                Create New Campaign
	                            </h2>
                            </div>
	                        <div class="body">
	                            <form class="form-horizontal" id="campaign_form">
	                                
	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                    	<label for="name">Campaign Name</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your Camapign Name">
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row clearfix">
	                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                                        <label for="password_2">Description</label>
	                                    </div>
	                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
	                                        <div class="form-group">
	                                            <div class="form-line">
	                                                <textarea rows="5" name="description" class="form-control no-resize auto-growth" placeholder="Enter your description here.."></textarea>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="row clearfix">
	                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
	                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
	                                    </div>
	                                </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>

    <script type="text/javascript">
        
    </script>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <!-- <script src="js/pages/index.js"></script> -->

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <!-- Bootstrap Notify Plugin Js -->
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <script src="js/pages/ui/notifications.js?v=4"></script>

    
    <script type="text/javascript">
        
        // var placementFrom = 'top';
        // var placementAlign = 'center';
        // var animateEnter = '';
        // var animateExit = '';
        // var colorName = 'bg-green';

        // showMessageNotification(colorName, null, placementFrom, placementAlign, animateEnter, animateExit);
    
        $( "#campaign_form" ).submit(function( event ) {
          
            var data = $('#campaign_form').serialize();
            console.log("data :::::: ", data);

            $.ajax({
                url: '<?php echo BASE_SERVER;?>saveCampaign?'+data,
                type: 'GET',
                success: function(result){
                    // alert("Successfully saved new Campaign !!!");
                    
                }
            })
            event.preventDefault();
            setTimeout(function(){// wait for 5 secs(2)
                   location.reload(); // then reload the page.(3)
              }, 1000);
        });
    </script>
</body>

</html>