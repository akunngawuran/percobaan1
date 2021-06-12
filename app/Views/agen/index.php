<?php echo $this->extend('template/utama');	echo $this->section('konten');
?>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Agen - Menunggu</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div>
                            <button type="button" class="btn btn-sm btn-danger glow" id="btnmenunggu" onclick="agenmenunggu()">Menunggu (...)</button>
                            <button type="button" class="btn btn-sm btn-success glow" id="btnaktif" onclick="agenaktif()">Aktif (...)</button>
                        </div>
                        <div class="kanan">
                            <button id="tambah" data-toggle="modal" data-target="#modaltambah" class="btn btn-sm glow btn-warning" onclick="fomrtambah()">Tambah Agen</button>
                        </div>
                        <div class="table-responsive">
                            <table id="tablenya1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th class="tengah">Detail</th>
                                    </tr>
                                </thead>
                                <tbody id="listmenunuggu"></tbody>
                            </table>
                            <table id="tablenya2" class="table table-hover" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Status</th>
                                        <th class="tengah">Detail</th>
                                    </tr>
                                </thead>
                                <tbody id="listaktif"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
                <h5 class="modal-title" id="modaltambahTitle">Form Tambah Agen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control input-sm" id="kodeagen" placeholder="Kode Agen" readonly>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control input-sm" id="penanggungjawab" placeholder="Penanggung Jawab">
                    </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control input-sm" id="email" placeholder="Email">
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control input-sm" id="telp" placeholder="Telepon">
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
                <button type="button" class="btn btn-warning btn-sm shadow btn-glow ml-1" data-dismiss="modal" onclick="tambahagen()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
  #map {
        margin-top:5px;
        width:100%;
        height: 500px;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  #description {
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
  }

  #infowindow-content .title {
    font-weight: bold;
  }

  #infowindow-content {
    display: none;
  }

  #map #infowindow-content {
    display: inline;
  }

  .pac-card {
    margin: 10px 10px 0 0;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    background-color: #fff;
    font-family: Roboto;
  }

  #pac-container {
    padding-bottom: 12px;
    margin-right: 12px;
  }

  .pac-controls {
    display: inline-block;
    padding: 5px 11px;
  }

  .pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }

  #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 18px;
    font-weight: 300;
    margin-left: 12px;
    margin-top:10px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 400px;
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  #title {
    color: #fff;
    background-color: #4d90fe;
    font-size: 25px;
    font-weight: 500;
    padding: 6px 12px;
  }
  #target {
    width: 345px;
  }
</style>

<!-- modal detail -->
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaldetailTitle">Memuat...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
            <div class="row" style="padding-bottom: 10px;">
                <div class="col-sm-9">
                    <div id="map" class="glow"></div>
                </div>
                <div class="col-sm-3">
                    <span><strong>ID : </strong> <span id="idgudangx">Memuat...</span></span><br>
                    <span><strong>Penanggung Jawab :<br></strong> <span id="pj">Memuat...</span></span><br>
                    <span><strong>Telepon :<br></strong> <span id="tlpx">Memuat...</span></span>
                    <hr style="padding: 10px;margin: 10px;">
                    <span><strong>Nama Gudang :<br></strong> <span id="nmgudangx">Memuat...</span></span><br>
                    <span><strong>Alamat :<br></strong> <span id="alamatx">Memuat...</span></span><br>
                    <span><strong>Lat / Lon :<br></strong> <span id="latlonx">Memuat...</span></span><br><hr style="padding: 10px;margin: 10px;">
                    <span><strong>Status :<br></strong> <button class="btn btn-block" id="tombolstatus" onclick="gantistatus()">Memuat...</button><hr style="padding: 10px;margin: 10px;">
                </div>
            </div>
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

    agenaktif()
    agenmenunggu()

    function gantistatus(){
        var tombolstatus = $('#tombolstatus').text()
        var idgudangx = $('#idgudangx').text()
        if(tombolstatus == "Online"){
            dr.child("gudang").child(kotaku).child(idgudangx).child("status").set('Offline')
        }else{
            dr.child("gudang").child(kotaku).child(idgudangx).child("status").set('Online')
        }
    }

    function agenmenunggu(){
        $('.card-title').text('Daftar Agen - Menunggu')

        $('#tablenya1').show()
        $('#tablenya2').hide()

        dr.child("agentemp").orderByChild("kota").equalTo(kotaku).on('value', function(agentemp){
            $('#listmenunuggu').empty()
            $('#btnmenunggu').text("Menunggu ("+agentemp.numChildren()+")")
            if(agentemp.numChildren() > 0){
                var no = 1;
                var path = 'gudangtemp';
                agentemp.forEach(function(at){
                    var baris = $('<tr></tr>')
                    baris.append('<td>'+no+'</td>')
                    baris.append('<td>'+at.val().nama+'</td>')
                    baris.append('<td>'+at.val().email+'</td>')
                    baris.append('<td>'+at.val().telepon+'</td>')
                    baris.append('<td class="tengah"><a href="#" data-toggle="modal" data-target="#modaldetail"><i class="badge-circle badge-circle-light-warning bx bx-info-circle font-medium-1" onclick="detail(\''+at.key+'\', \''+path+'\', \''+at.val().nama+'\', \''+at.val().telepon+'\')"></i></a></td>')
                    $('#listmenunuggu').append(baris)
                    no++;
                })
            }else{
                var baris = $('<tr></tr>')
                baris.append('<td class="tengah" colspan="5">Daftar <strong>Agen Menunggu</strong> masih kosong.</td>')
                $('#listmenunuggu').append(baris)
            }
        })
    }

    function agenaktif(){
        $('.card-title').text('Daftar Agen - Aktif')

        $('#tablenya1').hide()
        $('#tablenya2').show()

        dr.child("agen").orderByChild("kota").equalTo(kotaku).on('value', function(agentemp){
            dr.child("gudang").child(kotaku).on('value', function(gudang){
                $('#listaktif').empty()
                $('#btnaktif').text("Aktif ("+agentemp.numChildren()+")")
                if(agentemp.numChildren() > 0){
                    var no = 1;
                    var path = 'gudang';
                    agentemp.forEach(function(at){
                        var samaid = false;
                        var statusnya = "";
                        gudang.forEach(function(gd){
                            if(gd.key == at.key){
                                samaid = true;
                                statusnya = gd.val().status
                            }
                        })

                        if(samaid){
                            var baris = $('<tr></tr>')
                            baris.append('<td>'+no+'</td>')
                            baris.append('<td>'+at.val().nama+'</td>')
                            baris.append('<td>'+at.val().email+'</td>')
                            baris.append('<td>'+at.val().telepon+'</td>')
                            baris.append('<td>'+statusnya+'</td>')
                            baris.append('<td class="tengah"><a href="#" data-toggle="modal" data-target="#modaldetail" onclick="detail(\''+at.key+'\', \''+path+'\', \''+at.val().nama+'\', \''+at.val().telepon+'\')"><i class="badge-circle badge-circle-light-warning bx bx-info-circle font-medium-1"></i></a></td>')
                            $('#listaktif').append(baris)
                            no++;
                        }
                    })
                }else{
                    var baris = $('<tr></tr>')
                    baris.append('<td class="tengah" colspan="5">Daftar <strong>Agen Aktif</strong> masih kosong.</td>')
                    $('#listaktif').append(baris)
                }
            })
        })
    }

    function detail(id, path, pj, tlpx){
        dr.child(path).child(kotaku).child(id).on('value', function(anu){
            $('#modaldetailTitle').text('Info Detail - ('+pj+')')
            $('#pj').text(pj)
            $('#tlpx').text(tlpx)
            $('#idgudangx').text(id)
            $('#nmgudangx').text(anu.val().nama)
            $('#alamatx').text(anu.val().alamat)
            if(anu.val().status == "Online"){
                $('#tombolstatus').addClass("btn-outline-success");
            }else{
                $('#tombolstatus').addClass("btn-outline-danger");
            }
            $('#tombolstatus').text(anu.val().status)
            $('#latlonx').text(anu.val().lat+' / '+anu.val().lon)
            initAutocomplete(anu.val().lat, anu.val().lon, anu.val().nama)
        })
    }

    function tambahagen(){
        var kodeagen = $('#kodeagen').val()
        var penanggungjawab = $('#penanggungjawab').val()
        var email = $('#email').val()
        var telp = $('#telp').val()
        var nmgudang = $('#nmgudang').val()
        var lat = $('#lat').val()
        var lon = $('#lon').val()
        var lon = $('#lon').val()
        var alamatgudang = $('#alamatgudang').val()

        if(penanggungjawab != "" && nmgudang != "" && lat != "" && lon != "" && alamatgudang != "" && telp != ""){
            if(confirm('Anda yakin akan menambah agen baru?')){
                var simpan = {}
                var idnya = kodeagen;

                simpan['/agentemp/'+idnya+'/email'] = email;
                simpan['/agentemp/'+idnya+'/foto'] = 'kosong';
                simpan['/agentemp/'+idnya+'/idgudang'] = idnya;
                simpan['/agentemp/'+idnya+'/idnya'] = idnya;
                simpan['/agentemp/'+idnya+'/kota'] = kotaku;
                simpan['/agentemp/'+idnya+'/nama'] = penanggungjawab;
                simpan['/agentemp/'+idnya+'/posisigudang'] = 'agen';
                simpan['/agentemp/'+idnya+'/telepon'] = telp;

                simpan['/gudangtemp/'+kotaku+'/'+idnya+'/alamat'] = alamatgudang;
                simpan['/gudangtemp/'+kotaku+'/'+idnya+'/idagen'] = idnya;
                simpan['/gudangtemp/'+kotaku+'/'+idnya+'/idnya'] = idnya;
                simpan['/gudangtemp/'+kotaku+'/'+idnya+'/lat'] = lat;
                simpan['/gudangtemp/'+kotaku+'/'+idnya+'/lon'] = lon;
                simpan['/gudangtemp/'+kotaku+'/'+idnya+'/nama'] = nmgudang;
                dr.update(simpan, (err) => {
                    if (err) {
                        alert('Terjadi kesalahan sistem. Hubungi Programmer..!!!')
                    } else {
                        notifsukses("Selamat..!!!", "Data agen sedang dalam proses verifikasi.")
                    }
                });
            }
        }else{
            alert('Gagal Menyimpan.\nPastikan Anda sudah mengisi form dengan benar..!!!')
        }
    }

	function fomrtambah(){
        $('#penanggungjawab').val('')
        $('#nmgudang').val('')
        $('#lat').val('')
        $('#lon').val('')
        $('#alamatgudang').val('')
        $('#idkotanya').val('')
        $('#email').val('')
        $('#telp').val('')

		dr.child("agen").once('value', function(pengelola){
			var jml = pengelola.numChildren() + 1;
			var kode = "AG-";
			var kodemail = "ag"
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

			$('#kodeagen').val(kode)
		})
	}

    function initAutocomplete(l1, l2, nm) {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: Number(l1), lng: Number(l2)},
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        const latlng = { lat: Number(l1), lng: Number(l2) };
        const image = "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
        new google.maps.Marker({
            position: latlng,
            map,
            title: nm,
            icon: image,
        });
        
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSSEb95pafBQppXsRgsow5Mr998l_AGVI&libraries=geometry,places"
         async defer></script>
<?php echo $this->endSection(); ?>