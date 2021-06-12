<?php echo $this->extend('template/utama');	echo $this->section('konten');
?>

<style type="text/css">
    tr {
    cursor: pointer;
}
</style>

<div class="row">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-header border-bottom p-2">
        <strong>Daftar Chat Bantuan</strong> | Obrolan : <strong><span id="jmlobrolan">(0)</span></strong>
      </div>
      <div class="card-body" style="height: 570px;overflow-y: scroll;">
        <table class="table table-hover">
          <tbody id="listchat"></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
      <div class="widget-chat widget-chat-messages">
        <div class="card">
            <div class="card-header border-bottom p-0">
                <div class="media m-75">
                    <a class="media-left" href="JavaScript:void(0);">
                        <div class="avatar mr-75">
                            <img id="ftuser" alt="avtar images" width="32" height="32" src="../assets/img/nouser.png">
                            <span class="avatar-status-online"></span>
                        </div>
                    </a>
                    <div class="media-body">
                        <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);" id="nmuser">. . .</a>
                        </h6>
                        <span class="text-muted font-small-3"></span>
                    </div>
                </div>
            </div>
            <div class="card-body" style="height:500px;overflow-y:scroll;">
                <div class="chat-content" id="kontenchat"></div>
            </div>
            <input type="hidden" id="idusernya">
            <input type="hidden" id="ftusernya">
            <input type="hidden" id="namausernya">
            <div class="card-footer border-top p-1">
                <form class="d-flex align-items-center" action="javascript:void(0);">
                    <input type="text" readonly class="form-control widget-chat-message mx-75" id="ketikan" placeholder="Ketik sesuatu...">
                    <button type="submit" readonly id="tombol" class="btn btn-primary glow" onclick="kirim()"><i class="bx bx-paper-plane"></i></button>
                </form>
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

    dr.child("urutanchat").limitToLast(50).on('value', function(urutanchat){
        var tampung = []
        urutanchat.forEach(function(cha){
            tampung.push(cha)
        })

        $('#jmlobrolan').text('('+tampung.length+')')

        $('#listchat').empty()
        tampung.reverse().forEach(function(hasil){
            var baris = $('<tr onclick="detailchat(\''+hasil.val().iduser+'\', \''+hasil.val().foto+'\', \''+hasil.val().nama+'\')"></tr>')
            baris.append('<td style="width:5%;"><div class="avatar"><img src="'+hasil.val().foto+'" width="40" height="40" class="avtar images" /></div></td>')
            var teks = ""
            var isinya = hasil.val().isi
            if(isinya.length >= 50){
                teks = isinya.substr(0, 47)+'...'
            }else{
                teks = isinya
            }
            baris.append('<td><strong>'+hasil.val().nama+'</strong><br><span>'+teks+'</span></td>')
            baris.append('<td style="font-size:12px;text-align:right;"><span>'+hasil.val().jam+'</span></td>')
            $('#listchat').append(baris)
        })
    })

    function detailchat(iduser, foto, nama){
        $('#ketikan').focus()
        $('#ketikan').prop('readonly', false)
        $('#tombol').prop('readonly', false)
        $('#idusernya').val(iduser)
        $('#ftusernya').val(foto)
        $('#namausernya').val(nama)
        dr.child("chat").child(iduser).on('value', function(chatting){
            $('#kontenchat').empty()
            $('#ftuser').attr('src', foto);
            $('#nmuser').text(nama)
            chatting.forEach(function(data){
                var chat = data.val()
                var posisi = ""
                if(chat.posisi == "kiri"){
                    posisi = '<div class="chat chat-left"></div>'
                }else{
                    posisi = '<div class="chat"></div>'
                }
                var baris = $(posisi)
                var bodi = $('<div class="chat-body"></div>')
                var pesan = $('<div class="chat-message"></div>')
                pesan.append('<p>'+chat.chat+'</p><span class="chat-time">'+chat.jam+'</span>')
                bodi.append(pesan)
                baris.append(bodi)
                $('#kontenchat').append(baris)
            })
        })
    }

    function kirim(){
        var ketikan = $('#ketikan').val()
        if(ketikan !== ""){
            var map = {}
            var uid = $('#idusernya').val()
            var idpush = dr.push().key

            dr.child('urutanchat').orderByChild("iduser").equalTo(uid).once('value', function(urutchat){
                if(urutchat.numChildren() > 0){
                    urutchat.forEach(function(uc){
                        map['/urutanchat/'+uc.key] = null;
                    })
                }
                map['/chat/'+uid+'/'+idpush+'/chat'] = ketikan;
                map['/chat/'+uid+'/'+idpush+'/id'] = idku;
                map['/chat/'+uid+'/'+idpush+'/jam'] = jamSekarang();
                map['/chat/'+uid+'/'+idpush+'/nama'] = 'Admin Nos';
                map['/chat/'+uid+'/'+idpush+'/posisi'] = 'kanan';

                map['/urutanchat/'+idpush+'/foto'] = $('#ftusernya').val();
                map['/urutanchat/'+idpush+'/iduser'] = uid;
                map['/urutanchat/'+idpush+'/isi'] = ketikan;
                map['/urutanchat/'+idpush+'/jam'] = jamSekarang();
                map['/urutanchat/'+idpush+'/nama'] = $('#namausernya').val();
                dr.update(map, (err) => {
                    if (err) {
                        alert('Terjadi kesalahan sistem. Hubungi Programmer..!!!')
                    } else {
                        // notifsukses("judul..!!!", "isinya.")
                        $('#ketikan').val('')
                    }
                });
            })
        }
    }
</script>
<?php echo $this->endSection(); ?>
