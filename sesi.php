<?php
session_start();
if(isset($_GET['idku'])){
	$_SESSION['idku'] = $_GET['idku'];
	$_SESSION['kotaku'] = $_GET['kotaku'];
}