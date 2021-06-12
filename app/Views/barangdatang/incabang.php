<?php echo $this->extend('template/utama');	

echo $this->section('konten');
?>
<!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Barang Dari Luar Kota</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="kanan"><button id="kirimsekarang" disabled data-toggle="modal" data-target="#modalkirim" class="btn btn-sm glow btn-warning" onclick="ngelist('keagen', 'awal')">Kirim</button></div>
                                        <div class="table-responsive">
                                            <table id="tablenya" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No. Resi</th>
                                                        <th>Tgl. Pesan</th>
                                                        <th>Tujuan</th>
                                                        <th>Jenis Paket<a href="#" class="btn-icon ml-1" data-toggle="modal" data-target="#modaljenis"><i class="bx bx-filter"></i></a></th>
                                                        <th class="tengah">
                                                            <fieldset><div class="checkbox checkbox-warning checkbox-shadow checkbox-glow"><input type="checkbox" id="contreng"><label for="contreng">Check</label></div>
                                                        </th>
                                                        <th class="tengah">Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="listbarangdatang"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

<!-- modal tujuan -->
<div class="modal fade" id="modaltujuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltujuanTitle">Filter - Kota TUjuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" id="filtertujuan"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning shadow btn-glow ml-1" data-dismiss="modal" onclick="terapkanfiltertujuan()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Terapkan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal jenis -->
<div class="modal fade" id="modaljenis" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaljenisTitle">Filter - Jenis Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <select class="form-control" id="filterjenis">
                    <option value="semua">Tampilkan Semua</option>
                    <option value="REGULER">REGULER</option>
                    <option value="8JAM">8JAM</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning shadow btn-glow ml-1" data-dismiss="modal" onclick="terapkanfilterjenis()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Terapkan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal kirim -->
<div class="modal fade" id="modalkirim" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltujuanTitle">Input - Info Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- // kirim sekarang -->
                <select id="pilihkemana" class="form-control" onchange="ngelist(this.value, 'pilih')">
                	<option value="keagen">Kirim ke Agen</option>
                	<option value="kekurir">Kirim ke Kurir</option>
                </select>
                <table class="table">
                	<thead>
                		<tr>
                			<th>No</th>
	                		<th>Nama</th>
	                		<th class="tengah">Pilih</th>
                		</tr>
                	</thead>
                	<tbody id="listkemana"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button id="kirimloh" type="button" class="btn btn-warning shadow btn-glow ml-1" data-dismiss="modal" disabled onclick="kirim()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">kirim Sekarang</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- modal detail -->
<div class="modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaldetailTitle">Detail Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <section class="invoice-view-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <div class="card invoice-print-area">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                        <div class="row">
                                            <div class="col-xl-4 col-md-12" style="padding-top: 0px;">
                                                <span class="invoice-number mr-50">Pengiriman#</span>
                                                <span id="kodepaket">Memuat...</span>
                                            </div>
                                            <div class="col-xl-8 col-md-12">
                                                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div>
                                                        <small class="text-muted">Tanggal Pesan:</small>
                                                        <span id="tglpesan">Memuat...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- logo and title -->
                                        <div class="row my-1">
                                            <div class="col-6">
                                                <h4 class="text-warning">No. Resi</h4>
                                                <span id="koderesi" class="hitam tebal">Memuat...</span>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <img src="../../../assets/img/pegangbox.png" alt="logo" width="164">
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col-4 mt-1">
                                                <h6 class="invoice-from">Info Pemesan</h6>
                                                <div class="mb-1">
                                                    <span id="nmpemesan">Memuat...</span>
                                                </div>
                                                <div class="mb-1">
                                                    <span id="idpemesan">ID: Memuat...</span>
                                                </div>
                                                <div class="mb-1">
                                                    <span id="emailpemesan">Memuat...</span>
                                                </div>
                                                <div class="mb-1">
                                                    <span id="telppemesan">Memuat...</span>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-1">
                                                <h6 class="invoice-from">Kategori Barang</h6>
                                                <ul id="kategori" style="margin-left: 0px;padding-left: 17px;"></ul>
                                            </div>
                                            <div class="col-4 mt-1">
                                                <h6 class="invoice-to">Info Penerima</h6>
                                                <div class="mb-1">
                                                    <span id="nmpenerima">Memuat...</span>
                                                </div>
                                                <div class="mb-1">
                                                    <span id="telppenerima">Memuat...</span>
                                                </div>
                                                <div class="mb-1">
                                                    <span>Alamat:</span><br><span id="kotapenerima">Memuat...</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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

    var a = "semua";
    var b = "semua";

    var jmlcontreng = 0;
    var totalcontreng = 0;
    var tampungresi = [];

    var agenpilihan = "";
    var kurirpilihan = "";
    var kesiapa ="";

    var arrkurir = [];

    function ngelist(kode, kapan){
    	$('#listkemana').empty()
    	$('#kirimloh').prop('disabled', true)

    	agenpilihan = "";
    	nmagenpilihan = "";
    	kurirpilihan = "";
    	nmkurirpilihan = "";
    	kesiapa = "";

    	if(kapan !== "awal"){
	    	if(kode === "kekurir"){
	    		dr.child("gudangcabang").child(idku).once('value', function(gc){
                    daftarkurir(gc.val().lat, gc.val().lon)
                })
	    	}else if(kode === "keagen"){
	    		daftaragen()
	    	}
    	}else{
    		$('#pilihkemana').val('keagen')
    		console.log('kesinikah')
    		daftaragen()
    	}
    }

    function daftarkurir(latku, lonku){
    	arrkurir = [];
    	dr.child("kurir").once('value', function(kurir){
    		dr.child("kurirLatLon").orderByChild("kota").equalTo(kotaku).once('value', function(kurirLatLon){
	    		if(kurirLatLon.numChildren() > 0){
	    			kurirLatLon.forEach(function(kll){
	    				var temp = new Array()
	    				kurir.forEach(function(k){
	    					if(kll.key === k.val().id_kurir){
	    						temp['idkurir'] = k.val().id_kurir;
	    						temp['namakurir'] = k.val().nama_kurir;
	    						temp['saldo'] = k.val().saldo;
	    						temp['latkurir'] = kll.val().lat;
	    						temp['lonkurir'] = kll.val().lon;
	    						arrkurir.push(temp);
	    					}
	    				})
	    			})

	    			var no = 1;
	    			arrkurir.forEach(x => {
	    				$.ajax({
							url: '<?php echo base_url('kurirterdekat/cek') ?>',
							type: "POST",
							data: {
								latku: latku,
								lonku: lonku,
								latkurir: x['latkurir'],
								lonkurir: x['lonkurir']
							},
							success: function(respon) {
								if(Number(respon) < 3){
									var baris = $('<tr></tr>')
					    			baris.append('<td>'+no+'</td>')
					    			baris.append('<td>'+x['namakurir']+'</td>')
					    			baris.append('<td class="tengah"><input type="radio" id="'+x['idkurir']+'" name="rbagen" onclick="aktifkankirimkurir(\''+x['idkurir']+'\', \''+x['namakurir']+'\')"></td>')
					    			$('#listkemana').append(baris);
					    			no++;
								}else{
									console.log('tidak masuk')
								}
							},
							error: function() {
								alert("error");
							}
						})
	    			})
	    		}else{
	    			// tidak ada kurir yg online
	    		}
	    	})
    	})
    }

    function daftaragen(){
    	dr.child("agen").orderByChild("kota").equalTo(kotaku).once('value', function(agen){
    		var no = 1;
    		agen.forEach(function(ag){
    			var baris = $('<tr></tr>')
    			baris.append('<td>'+no+'</td>')
    			baris.append('<td>'+ag.val().nama+'</td>')
    			baris.append('<td class="tengah"><input type="radio" id="'+ag.key+'" name="rbagen" onclick="aktifkankirimagen(\''+ag.key+'\', \''+ag.val().nama+'\')"></td>')
    			$('#listkemana').append(baris);
    			no++;
    		})
    	})
    }

    function aktifkankirimagen(idagen, namaagen){
    	kesiapa = "agen";
    	agenpilihan = idagen;
    	nmagenpilihan = namaagen;
    	$('#kirimloh').prop('disabled', false)
    }

    function aktifkankirimkurir(idkurir, namakurir){
    	kesiapa = "kurir";
    	kurirpilihan = idkurir;
    	nmkurirpilihan = namakurir;
    	$('#kirimloh').prop('disabled', false)
    }

    barangdatang(a, b);

    function kirim(){
        var kode = kodekirimcabang()+''+kotaku.toUpperCase()
        var pengemudi = $('#pengemudi').val()
        var plat = $('#plat').val()

        if(kesiapa === "agen"){
        	var map = {}

        	for(var i = 0;i < tampungresi.length;i++){
	            var noresi = tampungresi[i]['noresi'];
	            var kodetujuan = tampungresi[i]['tujuan']; // kota
	            var sebelumnya = tampungresi[i]['sebelumnya']; // cabang sebelumnya

	            var setelahnya = agenpilihan; // id agen
	            var nmgc = nmagenpilihan; // nama agen

	            var nmku = tampungresi[i]['nmku'];

	            // datapengiriman
	            map['/datapengirimandalamkota/'+kode+'/idpengantar'] = setelahnya;
	            map['/datapengirimandalamkota/'+kode+'/status'] = kotaku+'_proses';
	            map['/datapengirimandalamkota/'+kode+'/pengantar'] = nmgc;
	            map['/datapengirimandalamkota/'+kode+'/jenis'] = "Agen";
	            map['/datapengirimandalamkota/'+kode+'/tglkirim'] = tglSekarang();
	            map['/datapengirimandalamkota/'+kode+'/jamkirim'] = jamSekarang();
	            map['/datapengirimandalamkota/'+kode+'/z_data/'+(i)+'/noresi'] = noresi;
	            map['/datapengirimandalamkota/'+kode+'/z_data/'+(i)+'/tujuan'] = kodetujuan;

	            // transaksi
                map['/transaksi/'+noresi+'/cabang'] = sebelumnya+'_selesai';
                map['/transaksi/'+noresi+'/cabang2'] = idku+'_proses';
                map['/transaksi/'+noresi+'/agen2'] = setelahnya+'_menunggu';
                map['/transaksi/'+noresi+'/status'] = 'KirimKeAgen2';

                // tracking
                map['/tracking/'+noresi+'/'+dr.push().key] = '['+sebelumnya+']Paket Diterima oleh '+nmku+'|'+tglSekarang()+'|'+jamSekarang();
                map['/tracking/'+noresi+'/'+dr.push().key] = '['+idku+']Paket Dikirim ke Agen '+nmgc+'|'+tglSekarang()+'|'+jamSekarang();
	        }
            
	        dr.update(map, (error) => {
                if (error) {
                    alert('Terjadi kesalahan. Hubungi Programmer')
                } else {
                    dr.child("token_agen").child(agenpilihan).once('value',function(token_agen){
                        $.ajax({
                            url: '<?php echo base_url('notifikasi/cabangkeagen') ?>',
                            type: "POST",
                            data: {
                                tokennya: token_agen.val(),
                                judul: namaku,
                                pesan: "Ada paket yang harus diambil."
                            },
                            success: function(respon) {
                                if(respon == "ok"){}
                            },
                            error: function() {
                                alert("error");
                            }
                        })
                    })
                    alert('Data Berhasil di infokan ke agen')
                    location.reload()
                }
            });
        }else if(kesiapa === "kurir"){
        	var map = {}

        	for(var i = 0;i < tampungresi.length;i++){
	            var noresi = tampungresi[i]['noresi'];
	            var kodetujuan = tampungresi[i]['tujuan']; // kota
	            var sebelumnya = tampungresi[i]['sebelumnya']; // cabang sebelumnya

	            var setelahnya = kurirpilihan; // id agen
	            var nmgc = nmkurirpilihan; // nama agen

	            var nmku = tampungresi[i]['nmku'];

	            // datapengiriman
	            map['/datapengirimandalamkota/'+kode+'/idpengantar'] = setelahnya;
	            map['/datapengirimandalamkota/'+kode+'/pengantar'] = nmgc;
	            map['/datapengirimandalamkota/'+kode+'/jenis'] = "Kurir";
	            map['/datapengirimandalamkota/'+kode+'/tglkirim'] = tglSekarang();
	            map['/datapengirimandalamkota/'+kode+'/jamkirim'] = jamSekarang();
	            map['/datapengirimandalamkota/'+kode+'/z_data/'+(i)+'/noresi'] = noresi;
	            map['/datapengirimandalamkota/'+kode+'/z_data/'+(i)+'/tujuan'] = kodetujuan;

	            // transaksi
                map['/transaksi/'+noresi+'/cabang'] = sebelumnya+'_selesai';
                map['/transaksi/'+noresi+'/cabang2'] = idku+'_proses';
                map['/transaksi/'+noresi+'/idkurir2'] = setelahnya+'_proses';
                map['/transaksi/'+noresi+'/status'] = 'KirimKeKurir2';

                // tracking
                map['/tracking/'+noresi+'/'+dr.push().key] = '['+sebelumnya+']Paket Diterima oleh '+nmku+'|'+tglSekarang()+'|'+jamSekarang();
                map['/tracking/'+noresi+'/'+dr.push().key] = '['+idku+']Paket Diantar ke tujuan oleh '+nmgc+' (kurir)|'+tglSekarang()+'|'+jamSekarang();
	        }
	        dr.update(map, (error) => {
                if (error) {
                    alert('Terjadi kesalahan. Hubungi Programmer')
                } else {
                    dr.child("token_kurir").child(kurirpilihan).once('value',function(token_kurir){
                        $.ajax({
                            url: '<?php echo base_url('notifikasi/cabangkekurir') ?>',
                            type: "POST",
                            data: {
                                tokennya: token_kurir.val(),
                                judul: namaku,
                                pesan: "Silahkan datang untuk mengambil paket."
                            },
                            success: function(respon) {
                                if(respon == "ok"){}
                            },
                            error: function() {
                                alert("error");
                            }
                        })
                    })
                    alert('Data Berhasil di infokan ke kurir')
                    location.reload()
                }
            });
        }else{
        	alert("Gagal menyimpan data. Pastikan Anda sudah mengisi form pengiriman dengan benar..!!!")
        }
    }

    function terapkanfiltertujuan(){
        var filtertujuan = $('#filtertujuan').val()
        barangdatang(filtertujuan, b)
    }

    function terapkanfilterjenis(){
        var filterjenis = $('#filterjenis').val()
        barangdatang(a, filterjenis)
    }

    function barangdatang(tampungtujuan, tampungjenis){
        a = tampungtujuan;
        b = tampungjenis;
        
        dr.child("transaksi").orderByChild("cabang2").equalTo(idku+'_menunggu').once('value', function(transaksi){
        	if(transaksi.numChildren() > 0){
        		$('#tablenya').addClass('table-hover');
        		dr.child("gudangcabang").once('value', function(gudangcabang){
	                dr.child("kota").once('value', function(kotanya){

	                    var listbarangdatang = $('#listbarangdatang');
	                    listbarangdatang.empty()

	                    var filtertujuan = $('#filtertujuan');
	                    filtertujuan.empty()
	                    filtertujuan.append('<option value="semua">Tampilkan Semua</option>')

	                    var arrtemp = [];
	                    var index = 0;

	                    transaksi.forEach(function(trans){
	                        var data = trans.val()
	                        var kota = ""
	                        var gc1 = ""
	                        var nmgc1 = ""
	                        var nmku1 = ""

	                        kotanya.forEach(function(kt){
	                            if(kt.key == data.kotatujuan){
	                                kota = kt;
	                            }
	                        })

	                        var baris = $('<tr></tr>');
	                        // tambah filter kota tujuan
	                        if(!arrtemp.includes(data.kotatujuan)) {
	                            arrtemp[index] = data.kotatujuan;
	                            $('#filtertujuan').append('<option value="'+data.kotatujuan+'">'+kota.val().nama+'</option>')
	                            index++;
	                        }

	                        // normalkan contreng
	                        $('#contreng').prop("checked", false);
	                        $('#'+data.noresi).prop("checked", false);

	                        // cek kondisi daftar transaksi
	                        var ceklist = cekList(a, b, data);

	                        // hitung jumlah data contreng
	                        totalcontreng = 0;
	                        transaksi.forEach(function(trans1){
	                            var data1 = trans1.val();
	                            var ceklist1 = cekList(a, b, data1);

	                            if(ceklist1){
	                                totalcontreng++;
	                            }
	                        })
	                        
	                        // ambil daftar transaksi
	                        if(ceklist){
	                            gudangcabang.forEach(function(gudang){
	                                if(data.kotatujuan == gudang.val().kota){
	                                    gc1 = gudang.key
	                                    nmgc1 = gudang.val().nama
	                                }

	                                if(gudang.key == idku){
	                                    nmku1 = gudang.val().nama
	                                }
	                            })
	                            baris.append('<td>'+data.noresi+'</td>')
	                            baris.append('<td>'+data.tgl+'</td>')
	                            baris.append('<td>'+kota.val().nama+'</td>')
	                            baris.append('<td>'+data.jenis+'</td>')
	                            baris.append('<td class="tengah"><fieldset><div class="checkbox checkbox-warning checkbox-shadow checkbox-glow"><input type="checkbox" id="'+data.noresi+'" onclick="cek(\''+data.noresi+'\', \''+a+'\', \''+b+'\', \''+data.kotatujuan+'\', \''+data.cabang+'\', \''+gc1+'\', \''+nmgc1+'\', \''+nmku1+'\')"><label for="'+data.noresi+'"></label></div></td>')
	                            baris.append('<td class="tengah"><a href="#" data-toggle="modal" data-target="#modaldetail" onclick="setDetail(\''+data.noresi+'\', \''+kota.val().nama+'\')"><i class="badge-circle badge-circle-light-warning bx bx-info-circle font-medium-1"></i></a></td>')
	                            // console.log(gc1)
	                        }
	                        $('#listbarangdatang').append(baris)
	                    })
	                    
	                    $('#contreng').on('click', function(){
	                        // cek kondisi daftar transaksi

	                        if($(this).prop("checked")){
	                            tampungresi = []

	                            transaksi.forEach(function(trans){
	                                var data = trans.val()
	                                var gc2 = ""
	                                var nmgc2 = ""
	                                var nmku2 = ""
	                                var ceklist = cekList(a, b, data);

	                                if(ceklist){
	                                    gudangcabang.forEach(function(gudang){
	                                        if(data.kotatujuan == gudang.val().kota){
	                                            gc2 = gudang.key
	                                            nmgc2 = gudang.val().nama
	                                        }

	                                        if(gudang.key == idku){
	                                            nmku2 = gudang.val().nama
	                                        }
	                                    })
	                                    var arr = new Array()
	                                    arr['noresi'] = data.noresi;
	                                    arr['tujuan'] = data.kotatujuan;
	                                    arr['sebelumnya'] = splitSebelumnya(data.cabang, '_proses');
	                                    arr['setelahnya'] = gc2;
	                                    arr['nmgc'] = nmgc2;
	                                    arr['nmku'] = nmku2;
	                                    tampungresi.push(arr);
	                                    $("#"+data.noresi).prop("checked", true);
	                                }
	                            })
	                            jmlcontreng = totalcontreng
	                            $('#kirimsekarang').prop('disabled', false)
	                        }else{
	                            transaksi.forEach(function(trans){
	                                var data = trans.val()
	                                $("#"+data.noresi).prop("checked", false);
	                            })
	                            jmlcontreng = 0;
	                            tampungresi = [];
	                            $('#kirimsekarang').prop('disabled', true)
	                        }
	                    })
	                })
	            })
        	}else{
        		$('#tablenya').removeClass('table-hover');
        		var baris = $('<tr></tr>')
        		baris.append('<td colspan="6" class="tengah"><img src="../../../assets/img/kosong.gif" width="150"><p>Data masih kosong.</p></td>')
        		$('#listbarangdatang').append(baris)
        	}
        })
    }

    function setDetail(id, kota){
        dr.child("transaksi").child(id).once('value', function(trans){
            dr.child("user").child(trans.val().idpemesan).once('value', function(user){
                $('#kodepaket').text('('+trans.val().jenis+')')
                $('#tglpesan').text(trans.val().tgl)
                $('#koderesi').text(trans.val().noresi)
                $('#nmpemesan').text(user.val().nama)
                $('#idpemesan').text("ID: "+user.key)
                $('#emailpemesan').text(user.val().gmail)
                $('#telppemesan').text(user.val().nohp)

                $('#nmpenerima').text(trans.val().namatujuan)
                $('#kotapenerima').text(trans.val().addr2)
                $('#telppenerima').text(trans.val().telptujuan)

                $('#kategori').empty()
                trans.child('z_kat').forEach(function(zkat){
                    $('#kategori').append('<li>'+zkat.val()+'</li>')
                })
            })
        })
    }

    function splitSebelumnya(data, delimiternya){
        var hasil = data.split(delimiternya);
        return hasil[0];
    }

    function cekList(a, b, data){
        var ceklist = false;

        if(a == "semua" && b == "semua"){
            ceklist = true
        }else{
            if(a == data.kotatujuan && b == "semua"){
                ceklist = true
            }else if(a == "semua" && b == data.jenis){
                ceklist = true
            }else if(a == data.kotatujuan && b == data.jenis){
                ceklist = true
            }
        }
        return ceklist;
    }

    function cek(id, a, b, kota, cabang, gc, nmgc, nmku){
        var idx = $('#'+id)
        if(idx.prop("checked")){
            var arr = new Array()
            arr['noresi'] = id;
            arr['tujuan'] = kota;
            arr['sebelumnya'] = splitSebelumnya(cabang, '_proses');
            arr['setelahnya'] = gc;
            arr['nmgc'] = nmgc;
            arr['nmku'] = nmku;
            tampungresi.push(arr);
            jmlcontreng++;
            if(jmlcontreng == totalcontreng){
                $('#contreng').prop("checked", true);
            }
            $('#kirimsekarang').prop('disabled', false)
        }else{
            tampungresi.splice(hapusarr(id), 1);
            $('#contreng').prop("checked", false);
            jmlcontreng--;
            if(jmlcontreng == 0){
                $('#kirimsekarang').prop('disabled', true)
            }
        }
    }

    function hapusarr(resi){
        var hasil = 0;
        for(var i = 0;i < tampungresi.length;i++){
            if(tampungresi[i]['noresi'] == resi){
                hasil = i
            }
        }
        return hasil;
    }
</script>
<?php
echo $this->endSection();

?>