<script>
	var kodeInstansi = "";

	//Message Alert
	$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
	$(".alert-success").slideUp(500);
	});
	
	$("#addInstansi").select2();

	$.fn.dataTableExt.errMode = 'none';
	$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
		return {
			"iStart": oSettings._iDisplayStart,
			"iEnd": oSettings.fnDisplayEnd(),
			"iLength": oSettings._iDisplayLength,
			"iTotal": oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
			"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		};
	};

	function funcTableRegister() {
		tableRegister = $("#tableRegister").DataTable({
			initComplete: function () {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function () {
						api.search(this.value).draw();
					});
			},
			oLanguage: {
				sProcessing: 'Loading....'
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?= site_url('Profile/DataRegistrationAPI') ?>",
				"type": "POST"
			},
			columns: [
				{
					"data": null, "searchable": false, "sortable": false
				},
				{
					"data": "nama"
				},
				{
					"data": "instansi"
				},
				{
					"data": "jurusan"
				},
				{
					"data": "nis"
				},
				{
					"data": "nisn"
				},
				{
					"data": "no_telp"
				},
				{
					"data": "username"
				},
				{
					"data": "Action"
				}
			],
			order: [
				[1, 'asc']
			],
			rowCallback: function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		return tableRegister;
	}

	function funcTableInstansi() {
		kodeInstansi = "<?=@$_SESSION['kode_instansi']?>";
		tableInstansi = $("#tableInstansi").DataTable({
			initComplete: function () {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function () {
						api.search(this.value).draw();
					});
			},
			oLanguage: {
				sProcessing: 'Loading....'
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?= site_url('Profile/DataInstansiAPI/') ?>" + kodeInstansi,
				"type": "POST"
			},
			columns: [{
					"data": "kode_instansi"
				},
				{
					"data": "nama_instansi"
				},
				{
					"data": "lokasi"
				},
				{
					"data": "tahun"
				},
				{
					"data": "versi"
				},
				{
					"data": "view"
				}
			],
			order: [
				[1, 'asc']
			],
			rowCallback: function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		return tableInstansi;
	}

	function funcTableSiswa(kode_instansi){
		tableSiswa = $("#tableSiswa").DataTable({
			initComplete: function () {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function () {
						api.search(this.value).draw();
					});
			},
			oLanguage: {
				sProcessing: 'Loading....'
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?= site_url('Profile/DataSiswaAPI/') ?>" + kode_instansi,
				"type": "POST"
			},
			columns: [
				{
					"data": null,
					"orderable": false,
					"searchable": false
				},
				{
					"data": "nama"
				},
				{
					"data": "nis"
				},
				{
					"data": "nisn"
				},
				{
					"data": "nomor_hp"
				}
				<?php if($_SESSION['hakAkses'] != 3){?>
				,{
					"data": "action"
				}
				<?php } ?>
			],
			order: [
				[1, 'asc']
			],
			rowCallback: function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		return tableSiswa;
	}

	funcTableInstansi();

	$("#tableInstansi").on("click", ".view_siswa", function () {
		var kode_instansi = $(this).data('instansi');

		$("#tabSiswa").removeClass("hidden");
		$("#tabSiswa").addClass("active");
		$("#siswa").addClass("active");
		$("#tabInstansi").removeClass("active");
		$("#instansi").removeClass("active");

		if (tableSiswa instanceof $.fn.dataTable.Api) {
			tableSiswa.destroy();
			funcTableSiswa(kode_instansi);
		}else{
			funcTableSiswa(kode_instansi);			
		}
	});

	$("#tableInstansi").on("click",".view_data",function(){
		let kode_instansi = $(this).data('instansi');
		let nama_instansi = $(this).data('nama');
		let versi = $(this).data('versi');
		let lokasi = $(this).data('lokasi');
		let keterangan = $(this).data('keterangan');
		let tahun = $(this).data('tahun');
		let username = $(this).data('username');
		let password = $(this).data('password');
		let foto = $(this).data('foto');
		$("#modalTitle").text("Data Instansi")
		$("#modalView").modal("show");
		let html = `<center>
								<img src="<?= base_url('assets/images/')?>`+foto+`" class="img-circle" width="150" height="150" alt="Empty">
							</center><br><br>
							<div class="form-group">
								<label class="col-sm-2 control-label">Kode Instansi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+kode_instansi+`" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Instansi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+nama_instansi+`" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Versi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+versi+`" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Lokasi</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+lokasi+`" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Keterangan</label>
									<div class="col-sm-9">
										<textarea class="form-control" value="`+keterangan+`" readonly></textarea>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Tahun</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+tahun+`" rows="3" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Username</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+username+`" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Password</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+password+`" readonly>
									</div>
							</div>`;
		$("#viewModalBody").html(html);
	});

	// Fungsi: Edit Data Instansi (Admin)
	$("#tableInstansi").on("click",".edit_data",function(){
		let kode_instansi = $(this).data('instansi');
		let nama_instansi = $(this).data('nama');
		let versi = $(this).data('versi');
		let lokasi = $(this).data('lokasi');
		let keterangan = $(this).data('keterangan');
		let tahun = $(this).data('tahun');
		let username = $(this).data('username');
		let password = $(this).data('password');
		let foto = $(this).data('foto');
		$("#modalEditInstansi").modal("show");
		$("#editFotoInstansi").prop("src","<?=base_url("assets/images/")?>"+foto);
		$("#editKodeInstansi").val(kode_instansi);
		$("#editNamaInstansi").val(nama_instansi);
		$("#editVersiInstansi").val(versi);
		$("#editLokasiInstansi").val(lokasi);
		$("#editKeteranganInstansi").val(keterangan);
		$("#editTahunInstansi").val(tahun);
		$("#editUsernameInstansi").val(username);
		$("#editPasswordInstansi").val(password);
	});

	// Fungsi Delete Data Instansi (Admin)
	$("#tableInstansi").on("click",".delete_data",function(){
		let instansi_kode = $(this).data("instansi");
		let nama_instansi = $(this).data("nama");
		$.confirm({
			theme: 'supervan',
			title: 'WARNING !',
			content: `MENGHAPUS INSTANSI INI AKAN MEMBUAT ANDA MENGHAPUS PULA DATA DIDALAMNYA 
								<br> TERMASUK DATA PROGRAM, KEGIATAN, REKENING, DETAIL REKENING DAN SISWA 
								<br> APAKAH ANDA YAKIN INGIN MENGHAPUS INSTANSI <br> `+" \""+ nama_instansi + "\" ",
			buttons: {
				Cancel: function () {},
				delete: {
					text: 'Delete',
					action: function(){
						$.confirm({
							theme: 'supervan',
							title: 'WARNING !',
							content: 'APAKAH ANDA YAKIN ?',
							buttons: {
								Cancel: function(){},
								Yakin: {
									text: "Yakin",
									action: function(){
										$.confirm({
											theme: 'supervan',
											title: 'WARNING !',
											content: 'TEKAN TOMBOL "OK"',
											buttons: {
												Cancel: function(){},
												OK: function(){
													window.location = "<?=site_url('Profile/hapusInstansi/')?>" + instansi_kode;
												}
											}
										})
									}
								}
							}
						})
					}
				}
			}
		});
	});

	$("#tabRegister").click(function(){
		if(tableRegister instanceof $.fn.dataTable.Api){
			tableRegister.destroy();
			funcTableRegister();
		}else{
			funcTableRegister();
		}
	})

	$("#tableRegister").on("click",".btn_add",function(){
		let id = $(this).data("id");
		let nama = $(this).data("nama");
		let instansi = $(this).data("instansi");
		let jurusan = $(this).data("jurusan");
		let nis = $(this).data("nis");
		let nisn = $(this).data("nisn");
		let telp = $(this).data("telp");
		let username = $(this).data("username");
		let img = $(this).data('foto');
		$("#modalTambahSiswa").modal('show');
	
		// Isi Select Option addInstansi
		$.ajax({
			url: "<?= site_url('Profile/NamaInstansiAPI') ?>",
			type: 'POST',
			success:function(result){
				// var data = JSON.parse(result);
				// console.log(result);
				var html = '';
				$.each(result, function(i){
					html += '<option value="'+result[i].kode_instansi+'">'+result[i].nama_instansi+'</option>';
					$('#addInstansi').html(html);
				})
			}
		})

		$("#modalTambahSiswa").find("#idRegister").val(id);
		$("#modalTambahSiswa").find(".RegistrasiFoto").prop("src","<?=base_url('assets/images/')?>"+img);
		$("#modalTambahSiswa").find("#addNama").val(nama);
		$("#modalTambahSiswa").find("#addJurusan").val(jurusan);
		$("#modalTambahSiswa").find("#addNis").val(nis);
		$("#modalTambahSiswa").find("#addNisn").val(nisn);
		$("#modalTambahSiswa").find("#addTelp").val(telp);
		$("#modalTambahSiswa").find("#addUsername").val(username);
		$("#modalTambahSiswa").find("#foto").val(img);
	})

	// Isi Select Option addProgram
	$('#addInstansi').on('change', function(){
		var dataInstansi = $(this).val();
		console.log(dataInstansi);
		var url = "<?= site_url('InstansiCtrl/getDataProgramAPI/') ?>" + dataInstansi;
		$.ajax({
			url: url,
			type: 'POST',
			success:function(result){
				var data = JSON.parse(result);
				// console.log(data);
				var html = '';
				if (data == ""){
					$("#addProgram").html("<option disable>Tidak Ada Program Tersedia</option>");
				}else{
					$.each(data, function(i){
						html += '<option value="'+data[i].kode_program+'">'+data[i].nama_program+'</option>';
						$('#addProgram').html(html);
					})
				}
			}
		})
	})

	//Fungsi show Password (registrasi siswa)
	$("#btnShowPassword").click(function(){
		if ($("#addPassword").attr("type") == "password") {
			$("#addPassword").prop("type","text");
			$("#btnShowPassword").html("<i class='fa fa-eye-slash'></i>");
		}else{
			$("#addPassword").prop("type","password");
			$("#btnShowPassword").html("<i class='fa fa-eye'></i>");
		}
	})

	// Fungsi Show Password (Profile)
	$(".btnShowPasswordProfile").click(function(){
		if ($(".passwordProfile").attr("type") == "password") {
			$(".passwordProfile").prop("type", "text");
			$(".btnShowPasswordProfile").html("<i class='fa fa-eye-slash'></i>");
		}else{
			$(".passwordProfile").prop("type","password");
			$(".btnShowPasswordProfile").html("<i class='fa fa-eye-slash'></i>");
		}
	})
	// Fungsi Show Password (Ubah Data Siswa)
	$(".btnShowUbahPasswordSiswa").click(function(){
		if ($("#ubahPasswordSiswa").attr("type") == "password") {
			$("#ubahPasswordSiswa").prop("type", "text");
			$(".btnShowUbahPasswordSiswa").html("<i class='fa fa-eye-slash'></i>");
		}else{
			$("#ubahPasswordSiswa").prop("type","password");
			$(".btnShowUbahPasswordSiswa").html("<i class='fa fa-eye-slash'></i>");
		}
	})

	// Fungsi Delete Siswa dari Table Siswa
	$("#tableSiswa").on("click",".btn-delete",function(){
		let id = $(this).data("id");
		let nama = $(this).data("nama");
		$.confirm({
			theme: 'supervan',
			title: 'Hapus Siswa Ini ?',
			content: 'Nama Siswa : ' + nama,
			autoClose: 'Cancel|10000',
			buttons: {
			Cancel: function () {},
			delete: {
				text: 'Delete',
				action: function () {
				window.location = "<?= site_url('Profile/hapus/') ?>" + id;
				}
			}
			}
		});
	})

	// Fungsi Edit Siswa 
	$("#tableSiswa").on("click",".btn-edit",function(){
		let instansiKode = $(this).data("kodeinstansi");
		let programKode = $(this).data("kodeprogram");
		let nama = $(this).data("nama");
		let jurusan = $(this).data("jurusan");
		let nis = $(this).data("nis");
		let nisn = $(this).data("nisn");
		let nope = $(this).data("nope");
		let username = $(this).data("username");
		let password = $(this).data("password");
		let id = $(this).data("id");

		$("#modalUbahSiswa").modal("show");

		$.ajax({
			url: "<?= site_url('Profile/NamaInstansiAPI') ?>",
			type: 'POST',
			success:function(result){
				var html = '';
				$.each(result, function(i){
					html += '<option value="'+result[i].kode_instansi+'">'+result[i].nama_instansi+'</option>';
					$('#ubahInstansiSiswa').html(html);
				})
			}
		}).done(function(result){
			$("#ubahInstansiSiswa").val(instansiKode);
		})

		$.ajax({
			url: "<?= site_url('Profile/DataProgramAPI/') ?>" + instansiKode +"/"+ id,
			type: 'POST',
			success:function(result){
				var data = JSON.parse(result);
				var html = '';
				$.each(data, function(i){
					html += '<option value="'+data[i].kode_program+'">'+data[i].nama_program+'</option>';
					$('#ubahProgramSiswa').html(html);
				})
			}
		}).done(function(){
			$("#ubahProgramSiswa").val(programKode);
		})

		$("#modalUbahSiswa").find("#ubahNamaSiswa").val(nama);
		$("#modalUbahSiswa").find("#ubahJurusanSiswa").val(jurusan);
		$("#modalUbahSiswa").find("#ubahNisSiswa").val(nis);
		$("#modalUbahSiswa").find("#ubahNisnSiswa").val(nisn);
		$("#modalUbahSiswa").find("#ubahNopeSiswa").val(nope);
		$("#modalUbahSiswa").find("#ubahUsernameSiswa").val(username);
		$("#modalUbahSiswa").find("#ubahPasswordSiswa").val(password);
		$("#idSiswa").val(id);
		$("#oldKodeProgram").val(programKode);
		$("#oldKodeInstansi").val(instansiKode);
	})

	// Isi Select Option ubahProgramSiswa
	$('#ubahInstansiSiswa').on('change', function(){
		var dataInstansi = $(this).val();
		var url = "<?= site_url('InstansiCtrl/getDataProgramAPI/') ?>" + dataInstansi;
		$.ajax({
			url: url,
			type: 'POST',
			success:function(result){
				var data = JSON.parse(result);
				var html = '';
				if (data == ""){
					$("#ubahProgramSiswa").html("<option disable>Tidak Ada Program Tersedia</option>");
				}else{
					$.each(data, function(i){
					html += '<option value="'+data[i].kode_program+'">'+data[i].nama_program+'</option>';
					$('#ubahProgramSiswa').html(html);
				})
				}
			}
		})
	})

	// Fungsi Show modal View Siswa
	$("#tableSiswa").on("click",".btn-view",function(){
		let foto = $(this).data("foto");
		let instansi = $(this).data("instansi");
		let nama = $(this).data("nama");
		let jurusan = $(this).data("jurusan");
		let nis = $(this).data("nis");
		let nisn = $(this).data("nisn");
		let username = $(this).data("username");
		let password = $(this).data("password");
		$("#modalView").modal("show");
		$("#modalTitle").text("Data Siswa");
		let html = `<center>
								<img src="<?= base_url('assets/images/')?>`+foto+`" class="img-circle" width="150" height="150" alt="Empty">
							</center><br><br>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="`+nama+`" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Instansi</label>
									<div class="col-sm-9">
									<input type="text" class="form-control" value="`+instansi+`" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Jurusan</label>
									<div class="col-sm-9">
									<input type="text" class="form-control" value="`+jurusan+`" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nis</label>
									<div class="col-sm-9">
									<input type="text" class="form-control" value="`+nis+`" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">NISN</label>
									<div class="col-sm-9">
									<input type="text" class="form-control" value="`+nisn+`" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Username</label>
									<div class="col-sm-9">
									<input type="text" class="form-control" value="`+username+`" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Password</label>
									<div class="col-sm-9">
									<input type="text" class="form-control" value="`+password+`" readonly>
								</div>
							</div>`;
		$("#viewModalBody").html(html);
	})

	//Fungsi: Delete Registrasi Siswa
	$('#tableRegister').on('click', '.btn_delete', function () {
      var id = $(this).data('id');
	  var nama = $(this).data('nama');
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Siswa Ini ?',
        content: 'Nama Siswa : ' + nama,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('Profile/HapusRegistrasiSiswa/') ?>" +  id;
            }
          }
        }
      });
    });

	// Fungsi: Edit Foto Profile
	$(".foto").click(function(){
		$("#modalEditFoto").modal("show");
	});

</script>