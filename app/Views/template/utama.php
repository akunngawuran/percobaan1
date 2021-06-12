<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="Nusantara Online Services">
    <title>Nusantara Online Services</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-chat.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/widgets.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->
    <script src="https://www.gstatic.com/firebasejs/5.1.0/firebase.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <style type="text/css">
    	.tengah{
    		text-align: center;
    	}
    	.kanan{
    		text-align: right;
    	}
    	.vertikal{
    		vertical-align: middle;
    	}
        .hitam{
            color:#3d3d3d;
        }
        .kuning{
            color:#fbaa29;
        }
        .tebal{
            font-weight: bold;
        }
    </style>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyCvMdL49erpPz79mByazCvBbtFJ09jrpeE",
            authDomain: "nusantaraonlinesistem.firebaseapp.com",
            databaseURL: "https://nusantaraonlinesistem.firebaseio.com",
            projectId: "nusantaraonlinesistem",
            storageBucket: "nusantaraonlinesistem.appspot.com",
            messagingSenderId: "244372032201",
            appId: "1:244372032201:web:a66b59f4a11e07fa475b18",
            measurementId: "G-C467V8W31F"
        };
        firebase.initializeApp(config);
        var dr = firebase.database().ref();

        function bukanSatuan(angka){
            var tampung = angka
            if(tampung < 10){
                tampung = "0"+tampung
            }
            return tampung;
        }

        function tglSekarang(){
            var dt = new Date();

            tgl = bukanSatuan(dt.getDate())
            bln = bukanSatuan((dt.getMonth() + 1))
            thn = dt.getFullYear()

            return thn+'-'+bln+'-'+tgl
        }

        function kodekirimagen(){
            var dt = new Date();

            var tgl = bukanSatuan(dt.getDate())
            var bln = bukanSatuan((dt.getMonth() + 1))
            var thn = dt.getFullYear()
            var jam = dt.getHours()
            var menit = dt.getMinutes()
            var detik = dt.getSeconds()

            if(Number(jam) < 10){
                jam = "0"+jam
            }
            if(Number(menit) < 10){
                menit = "0"+menit
            }
            if(Number(detik) < 10){
                detik = "0"+detik
            }

            return 'L-'+bln+''+tgl+''+jam+''+menit+''+detik+'-'
        }

        function kodekirimcabang(){
            var dt = new Date();

            var tgl = bukanSatuan(dt.getDate())
            var bln = bukanSatuan((dt.getMonth() + 1))
            var thn = dt.getFullYear()
            var jam = dt.getHours()
            var menit = dt.getMinutes()
            var detik = dt.getSeconds()

            if(Number(jam) < 10){
                jam = "0"+jam
            }
            if(Number(menit) < 10){
                menit = "0"+menit
            }
            if(Number(detik) < 10){
                detik = "0"+detik
            }

            return 'D-'+bln+''+tgl+''+jam+''+menit+''+detik+'-'
        }

        function jamSekarang(){
            var dt = new Date();
            var jam = dt.getHours()
            var menit = dt.getMinutes()
            var detik = dt.getSeconds()

            if(Number(jam) < 10){
                jam = "0"+jam
            }
            if(Number(menit) < 10){
                menit = "0"+menit
            }
            if(Number(detik) < 10){
                detik = "0"+detik
            }
            return jam+':'+menit+':'+detik
        }

        function logout(){
            if(confirm('Anda yakin akan keluar dari aplikasi?')){
                keluar()
            }
        }

        function keluar(){
            firebase.auth().signOut().then(function() {
                $.ajax({
                    url: '<?php echo base_url('keluar') ?>',
                    type: "POST",
                    data: {datalogout: 'logout'},
                    success: function(respon) {
                        location.href="<?=base_url('login');?>"
                    },
                    error: function() {
                        alert("error");
                    }
                })
            }).catch(function(error) {
            });
        }

        function hapusDuplikat(list){
            var hasil = [];
            $.each(list, function(i, e) {
                if ($.inArray(e, hasil) == -1) hasil.push(e);
            });
            return hasil;
        }

        function notifuser(title, body, idpemesan){
            dr.child("token_user").child(idpemesan).once('value', function(tu){
                $.get("notif.php?tokennya="+tu.val()+"&judul="+title+"&pesan="+body)
            })
        }

        function notifsukses(judul, pesan){
            toastr.success(pesan,judul);
        }
    </script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </ul>
                        <?php if(session('sebagai') !== "admin"){ ?>
                        <ul class="nav navbar-nav bookmark-icons">
	                        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon bx bx-search"></i></a>
	                            <div class="search-input">
	                                <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
	                                <input class="input" type="text" placeholder="Pencarian..." tabindex="-1" data-search="template-search">
	                                <div class="search-input-close"><i class="bx bx-x"></i></div>
	                                <ul class="search-list"></ul>
	                            </div>
	                        </li>
                        </ul>
                        <?php } ?>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <!-- <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">7 new Notification</span><span class="text-bold-400 cursor-pointer">Mark all as read</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../assets/img/nouser.png" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Congratulate Socrates Itumay</span> for work anniversaries</h6><small class="notification-text">Mar 15 12:32pm</small>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="d-flex justify-content-between read-notification cursor-pointer">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../app-assets/images/portrait/small/avatar-s-16.jpg" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New Message</span> received</h6><small class="notification-text">You have 18 unread messages</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center py-0">
                                            <div class="media-left pr-0"><img class="mr-1" src="../app-assets/images/icon/sketch-mac-icon.png" alt="avatar" height="39" width="39"></div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Updates Available</span></h6><small class="notification-text">Sketch 50.2 is currently newly added</small>
                                            </div>
                                            <div class="media-right pl-0">
                                                <div class="row border-left text-center">
                                                    <div class="col-12 px-50 py-75 border-bottom">
                                                        <h6 class="media-heading text-bold-500 mb-0">Update</h6>
                                                    </div>
                                                    <div class="col-12 px-50 py-75">
                                                        <h6 class="media-heading mb-0">Close</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar bg-primary bg-lighten-5 mr-1 m-0 p-25"><span class="avatar-content text-primary font-medium-2">LD</span></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New customer</span> is registered</h6><small class="notification-text">1 hrs ago</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cursor-pointer">
                                        <div class="media d-flex align-items-center justify-content-between">
                                            <div class="media-left pr-0">
                                                <div class="media-body">
                                                    <h6 class="media-heading">New Offers</h6>
                                                </div>
                                            </div>
                                            <div class="media-right">
                                                <div class="custom-control custom-switch">
                                                    <input class="custom-control-input" type="checkbox" checked id="notificationSwtich">
                                                    <label class="custom-control-label" for="notificationSwtich"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar bg-danger bg-lighten-5 mr-1 m-0 p-25"><span class="avatar-content"><i class="bx bxs-heart text-danger"></i></span></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Application</span> has been approved</h6><small class="notification-text">6 hrs ago</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between read-notification cursor-pointer">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../app-assets/images/portrait/small/avatar-s-4.jpg" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New file</span> has been uploaded</h6><small class="notification-text">4 hrs ago</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center">
                                            <div class="media-left pr-0">
                                                <div class="avatar bg-rgba-danger m-0 mr-1 p-25">
                                                    <div class="avatar-content"><i class="bx bx-detail text-danger"></i></div>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Finance report</span> has been generated</h6><small class="notification-text">25 hrs ago</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../app-assets/images/portrait/small/avatar-s-16.jpg" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">New customer</span> comment recieved</h6><small class="notification-text">2 days ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Read all notifications</a></li>
                            </ul>
                        </li> -->
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name" id="namaku">Memuat...</span><span class="user-status text-muted">Online</span></div><span><img class="round" src="../assets/img/nouser.png" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php if(session('sebagai') !== "admin"){ ?>
                                <a class="dropdown-item" href="page-user-profile.html"><i class="bx bx-user mr-50"></i> Edit Profile</a>
                                <?php } ?>
                                <a class="dropdown-item" href="#keluar" onclick="logout()"><i class="bx bx-power-off mr-50"></i> Keluar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?=base_url();?>">
                        <span class="mb-0 kuning tebal">N</span>&nbsp;
                        <span class="mb-0 hitam tebal">O</span>&nbsp;
                        <span class="mb-0 hitam tebal">S</span>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 warning"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block warning" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class=" navigation-header"><span>Menu</span></li>
                <li class=" nav-item"><a href="<?=base_url('beranda');?>"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Email">Beranda</span></a>
                </li>
                <?php if(session('sebagai') !== "admin"){ ?>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="box-add"></i><span class="menu-title" data-i18n="Invoice">Barang Datang</span></a>
                    <ul class="menu-content">
                        <li><a href="/barangdatang/agen"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Dari Agen</span></a>
                        </li>
                        <li><a href="/barangdatang/cabang"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">Dari Luar Kota</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="<?=base_url('agen');?>"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="Email">Daftar Agen</span></a>
                </li>
                <?php }else{ ?>
                <li class=" nav-item"><a href="<?=base_url('cabang');?>"><i class="menu-livicon" data-icon="diagram"></i><span class="menu-title" data-i18n="Email">Cabang</span></a>
                </li>
                <li class=" nav-item"><a href="<?=base_url('agen');?>"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="Email">Daftar Agen</span></a>
                </li>
                <li class=" nav-item"><a href="<?=base_url('chat');?>"><i class="menu-livicon" data-icon="comment"></i><span class="menu-title" data-i18n="Email">Bantuan</span></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
	            <?=$this->renderSection('judulhalaman');?>
            <div class="content-body">
            	<section id="widgets-Statistics">
	                <?=$this->renderSection('konten');?>
	            </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-left d-inline-block"><?=date('Y');?> &copy; Nusantara Online Services</span>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/scripts/configs/vertical-menu-light.js"></script>
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <script src="../app-assets/js/scripts/components.js"></script>
    <script src="../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/datatables/datatable.js"></script>
    <script src="../app-assets/js/scripts/extensions/toastr.js"></script>
    <script src="../app-assets/js/scripts/pages/app-chat.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
