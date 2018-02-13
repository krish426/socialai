<?php require_once 'connection.php';
    session_start();
    $_SESSION['id'] = $_GET['id'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Campaign | <?php echo BASE_TITLE;?></title>
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

    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
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
                <a class="navbar-brand" href="index.php">MATERIAL DESIGN</a>
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
                                        <li class="<?php echo ($_SESSION['id'] == $row['id']) ? 'active' : '';?>">
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
        </aside>
    </section>

    <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>CAMPAIGN</h2>
                </div>

                <div class="row clearfix js-sweetalert">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header" >
                                <h2>
                                   Campaign - (<?php echo $_GET['name']?>)
                                </h2>

                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right" >
                                            <li><a href="javascript:void(0);" data-type="confirm"><button class="btn bg-red btn-block waves-effect" data-type="confirm">Delete Campaign</button></a></li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>
                            <div class="body">
                                    <div class="row clearfix demo-button-sizes">
                                        <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                            <a href="snap-setup.php"><button type="button" class="btn bg-red btn-block btn-lg waves-effect">Social account</button></a>
                                        </div>
                                        <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                            <a href="message_list.php?id=<?php echo $_GET['id'];?>"><button type="button" class="btn bg-red btn-block btn-lg waves-effect">Messages</button></a>
                                        </div>
                                        <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                                            <a href="index.php"><button type="button" class="btn bg-red btn-block btn-lg waves-effect">Add Campaign</button></a>
                                        </div>
                                    </div>


                                <form class="form-horizontal" action="" method="POST" style="display: none;">


                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Project Name</label>
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

    
    <!-- Sparkline Chart Plugin Js -->
    
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script type="text/javascript">
        var id = '<?php echo $_GET['id'];?>';
        var based = '<?php echo BASE_SERVER;?>';
        console.log("based :::: ", based);
    </script>
    <script type="text/javascript" src="js/pages/ui/dialogs.js?v=23s42"></script>
    
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>