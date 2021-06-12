<?php echo $this->extend('template/utama');	
	
	echo $this->section('konten');

	$filenya = array(
		'card_barang_masuk',
		'card_pengiriman',
		'kodingan'
	);

	echo $this->inc($filenya, 'beranda');

	echo $this->endSection();
?>