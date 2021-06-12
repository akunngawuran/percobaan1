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
                        <div class="kanan">
                            <button type="button" class="btn btn-sm btn-danger glow" onclick="agenmenunggu()">Menunggu</button>
                            <button type="button" class="btn btn-sm btn-success glow" onclick="agenaktif()">Aktif</button>
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
                                        <th class="tengah">Aksi</th>
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
                                        <th>Kota</th>
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

<style>
  #mapss {
        margin-top:5px;
        width:100%;
        height: 400px;
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
            <div class="row">
                <div class="col-sm-9">
                    <div id="mapss" class="glow"></div>
                </div>
                <div class="col-sm-3">
                    <span><strong>ID : </strong> <span id="idgudangx">Memuat...</span></span><br>
                    <span><strong>Penanggung Jawab :<br></strong> <span id="pj">Memuat...</span></span><br>
                    <span><strong>Telepon :<br></strong> <span id="tlpx">Memuat...</span></span>
                    <hr style="padding: 10px;margin: 10px;">
                    <span><strong>Nama Gudang :<br></strong> <span id="nmgudangx">Memuat...</span></span><br>
                    <span><strong>Alamat :<br></strong> <span id="alamatx">Memuat...</span></span><br>
                    <span><strong>Lat / Lon :<br></strong> <span id="latlonx">Memuat...</span></span><br><hr style="padding: 10px;margin: 10px;">
                    <span><strong>Status:<br></strong> <span id="statusgudang">Memuat...</span></span><br><hr style="padding: 10px;margin: 10px;">
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

    agenmenunggu()

    function agenmenunggu(){
        $('.card-title').text('Daftar Agen - Menunggu')

        $('#tablenya1').show()
        $('#tablenya2').hide()

        dr.child("agentemp").on('value', function(agentemp){
            $('#listmenunuggu').empty()
            if(agentemp.numChildren() > 0){
                var no = 1;
                var path = 'gudangtemp';
                agentemp.forEach(function(at){
                    var baris = $('<tr></tr>')
                    baris.append('<td>'+no+'</td>')
                    baris.append('<td>'+at.val().nama+'</td>')
                    baris.append('<td>'+at.val().email+'</td>')
                    baris.append('<td>'+at.val().telepon+'</td>')
                    baris.append('<td class="tengah"><a href="#" data-toggle="modal" data-target="#modaldetail" onclick="detail(\''+at.key+'\', \''+path+'\', \''+at.val().nama+'\', \''+at.val().telepon+'\', \''+at.val().kota+'\')"><i class="badge-circle badge-circle-light-warning bx bx-info-circle font-medium-1"></i></a></td>')
                    baris.append('<td class="tengah"><div class="dropdown"><span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span><div class="dropdown-menu dropdown-menu-right">                                                    <a class="dropdown-item" href="#" onclick="tolak(\''+at.key+'\',\''+at.val().kota+'\')"><i class="bx bx-trash mr-1"></i> tolak</a><a class="dropdown-item" href="#" onclick="terima(\''+at.key+'\',\''+at.val().kota+'\')"><i class="bx bx-edit-alt mr-1"></i> terima</a></div></div></td>')
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

    function detail(id, path, pj, tlpx, kot){
        dr.child(path).child(kot).child(id).once('value', function(anu){
            $('#modaldetailTitle').text('Info Detail - ('+anu.val().nama+')')
            $('#pj').text(pj)
            $('#tlpx').text(tlpx)
            $('#idgudangx').text(id)
            $('#nmgudangx').text(anu.val().nama)
            $('#alamatx').text(anu.val().alamat)
            $('#latlonx').text(anu.val().lat+' / '+anu.val().lon)
            if(anu.val().status == "Online"){
                $('#statusgudang').addClass("text-success");
            }else{
                $('#statusgudang').addClass("text-danger");
            }
            $('#statusgudang').text(anu.val().status)
            initAutocomplete(anu.val().lat, anu.val().lon, anu.val().nama)
        })
    }

    function tolak(idnya, kotanya){
    	if(confirm('Anda yakin akan menolak calon agen ini?')){
    		var hapus = {}
    		hapus['/agentemp/'+idnya] = null;
    		hapus['/gudangtemp/'+kotanya+'/'+idnya] = null;
    		dr.update(hapus, (err) => {
                if (err) {
                    alert('Terjadi kesalahan sistem. Hubungi Programmer..!!!')
                } else {
                    notifsukses("Hapus Calon Agen", "Berhasil.")
                }
            });
    	}
    }
    function terima(idnya, kotanya){
    	dr.child("agentemp").child(idnya).once('value', function(agentemp){
    		dr.child("gudangtemp").child(kotanya).child(idnya).once('value', function(gudangtemp){
	    		var data1 = agentemp.val()
	    		var data2 = gudangtemp.val()

	    		if(confirm('Anda yakin akan menambah agen baru?')){
		            var simpan = {}

		            simpan['/agen/'+idnya+'/email'] = data1.email;
		            simpan['/agen/'+idnya+'/foto'] = 'kosong';
		            simpan['/agen/'+idnya+'/idgudang'] = data1.idgudang;
		            simpan['/agen/'+idnya+'/idnya'] = idnya;
		            simpan['/agen/'+idnya+'/kota'] = kotanya;
		            simpan['/agen/'+idnya+'/nama'] = data1.nama;
		            simpan['/agen/'+idnya+'/posisigudang'] = 'agen';
		            simpan['/agen/'+idnya+'/telepon'] = data1.telepon;

		            simpan['/gudang/'+kotanya+'/'+idnya+'/alamat'] = data2.alamat;
		            simpan['/gudang/'+kotanya+'/'+idnya+'/idagen'] = idnya;
		            simpan['/gudang/'+kotanya+'/'+idnya+'/idnya'] = idnya;
		            simpan['/gudang/'+kotanya+'/'+idnya+'/lat'] = data2.lat;
		            simpan['/gudang/'+kotanya+'/'+idnya+'/lon'] = data2.lon;
		            simpan['/gudang/'+kotanya+'/'+idnya+'/nama'] = data2.nama;
                    simpan['/gudang/'+kotanya+'/'+idnya+'/status'] = 'y';

		            simpan['/agentemp/'+idnya] = null;
		            simpan['/gudangtemp/'+kotanya+'/'+idnya] = null;
		            dr.update(simpan, (err) => {
		                if (err) {
		                    alert('Terjadi kesalahan sistem. Hubungi Programmer..!!!')
		                } else {
		                    notifsukses("Selamat..!!!", "Data agen baru berhasil ditambahkan.")
		                }
		            });
		        }
	    	})
    	})
    }

    function agenaktif(){
        $('.card-title').text('Daftar Agen - Aktif')

        $('#tablenya1').hide()
        $('#tablenya2').show()

        dr.child("agen").on('value', function(agentemp){
            dr.child("kota").once('value', function(xkota){

                $('#listaktif').empty()
                if(agentemp.numChildren() > 0){
                    var no = 1;
                    var path = 'gudang';
                    agentemp.forEach(function(at){
                        var samakota = false;
                        var namakota = "";
                        xkota.forEach(function(xk){
                            if(xk.key == at.val().kota){
                                samakota = true;
                                namakota = xk.val().nama
                            }
                        })
                        if(samakota){
                            var baris = $('<tr></tr>')
                            baris.append('<td>'+no+'</td>')
                            baris.append('<td>'+at.val().nama+'</td>')
                            baris.append('<td>'+at.val().email+'</td>')
                            baris.append('<td>'+at.val().telepon+'</td>')
                            baris.append('<td>'+namakota+'</td>')
                            baris.append('<td class="tengah"><a href="#" data-toggle="modal" data-target="#modaldetail" onclick="detail(\''+at.key+'\', \''+path+'\', \''+at.val().nama+'\', \''+at.val().telepon+'\', \''+at.val().kota+'\')"><i class="badge-circle badge-circle-light-warning bx bx-info-circle font-medium-1"></i></a></td>')
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

    function initAutocomplete(l1, l2, nm) {
    	console.log(l1, l2, nm)
        var map = new google.maps.Map(document.getElementById('mapss'), {
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSSEb95pafBQppXsRgsow5Mr998l_AGVI&libraries=geometry,places" async defer></script>
<?php echo $this->endSection(); ?>