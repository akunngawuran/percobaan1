<script type="text/javascript">
	var idku = "<?=session('idku');?>";
	var kotaku = "<?=session('kotaku');?>";
	var namaku = "<?=session('namaku');?>";

	$('#namaku').text(namaku)

	$('#home-tab').on('click', function(){
		$('#lmasuk').hide()
		$('#lkeluar').show()
    	$('#home-tab').addClass('bg-warning');
    	$('#profile-tab').removeClass('bg-warning');
    	keluarkota()
	})
	$('#profile-tab').on('click', function(){
		$('#lmasuk').show()
		$('#lkeluar').hide()
    	$('#profile-tab').addClass('bg-warning');
    	$('#home-tab').removeClass('bg-warning');
    	dalamkota()
	})

	barangdatang_menunggu_dalam()
	barangdatang_menunggu_luar()

	function barangdatang_menunggu_dalam(){
		dr.child("transaksi").orderByChild("cabang").equalTo(idku+'_menunggu').on('value', function(transaksi){
			var reguler = 0;
			var delapan = 0;
			transaksi.forEach(function(trans){
				if(trans.val().jenis == "REGULER"){
					reguler += 1;
				}else{
					delapan += 1;
				}
			})
			$('#a1').text(reguler)
			$('#a2').text(delapan)
		})
	}

	function barangdatang_menunggu_luar(){
		dr.child("transaksi").orderByChild("cabang2").equalTo(idku+'_menunggu').on('value', function(transaksi){
			var reguler = 0;
			var delapan = 0;
			transaksi.forEach(function(trans){
				if(trans.val().jenis == "REGULER"){
					reguler += 1;
				}else{
					delapan += 1;
				}
			})
			$('#b1').text(reguler)
			$('#b2').text(delapan)
		})
	}

	// pengiriman
	keluarkota()
	dalamkota()

	function detailKeranjang(kod, id){
		dr.child(kod).child(id).child("z_data").once('value', function(datakeranjang){
			$('#listkeranjang').empty()
			$('#modalDetailTitle').text(id)
			datakeranjang.forEach(function(dk){
				dr.child("transaksi").child(dk.val().noresi).once('value', function(trans){
					var baris = $('<tr></tr>')
					baris.append('<td>'+trans.val().noresi+'</td>')
					baris.append('<td>'+trans.val().tgl+'</td>')
					baris.append('<td>'+trans.val().jenis+'</td>')
					baris.append('<td>'+trans.val().addr2+'</td>')
					$('#listkeranjang').append(baris)
				})
			})
		})
	}

	function keluarkota(){
		dr.child("datapengiriman").orderByChild("status").equalTo(kotaku+'_proses').once('value', function(datapengiriman){
			$('#daftarkeluarkota').empty()
			var totalkiriman = 0;
			datapengiriman.forEach(function(dp){
				var jmlkirim = dp.child("z_data").numChildren();
				totalkiriman += jmlkirim;
				var baris = $('<tr></tr>')
				baris.append('<td>'+dp.key+'</td>')
				baris.append('<td>'+dp.val().pengemudi+'</td>')
				baris.append('<td class="tengah">'+jmlkirim+'</td>')
				var kod = "datapengiriman";
				baris.append('<td class="tengah"><button class="btn btn-sm btn-warning"data-toggle="modal" data-target="#modalDetail" onclick="detailKeranjang(\''+kod+'\',\''+dp.key+'\')">Detail</button></td>')
				$('#daftarkeluarkota').append(baris)
			})
			$('#kirimluar').text('('+totalkiriman+')')
		})
	}

	function dalamkota(){
		dr.child("datapengirimandalamkota").orderByChild("status").equalTo(kotaku+'_proses').once('value', function(datapengiriman){
			$('#daftardalamkota').empty()
			var totalkiriman = 0;
			datapengiriman.forEach(function(dp){
				var jmlkirim = dp.child("z_data").numChildren();
				totalkiriman += jmlkirim;
				var baris = $('<tr></tr>')
				baris.append('<td>'+dp.key+'</td>')
				baris.append('<td>'+dp.val().pengantar+'</td>')
				baris.append('<td class="tengah">'+jmlkirim+'</td>')
				var kod = "datapengirimandalamkota";
				baris.append('<td class="tengah"><button class="btn btn-sm btn-warning"data-toggle="modal" data-target="#modalDetail" onclick="detailKeranjang(\''+kod+'\',\''+dp.key+'\')">Detail</button></td>')
				$('#daftardalamkota').append(baris)
			})
			$('#kirimdalam').text('('+totalkiriman+')')
		})
	}
</script>
