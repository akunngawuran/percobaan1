<?php echo $this->extend('template/utama');	echo $this->section('konten');
?>

<div style="'text-align: center;">
<span>Selamat <strong>datang</strong> dan selamat <strong>bekerja..!!!</strong></span>
</div>
<script type="text/javascript">
	var idku = "<?=session('idku');?>";
    var kotaku = "<?=session('kotaku');?>";
    var namaku = "<?=session('namaku');?>";
    var sebagai = "<?=session('sebagai');?>";
	$('#namaku').text(namaku)
</script>
<?php echo $this->endSection(); ?>