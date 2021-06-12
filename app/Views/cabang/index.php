<?php echo $this->extend('template/utama');	echo $this->section('konten');
?>

<div class="card" style="height: 500px;">
    <div class="row">
        <!-- Order Summary Starts -->
        <div class="col-md-8 col-12 order-summary border-right pr-md-0" style="height:100%;">
            <div class="card mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Informasi Cabang</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table">
                        	<tbody id="infonya"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sales History Starts -->
        <div class="col-md-4 col-12 pl-md-0" style="height:100%;">
            <div class="card mb-0">
                <div class="card-header pb-50">
                    <h4 class="card-title">Daftar Kota</h4>
                </div>
                <div class="card-content">
                    <div class="card-footer border-top pb-0">
                        <select class="form-control" id="dkota" multiple="multiple" style="height: 400px;" onclick="infocabang(this.value)">
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
	.input-sm{
		margin-bottom: 10px;
	}
</style>

<!-- modal tambah -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahTitle">Memuat...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                	<div class="col-sm-12">
                		<input type="text" class="form-control input-sm" id="kodecabang" placeholder="Kode Cabang" readonly>
                	</div>
                	<div class="col-sm-6">
                		<input type="text" class="form-control input-sm" id="penanggungjawab" placeholder="Penanggung Jawab">
                	</div>
                	<div class="col-sm-6">
                		<input type="email" class="form-control input-sm" id="email" placeholder="Email" readonly>
                	</div>
                	<div class="col-sm-12"><hr style="padding:0px;"></div>
                	<div class="col-sm-12">
                		<input type="text" class="form-control input-sm" id="nmgudang" placeholder="Nama Gudang">
                	</div>
                	<div class="col-sm-6">
                		<input type="number" class="form-control input-sm" id="lat" placeholder="Latitude">
                	</div>
                	<div class="col-sm-6">
                		<input type="number" class="form-control input-sm" id="lon" placeholder="Longitude">
                	</div>
                	<div class="col-sm-12">
                		<textarea class="form-control" rows="5" id="alamatgudang" placeholder="Alamat Gudang"></textarea>
                	</div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="idkotanya">
                <button type="button" class="btn btn-warning btn-sm shadow btn-glow ml-1" data-dismiss="modal" onclick="tambahcabang()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	var idku = "<?=session('idku');?>";
    var kotaku = "<?=session('kotaku');?>";
    var namaku = "<?=session('namaku');?>";
    var sebagai = "<?=session('sebagai');?>";
	$('#namaku').text(namaku)

	dr.child("kota").once('value', function(kota){
		$('#dkota').empty()
		var cekawal = true;
		kota.forEach(function(ko){
			$('#dkota').append('<option value="'+ko.key+'|'+ko.val().nama+'">'+ko.val().nama+'</option>')

			if(cekawal){
				infocabang(ko.key+'|'+ko.val().nama)
				cekawal = false;
			}
		})
	})

	function infocabang(datakota){
		var idkota = datakota.split("|")
		dr.child("gudangcabang").orderByChild("kota").equalTo(idkota[0]).once('value', function(gudangcabang){
			$('#infonya').empty()
			
			if(gudangcabang.numChildren() > 0){
				dr.child("pengelola").orderByChild("kota").equalTo(idkota[0]).once('value', function(pengelola){
                    pengelola.forEach(function(peng){
                        var baris = $('<tr></tr>')
                        baris.append('<td><strong>Penanggung Jawab</strong><br>'+peng.val().nama+'</td>')
                        baris.append('<td><strong>Email</strong><br>'+peng.val().email+'</td>')
                        $('#infonya').append(baris)
                    })
                    gudangcabang.forEach(function(gc){
                        var baris = $('<tr></tr>')
                        baris.append('<td><strong>Nama Gudang</strong><br>'+gc.val().nama+'</td>')
                        baris.append('<td><strong>Kota</strong><br>'+idkota[1]+'</td>')
                        $('#infonya').append(baris)
                        var baris = $('<tr></tr>')
                        baris.append('<td><strong>Latitude</strong><br>'+gc.val().lat+'</td>')
                        baris.append('<td><strong>Longitude</strong><br>'+gc.val().lon+'</td>')
                        $('#infonya').append(baris)
                        var baris = $('<tr></tr>')
                        baris.append('<td colspan="2"><strong>Alamat</strong><br>'+gc.val().alamat+'</td>')
                        $('#infonya').append(baris)
                    })
                })
			}else{
				var baris = $('<tr></tr>')
				baris.append('<td colspan="2" class="tengah"><br><br><br><br>Cabang <strong>'+idkota[1]+'</strong> Belum Tersedia.<br><br><button class="btn btn-sm btn-light-warning" onclick="fomrtambah(\''+idkota[0]+'\',\''+idkota[1]+'\')" data-toggle="modal" data-target="#modaltambah"><i class="bx bx-plus"></i><span class="align-middle ml-25">TAMBAHKAN</span></button></td>')
				$('#infonya').append(baris)
			}
		})
	}

	function fomrtambah(idkota, namakota){
        $('#penanggungjawab').val('')
        $('#nmgudang').val('')
        $('#lat').val('')
        $('#lon').val('')
        $('#alamatgudang').val('')
        $('#idkotanya').val('')

		dr.child("pengelola").once('value', function(pengelola){
			var jml = pengelola.numChildren() + 1;
			var kode = "CB-";
			var kodemail = "cb"
			if(jml < 10){
				kode += "0000"+jml;
				kodemail += "0000"+jml;
			}else if(jml < 100){
				kode += "000"+jml;
				kodemail += "000"+jml;
			}else if(jml < 1000){
				kode += "00"+jml;
				kodemail += "00"+jml;
			}else if(jml < 10000){
				kode += "0"+jml;
				kodemail += "0"+jml;
			}else{
				kode += jml;
				kodemail += jml;
			}

			$('#modaltambahTitle').text('Cabang '+namakota)
			$('#kodecabang').val(kode)
            $('#idkotanya').val(idkota+'|'+namakota)
			$('#email').val(kodemail+'@nos.com')
		})
	}

    function tambahcabang(){
        var penanggungjawab = $('#penanggungjawab').val()
        var nmgudang = $('#nmgudang').val()
        var lat = $('#lat').val()
        var lon = $('#lon').val()
        var alamat = $('#alamatgudang').val()

        var kodecabang = $('#kodecabang').val()
        var email = $('#email').val()

        var idnya = $('#kodecabang').val()

        if(penanggungjawab != "" && nmgudang != "" && lat != "" && lon != "" && alamat != ""){
            if(confirm('Anda yakin akan menyimpang data ini?')){
                firebase.auth().createUserWithEmailAndPassword(email, '123456')
                .then(function (firebaseUser) {
                    var simpan = {}
                    var datakota = $('#idkotanya').val()
                    var dkotax = datakota.split("|")
                    
                    simpan['/pengelola/'+idnya+'/email'] = email;
                    simpan['/pengelola/'+idnya+'/foto'] = 'kosong';
                    simpan['/pengelola/'+idnya+'/idgudang'] = idnya;
                    simpan['/pengelola/'+idnya+'/idnya'] = idnya;
                    simpan['/pengelola/'+idnya+'/kota'] = dkotax[0];
                    simpan['/pengelola/'+idnya+'/nama'] = penanggungjawab;
                    simpan['/pengelola/'+idnya+'/sebagai'] = 'cabang';
                    simpan['/pengelola/'+idnya+'/status'] = 'aktif';
                    
                    simpan['/gudangcabang/'+idnya+'/alamat'] = alamat;
                    simpan['/gudangcabang/'+idnya+'/idnya'] = idnya;
                    simpan['/gudangcabang/'+idnya+'/kota'] = dkotax[0];
                    simpan['/gudangcabang/'+idnya+'/lat'] = lat;
                    simpan['/gudangcabang/'+idnya+'/lon'] = lon;
                    simpan['/gudangcabang/'+idnya+'/nama'] = nmgudang;
                    dr.update(simpan, (err) => {
                        if (err) {
                            alert('Terjadi kesalahan sistem. Hubungi Programmer..!!!')
                        } else {
                            notifsukses("Selamat..!!!", "Data cabang berhasil ditambahkan.")
                            infocabang(datakota)
                        }
                    });
                })
                .catch(function (error) {
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    alert('Email '+email+' sudah terdaftar.')
                    console.log(errorCode+' => '+errorMessage)
                });
            }
        }else{
            alert('Gagal Menyimpan.\nPastikan Anda sudah mengisi form dengan benar..!!!')
        }
    }
</script>
<?php echo $this->endSection(); ?>