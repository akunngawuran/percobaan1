<?=$this->extend('template/login');?>

<?=$this->section('formlogin');?>
<style type="text/css">
	
</style>
<div style="text-align: center;padding-top: 120px;">
	<img src="../assets/img/lari.png" width="370">
</div>
<div class="container">
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<form action="/login" method="post">
			<?=csrf_field();?>
			<fieldset class="form-label-group form-group position-relative has-icon-left">
			    <input name="mail" type="text" class="form-control" id="iconLabelLeft1" placeholder="Masukkan Email">
			    <div class="form-control-position">
			        <i class="bx bx-user"></i>
			    </div>
			    <label for="iconLabelLeft1">Email</label>
			</fieldset>
			<fieldset class="form-label-group form-group position-relative has-icon-left">
			    <input name="pass" type="password" class="form-control" id="iconLabelLeft2" placeholder="Masukkan Password">
			    <div class="form-control-position">
			        <i class="bx bx-user"></i>
			    </div>
			    <label for="iconLabelLeft2">Password</label>
			</fieldset>
			<button class="btn btn-warning shadow" value="go" name="masuk" style="width: 100%;">Masuk</button>
		</form>
		</div>
	</div>
	<div class="col-sm-4"></div>
</div>
</div>
<script type="text/javascript">
	firebase.auth().onAuthStateChanged(function(user) {
		if (user) {
			var mail = user.email
			dr.child("pengelola").orderByChild("email").equalTo(mail).once('value', function(admx) {
				if (admx.numChildren() == 1) {
					admx.forEach(function(adm) {
						$.ajax({
							url: '<?php echo base_url('login/setsesi') ?>',
							type: "POST",
							data: {
								idku: adm.val().idgudang,
								kotaku: adm.val().kota,
								namaku: adm.val().nama,
								sebagai: adm.val().sebagai
							},
							success: function(respon) {
								if(respon == "ok"){
									location.href = "<?=base_url('beranda');?>";
								}
							},
							error: function() {
								alert("error");
							}
						})
					})
				}
			})
		}
	});
</script>
<?php if(isset($_POST['masuk'])){ ?>
<script type="text/javascript">
	// keluar()
	

	$( document ).ready(function() {
	    login();
	});

	function login() {
		var e = "<?=$_POST['mail'];?>";
		var p = "<?=$_POST['pass'];?>";
		$('#pass').prop('disabled', true);
		$('#mail').prop('disabled', true);
		firebase.auth().signInWithEmailAndPassword(e, p).then(function() {

		}).catch(function(error) {
			var errorCode = error.code;
			var errorMessage = error.message;
			// if(errorMessage != null){
			// 	musik("loginsalah")
			// }
		});
		$('#pass').prop('disabled', false);
		$('#mail').prop('disabled', false);
	}
</script>
<?php } ?>
<?=$this->endSection();?>