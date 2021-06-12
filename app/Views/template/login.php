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
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/swiper.min.css">
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
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-ecommerce.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->
    <script src="https://www.gstatic.com/firebasejs/5.1.0/firebase.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
            keluar()
            location.href='login'
        }

        function keluar(){
            firebase.auth().signOut().then(function() {
                // $.get("hapussesi.php");
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
    </script>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

<?=$this->renderSection('formlogin');?>

</body>
</html>