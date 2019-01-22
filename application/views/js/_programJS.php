<script>
	var kodeInstansi = "";
	var kodeProgram = "";
	var kodeKegiatan = "";
	var kodeRekening = "";
	var tableSiswaCetak = "";
	var tableKegiatanCetak = "";
	var tableKegiatan = "";
	var tableIndikator = "";
	var tablePembahasan = "";
	var tableRekening = "";
	var tableDetailRekening = "";
	var idSiswa = "";
    // Setup datatables
	$.fn.dataTableExt.errMode = 'none';
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
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

	//Fungsi: untuk menggenerate table Kegiatan
	function funcTableKegiatan(kodeProgram) {
		$('#boxKegiatan').fadeIn(1000);
		$('#boxKegiatan').removeClass('hidden');
		kodeInstansi = "<?= $kodeInstansi ?>";
		console.log(kodeInstansi+"instansi");
		// console.log(kodeProgram);
		tableKegiatan = $("#tableKegiatan").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading....'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/dataTableApi/') ?>"+kodeInstansi+"/"+kodeProgram+"/"+idSiswa, "type": "POST"},
					columns: [
						{
							"data": null,
							"orderable": false,
							"searchable": false
						},
						{"data": "kode_kegiatan"},
						{"data": "nama_kegiatan"},
						{"data": "keterangan"},
						{"data": "total_rekening", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "total_rinci", "orderabel": false, "searchable": false},
						{"data": "action", "orderable": false, "searchable": false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		// end setup datatables	
	return tableKegiatan;
	}

	//Fungsi: untuk menggenerate table Siswa cetak
	function funcTableSiswaCetak() {
		kodeInstansi = "<?= $kodeInstansi ?>";
		var hakAkses = "<?= $hakAkses ?>";
		tableSiswaCetak = $("#tableSiswaCetak").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading....'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/TableSiswaCetakAPI/') ?>"+hakAkses+"/"+kodeInstansi, "type": "POST"},
					columns: [
						{"data": "nisn"},
						{"data": "nis"},
						{"data": "nama"},
						{"data": "nama_instansi"},
						{"data": "nama_program"},
						{"data": "view", "searchable":false, "sortable":false},
						{"data": "print", "searchable":false, "sortable":false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
			}

		});
		// end setup datatables	
	return tableSiswaCetak;
	}

	//Fungsi: untuk menggenerate table Kegiatan cetak
	function funcTableKegiatanCetak(kodeInstansi,kodeProgram) {
		tableKegiatanCetak = $("#tableKegiatanCetak").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading....'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/TableKegiatanCetakAPI/') ?>"+kodeInstansi+"/"+kodeProgram, "type": "POST"},
					columns: [
						{
							"data": null,
							"orderable": false,
							"searchable": false
						},
						{"data": "kode_kegiatan"},
						{"data": "nama_kegiatan"},
						{"data": "keterangan"},
						{"data": "total_rekening", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "total_rinci", "orderabel": false, "searchable": false},
						{"data": "print_rka", "orderable": false, "searchable": false},
						{"data": "print_cov", "orderable": false, "searchable": false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		// end setup datatables	
	return tableKegiatanCetak;
	}

	//Fungsi: untuk menggenerate table IndkatorKegiatan
	function funcTableIndikator() {
		kodeInstansi = "<?= $kodeInstansi ?>";
		$('#boxKegiatan').fadeIn(1000);
		$('#boxKegiatan').removeClass('hidden');
		tableIndikator = $("#tableIndikator").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading....'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/tableIndikatorAPI/') ?>"+kodeInstansi+"/"+kodeProgram, "type": "POST"},
					columns: [
						{"data": "c_jenis", "searchable":false,"orderabel":false},
						{
							"data": null,
							"orderable": false,
							"searchable": false
						},
						{"data": "uraian"},
						{"data": "target"},
						{"data": "action", "orderable": false, "searchable": false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(1)', row).html(index);
			}

		});
		// end setup datatables	
	return tableIndikator;
	}

	//Fungsi: untuk menggenerate table IndkatorKegiatan
	function funcTablePembahasan() {
		kodeInstansi = "<?= $kodeInstansi ?>";
		$('#boxKegiatan').fadeIn(1000);
		$('#boxKegiatan').removeClass('hidden');
		tablePembahasan = $("#tablePembahasan").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading....'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/tablePembahasanAPI/') ?>"+kodeInstansi+"/"+kodeProgram, "type": "POST"},
					columns: [
						{
							"data": null,
							"orderable": false,
							"searchable": false
						},
						{"data": "nama_siswa"},
						{"data": "nama_instansi"},
						{"data": "plafon"},
						{"data": "triwulan1_pembahasan"},
						{"data": "triwulan2_pembahasan"},
						{"data": "triwulan3_pembahasan"},
						{"data": "triwulan4_pembahasan"},
						{"data": "nilai"},
						{"data": "action", "orderable": false, "searchable": false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		// end setup datatables	
	return tablePembahasan;
	}

	//Fungsi: untuk menggenerate table Rekening
	function funcTableRekening(kodeInstansi,kodeProgram,kodeKegiatan) {
		tableRekening = $("#tableRekening").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading....'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/DataAPIRekening/') ?>"+kodeInstansi+"/"+kodeProgram+"/"+kodeKegiatan, "type": "POST"},
					columns: [
						{"data": "kode_rekening"},
						{"data": "uraian_rekening"},
						{"data": "triwulan_1", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "triwulan_2", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "triwulan_3", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "triwulan_4", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "total", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "total_rinci", "orderable": false, "searchable": false},
						{"data": "action", "orderable": false, "searchable": false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
			}

		});
		// end setup datatables
	return tableRekening;
	}

	//Fungsi: Generate Table Detail Rekening
	function funcTableDetailRekening(kodeInstansi,kodeRekening) {
		tableDetailRekening = $("#tableDetailRekening").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading...'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/DataDetailRekening/') ?>"+kodeInstansi+"/"+kodeRekening, "type": "POST"},
					columns: [
						{"data": null,
							"orderable": false,
							"searchable": false
						},
						{"data": "uraian"},
						{"data": "sub_uraian"},
						{"data": "satuan"},
						{"data": "volume"},
						{"data": "harga",render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "total", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "keterangan"},
						{"data": "action", "orderable": false, "searchable": false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}
		});
	return tableRekening;
	}

	function infoKegiatan(kodeInstansi,kodeProgram){
		$.ajax({
			url: "<?= site_url('ProgramCtrl/GetDataInfoKegiatan/') ?>"+kodeInstansi+"/"+kodeProgram,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				console.log(result);
				$("#InfoJenis").text(data[0].jenis);
				$("#InfoKodeKegiatan").text(data[0].kode_program);
				$("#InfoNamaKegiatan").text(data[0].nama_program);
				$("#InfoUraian").text(data[0].uraian);
				$("#InfoSasaran").text(data[0].sasaran);
				$("#InfoPlafon").text(data[0].plafon);
			}
		})
	}

	function penanggungJawab(idSiswa){
		$.ajax({
			url: "<?=site_url('ProgramCtrl/tablePenanggungJawabAPI/')?>"+idSiswa,
			type: "POST",
			success: (result) =>{
				var data = JSON.parse(result);
				console.log(data);
				$("#nisnPJSiswa").text(data[0].nisn);
				$("#nisPJSiswa").text(data[0].nis);
				$("#namaPJSiswa").text(data[0].nama);
				$("#userPJSiswa").text(data[0].username);
				$("#instansiPJSiswa").text(data[0].nama_instansi);
				$("#programPJSiswa").text(data[0].nama_program);
			}
		})
	}


	// Fungsi: datatable pada tableProgram
	// -----------------------------------------------------------------
	var rowSelection = $('#tableProgram').DataTable({
		"columnDefs": [{
			width: 600,
			targets: 2
		}],
		"responsive": true,
		"language": {
			"paginate": {
				"previous": '<i class="fa fa-angle-left"></i>',
				"next": '<i class="fa fa-angle-right"></i>'
			}
		}
	});

	//Fungsi: Initialize Select2
	$(".select2").select2();

	//Message Alert
	$(".alert").fadeTo(2000, 500).slideUp(500, function(){
	$(".alert").slideUp(500);
	});

	//Fungsi: Set variable kodeProgram setiap action dijalankan
	<?php if (@$_SESSION['kodeProgram'] != null) { ?>
		kodeProgram = "<?= @$_SESSION['kodeProgram']; ?>";
	<?php } ?>

	<?php if (@$_SESSION['Pembahasan_Direct'] != null) { ?>
		idSiswa = "<?=@$_SESSION['idSiswa']?>";
		funcTableKegiatan(kodeProgram);
		funcTableIndikator();
		infoKegiatan(kodeInstansi,kodeProgram);
		penanggungJawab(idSiswa);
		funcTablePembahasan();
		$("#tabKegiatan").removeClass("active");
		$("#nav-tabs-kegiatan-4").removeClass("active in");
		$("#tabPembahasanKegiatan").addClass("active");
		$("#nav-tabs-kegiatan-5").addClass("active in");
	<?php }?>
	<?php if (@$_SESSION['Indikator_Direct'] != null) { ?>
		idSiswa = "<?=@$_SESSION['idSiswa']?>";
		funcTablePembahasan();
		funcTableKegiatan(kodeProgram);
		infoKegiatan(kodeInstansi,kodeProgram);
		penanggungJawab(idSiswa);
		funcTableIndikator();
		$("#tabKegiatan").removeClass("active");
		$("#nav-tabs-kegiatan-4").removeClass("active in");
		$("#tabIndikatorPembahasan").addClass("active");
		$("#nav-tabs-kegiatan-2").addClass("active in");
	<?php }?>

	// Fungsi: Redirect Rekening
	<?php if (@$_SESSION['Rekening_Direct'] != null) { ?>
		kodeInstansi = "<?= @$_SESSION['Rekening_KodeInstansi'] ?>";
		kodeProgram = "<?= @$_SESSION['Rekening_KodeProgram'] ?>";
		kodeKegiatan = "<?= @$_SESSION['Rekening_KodeKegiatan'] ?>";
		$("#nav-tab-program-3").removeClass("hidden");
		$("#nav-tab-program-2").removeClass("active");
		$("#nav-tab-program-3").addClass("active");
		$("#tabKodeRekening").removeClass("hidden");
		$("#tabProgram").removeClass("active");
		$("#tabKodeRekening").addClass("active");
		funcTableRekening(kodeInstansi,kodeProgram,kodeKegiatan);
	<?php 
} ?>

	// Fungsi: Redirect ke Detail Rekening
	<?php if (@$_SESSION['DetailRekening_Direct'] != null) { ?>
		kodeInstansi = "<?= @$_SESSION['DetailRekening_KodeInstansi'] ?>";
		kodeProgram = "<?= @$_SESSION['DetailRekening_KodeProgram'] ?>";
		kodeKegiatan = "<?= @$_SESSION['DetailRekening_KodeKegiatan'] ?>";
		kodeRekening = "<?= @$_SESSION['DetailRekening_KodeRekening'] ?>";
		$("#nav-tab-program-3").removeClass("hidden");
		$("#nav-tab-program-2").removeClass("active");
		$("#nav-tab-program-3").addClass("active");
		$("#tabKodeRekening").removeClass("hidden");
		$("#tabProgram").removeClass("active");
		$("#tabKodeRekening").addClass("active");
		$("#boxDetailRekening").removeClass("hidden");
		funcTableRekening(kodeInstansi,kodeProgram,kodeKegiatan);
		funcTableDetailRekening(kodeInstansi,kodeRekening);
	<?php } ?>

	//Fungsi: Show Box Kegiatan From btnView program
	$('#tableProgram').on('click', '#btnView', function () {
		if ($('#boxKegiatan').hasClass('hidden')) {
			var $item = $(this).closest('tr');
			kodeProgram = $.trim($item.find('#kode_program').text());
			idSiswa = $item.find("#idSiswa").val();


			funcTableKegiatan(kodeProgram,idSiswa);
			funcTableIndikator();
			funcTablePembahasan();
			infoKegiatan(kodeInstansi,kodeProgram);
			penanggungJawab(idSiswa);
 		}else {
			$('#boxKegiatan').slideDown(1000);
			$('#boxKegiatan').addClass('hidden');
			tableKegiatan.destroy();
			tableIndikator.destroy();
			tablePembahasan.destroy();
		}
	});

	
	//Fungsi: Hidden box Kegiatan
	$('#btnHidden').click(function(){
		$('#boxKegiatan').fadeOut(1000);
		$('#boxKegiatan').addClass('hidden');
		tableKegiatan.destroy();
		tableIndikator.destroy();
		tablePembahasan.destroy();
	});

	// Funngsi: Show box detail rekening
	$("#tableRekening").on('click','.view_data', function(){
		var idRekening = $(this).data('id');
		var kodeRek = $(this).data('koderek');
		kodeRekening = kodeRek;
		var kodeKeg = $(this).data('kodekeg');
	if ($('#boxDetailRekening').hasClass('hidden')) {
			$("#boxDetailRekening").removeClass("hidden");
			$("#boxDetailRekening").slideDown();
			funcTableDetailRekening(kodeInstansi,kodeRekening);
		}else {
			$('#boxDetailRekening').slideDown(1000);
			$('#boxDetailRekening').addClass('hidden');
			tableDetailRekening.destroy();
		}
	});

	// Fungsi: Insert Detail Rekening
	$("#btnTambahDetailRekening").click(function(){
		$("#modalDetailRekening").modal('show');
		$.ajax({
			url: "<?=site_url('ProgramCtrl/ApiDataKegiatan/')?>"+kodeKegiatan+"/"+kodeInstansi,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				$("#FormDetailRekening").find("#addKegiatan").val(data[0].nama_kegiatan);
			}
		})
		$("#FormDetailRekening").find("#actionTypeDetailRekening").val("add");
		$("#FormDetailRekening").find("#addJenis").val("");
		$("#FormDetailRekening").find("#addUraian").val("");
		$("#FormDetailRekening").find("#addSubUraian").val("");
		$("#FormDetailRekening").find("#addSasaran").val("");
		$("#FormDetailRekening").find("#addLokasi").val("");
		$("#FormDetailRekening").find("#addDana").val("1");
		$("#FormDetailRekening").find("#addSatuan").val("");
		$("#FormDetailRekening").find("#addVolume").val("");
		$("#FormDetailRekening").find("#addHarga").val("");
		$("#FormDetailRekening").find("#addTotal").val("");
		$("#FormDetailRekening").find("#addKeterangan").val("");
		$("#FormDetailRekening").find("#KodeInstansiDetailRekening").val(kodeInstansi);
		$("#FormDetailRekening").find("#KodeProgramDetailRekening").val(kodeProgram);
		$("#FormDetailRekening").find("#KodeKegiatanDetailRekening").val(kodeKegiatan);
		$("#FormDetailRekening").find("#KodeRekeningDetailRekening").val(kodeRekening);
	})

	//Fungsi: Edit Kegiatan
    $('#tableKegiatan').on('click', '.edit_data', function(){
		var id = $(this).data('id');
		var k = $(this).data('kode');
		var kode = k.substr(4);
		var kProgram = $(this).data('program');
		var nama = $(this).data('nama');
		var ket = $(this).data('ket');
        $('#modalEditKegiatan').modal('show');
        $('#formEditKegiatan').find('#idKegiatanEdit').val(id);
        $('#formEditKegiatan').find('#kodeProgramEdit').val(kProgram);
        $('#formEditKegiatan').find('#editKodeKegiatan').val(kode);
        $('#formEditKegiatan').find('#editNamaKegiatan').val(nama);
        $('#formEditKegiatan').find('#editKeterangan').val(ket);
        $('#formEditKegiatan').find('#editKodeKegiatan').val(kode);
        $('#formEditKegiatan').find('#addKegiatanIdSiswa').val(idSiswa);
    });

	//Fungsi: Edit Indikator
	$("#tableIndikator").on('click', '.edit_data',function(){
		var id = $(this).data("id");
		var kodeIndikator = $(this).data("indikator");
		var kodeInstansi = $(this).data("instansi");
		var kodeProgram = $(this).data("program");
		var jenis = $(this).data("jenis");
		var uraian = $(this).data("uraian");
		var satuan = $(this).data("satuan");
		var target = $(this).data("target");
		console.log(uraian);
		$("#modalIndikator").modal('show');
		$("#FormAddIndikator").find("#addNomor").val();
		$("#FormAddIndikator").find("#idSiswaIndikator").val(idSiswa);
		$("#FormAddIndikator").find("#addJenisIndikator").val(jenis);
		$("#FormAddIndikator").find("#addUraianIndikator").val(uraian);
		$("#FormAddIndikator").find("#addSatuanIndikator").val(satuan);
		$("#FormAddIndikator").find("#addTarget").val(target);
		$("#FormAddIndikator").find("#MainIdIndikator").val(id);
		$("#FormAddIndikator").find("#actionTypeIndikator").val("edit");
		$("#FormAddIndikator").find("#KodeInstansiIndikator").val(kodeInstansi);
		$("#FormAddIndikator").find("#KodeProgramIndikator").val(kodeProgram);
	})

	//Fungsi: Edit Pembahasan
	$("#tablePembahasan").on("click",".edit_data", function(){
		var id = $(this).data("id");
		var kode_pembahasan = $(this).data('pembahasan');
		var kode_instansi = $(this).data('instansi');
		var kode_program = $(this).data('program');
		var kode_kegiatan = $(this).data('kegiatan');
		var kode_rekening = $(this).data('rekening');
		var id_siswa = $(this).data('idsiswa');
		var nama_siswa = $(this).data('namasiswa');
		var plafon = $(this).data('plafon');
		var T1Rekening = $(this).data('t1rek');
		var T2Rekening = $(this).data('t2rek');
		var T3Rekening = $(this).data('t3rek');
		var T4Rekening = $(this).data('t4rek');
		var total_rekening = $(this).data('totrek');
		var T1Pembahasan = $(this).data('t1pem');
		var T2Pembahasan = $(this).data('t2pem');
		var T3Pembahasan = $(this).data('t3pem');
		var T4Pembahasan = $(this).data('t4pem');
		var nilai = $(this).data('nilai');
		var uraian = $(this).data('uraian');
		var instansi = $(this).data('namainstansi');
		var program = $(this).data('namaprogram');
		console.log(kode_kegiatan+"Kegiatan");
		$.ajax({
			url: "<?= site_url('ProgramCtrl/GetDataInsertPembahasanDua/') ?>"+"Dua"+"/"+kode_instansi+"/"+kode_program,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				var html = "<option>Pilih Kegiatan</option>";
				$.each(data,function(i){
					html += '<option value="'+data[i].kode_kegiatan+'">'+data[i].nama_kegiatan+'</option>';
					$("#addNamaKegiatanPembahasan").html(html);
				})
			}
		}).done(function(){
			$("#addNamaKegiatanPembahasan").val(kode_kegiatan);
		})

		$.ajax({
			url: "<?= site_url('ProgramCtrl/GetDataInsertPembahasanEmpat/') ?>"+"Empat"+"/"+kode_instansi+"/"+kode_program+"/"+kode_kegiatan,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				var html = "<option selected>Nama Rekening</option>";
				$.each(data,function(i){
					html += '<option value="'+data[i].kode_rekening+'">'+data[i].uraian_rekening+'</option>';
					$("#addNamaRekeningPembahasan").html(html);
				})
			}
		}).done(function(){
			$("#addNamaRekeningPembahasan").val(kode_rekening);
		})


		$("#modalPembahasan").modal("show");
		$("#actionTypePembahasan").val("edit");
		$("#MainIdPembahasan").val(id);
		$("#IdSiswaPembahasan").val(id_siswa);
		$("#KodeInstansiPembahasan").val(kode_instansi);
		$("#KodeProgramPembahasan").val(kode_program);
		$("#addNamaPembahasan").val(nama_siswa);
		$("#addInstansiPembahasan").val(instansi);
		$("#addProgramPembahasan").val(program);
		$("#addPlafonPembahasan").val(plafon);
		$("#addTotalRekeningPembahasan").val(total_rekening);
		$("#addT1RekeningPembahasan").val(T1Rekening);
		$("#addT2RekeningPembahasan").val(T2Rekening);
		$("#addT3RekeningPembahasan").val(T3Rekening);
		$("#addT4RekeningPembahasan").val(T4Rekening);
		$("#addT1Pembahasan").val(T1Pembahasan);
		$("#addT2Pembahasan").val(T2Pembahasan);
		$("#addT3Pembahasan").val(T3Pembahasan);
		$("#addT4Pembahasan").val(T4Pembahasan);
		$("#addNilaiPembahasan").val(nilai);
		$("#addUraianPembahasan").val(uraian);
	})

	//Fungsi: edit program
	$('#tableProgram').on('click','#btnEdit',function(){
		var $item = $(this).closest('tr');
		var id = $item.find('#idProgram').val();
		var url = "<?= site_url('ProgramCtrl/DataEditProgramInstansi/') ?>"+id;
		$.ajax({
			url: url,
			type: 'POST',
			success:function (result) {
				var data = JSON.parse(result);
				// console.log(data[0].tahun);
				var kode = data[0].kode_program;
				var res = kode.substr(4);
				$('#programIdEdit').val(id);
				$('#editKodeProgram').val(res);
				$('#editNamaProgram').val(data[0].nama_program);
				$('#EditJenisProgram').val(data[0].jenis);
				$('#EditUraianProgram').val(data[0].uraian);
				$('#EditSasaranProgram').val(data[0].sasaran);
				$('#editPlafon').val(data[0].plafon);
			}
		});
	})

	// Fungsi: Edit Rekening
	$('#tableRekening').on('click','.edit_data', function(){
		$("#formActionRekening").find("#actionTypeRekening").val("edit");
		console.log(kodeKegiatan);
		var mainID = $(this).data('id');
		var rekeningID = $(this).data('rekening');
		var patokanID = $(this).data('patokan');
		var uraian = $(this).data('uraian');
		var t1 = $(this).data('t1');
		var t2 = $(this).data('t2');
		var t3 = $(this).data('t3');
		var t4 = $(this).data('t4');
		$('#modalRekening').modal('show');
		$('#formActionRekening').find('#addKodeRek').val(patokanID);
		$('#formActionRekening').find('#addNamaRek').val(uraian);
		$('#formActionRekening').find('#AddT1').val(t1);
		$('#formActionRekening').find('#AddT2').val(t2);	
		$('#formActionRekening').find('#AddT3').val(t3);
		$('#formActionRekening').find('#AddT4').val(t4);
		$('#formActionRekening').find('#IDRekening').val(mainID);
		$('#formActionRekening').find('#KodeKegiatanRekening').val(kodeKegiatan);
		$('#formActionRekening').find('#KodeInstansiRekening').val(kodeInstansi);
		$('#formActionRekening').find('#KodeProgramRekening').val(kodeProgram);
		$('#formActionRekening').find('#KodeRekeningRekening').val(rekeningID);
	})

	//Fungsi: Edit Detail Rekening
	$("#tableDetailRekening").on('click', '.edit_data', function(){
		// mengubah action type menjadi edit
		$("#FormDetailRekening").find("#actionTypeDetailRekening").val("edit");
		var id = $(this).data('id');
		var jenis = $(this).data('jenis');
		var uraian = $(this).data('uraian');
		var suburaian = $(this).data('suburaian');
		var sasaran = $(this).data('sasaran');
		var lokasi = $(this).data('lokasi');
		var dana = $(this).data('dana');
		var satuan = $(this).data('satuan');
		var volume = $(this).data('volume');
		var harga = $(this).data('harga');
		var total = $(this).data('total');
		var ket = $(this).data('ket');
		console.log(uraian);
		$.ajax({
			url: "<?= site_url('ProgramCtrl/ApiDataKegiatan/') ?>"+kodeKegiatan+"/"+kodeInstansi,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				$("#FormDetailRekening").find("#addKegiatan").val(data[0].nama_kegiatan);
			}
		})
		$("#modalDetailRekening").modal("show");
		// harus menggunakan ID bukan KodeDetailRekening
		$("#FormDetailRekening").find("#MainIdDetailRekening").val(id);
		$("#FormDetailRekening").find("#addJenis").val(jenis);
		$("#FormDetailRekening").find("#addUraian").val(uraian);
		$("#FormDetailRekening").find("#addSubUraian").val(suburaian);
		$("#FormDetailRekening").find("#addSasaran").val(sasaran);
		$("#FormDetailRekening").find("#addLokasi").val(lokasi);
		$("#FormDetailRekening").find("#addDana").val(dana);
		$("#FormDetailRekening").find("#addSatuan").val(satuan);
		$("#FormDetailRekening").find("#addVolume").val(volume);
		$("#FormDetailRekening").find("#addHarga").val(harga);
		$("#FormDetailRekening").find("#addTotal").val(total);
		$("#FormDetailRekening").find("#addKeterangan").val(ket);
		$('#FormDetailRekening').find('#KodeKegiatanDetailRekening').val(kodeKegiatan);
		$('#FormDetailRekening').find('#KodeInstansiDetailRekening').val(kodeInstansi);
		$('#FormDetailRekening').find('#KodeProgramDetailRekening').val(kodeProgram);
		$('#FormDetailRekening').find('#KodeRekeningDetailRekening').val(kodeRekening);
	})

	//Fungsi: Delete Program
	$('#tableProgram').on('click', '#btnDelete', function () {
      var $item = $(this).closest("tr");
      var $nama = $.trim($item.find("#nama_program").text());
      console.log($nama);
      // $item.find("input[id$='no']").val();
      // alert("hai");
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Program Ini ?',
        content: 'Program ' + $nama,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('ProgramCtrl/Hapus/') ?>" + $item.find("#idProgram").val() +"/"+ "<?= $kodeInstansi ?>";
            }
          }
        }
      });
    });

	//Fungsi: Delete Kegiatan
	$('#tableKegiatan').on('click', '.delete_data', function () {
      var id = $(this).data('id');
	  var nama = $(this).data('nama');
      console.log(nama);
      // $item.find("input[id$='no']").val();
      // alert("hai");
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Program Ini ?',
        content: 'Kegiatan ' + nama,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('ProgramCtrl/HapusKegiatan/') ?>" + id +"/"+ kodeProgram +"/"+ kodeInstansi+"/"+idSiswa;
            }
          }
        }
      });
    });

	//Fungsi: Delete Indikator
	$('#tableIndikator').on('click', '.delete_data', function () {
      var id = $(this).data('id');
	  var uraian = $(this).data('uraian');
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Indikator Ini ?',
        content: uraian,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('ProgramCtrl/HapusIndikator/') ?>" + id +"/"+ kodeProgram +"/"+ kodeInstansi+"/"+idSiswa;
            }
          }
        }
      });
	});
	
	//Fungsi: Delete Pembahasan
	$('#tablePembahasan').on('click', '.delete_data', function () {
      var id = $(this).data('id');
	  var uraian = $(this).data('uraian');
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Pembahasan Ini ?',
        content: uraian,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('ProgramCtrl/HapusPembahasan/') ?>" + id +"/"+ kodeProgram +"/"+ kodeInstansi+"/"+idSiswa;
            }
          }
        }
      });
    });

	//Fungsi: Delete Rekening
	$('#tableRekening').on('click', '.delete_data', function () {
      var idRekening = $(this).data('id');
	  var nama = $(this).data('nama');
      console.log(nama);
      // $item.find("input[id$='no']").val();
      // alert("hai");
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Anggaran Ini ?',
        content: 'Anggaran ' + nama,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('ProgramCtrl/HapusRekening/') ?>" + idRekening +"/"+ kodeInstansi +"/"+ kodeProgram +"/"+ kodeKegiatan;
            }
          }
        }
      });
    });

	//Fungsi: Delete Detail Rekening
	$('#tableDetailRekening').on('click', '.delete_data', function () {
      var id = $(this).data('id');
	  var nama = $(this).data('uraian');
      console.log(nama);
      // $item.find("input[id$='no']").val();
      // alert("hai");
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Anggaran Ini ?',
        content: 'Anggaran ' + nama,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('ProgramCtrl/HapusDetailRekening/') ?>" + id +"/"+ kodeInstansi +"/"+ kodeProgram +"/"+ kodeKegiatan +"/"+ kodeRekening;
            }
          }
        }
      });
    });

	//Fungsi: untuk input berupa ribuan
	$('#addPlafon, #editPlafon, .inputMask').inputmask('decimal', {
		digits: 2,
		placeholder: "0",
		digitsOptional: true,
		radixPoint: ",",
		groupSeparator: ".",
		autoGroup: true,
		rightAlign: false
		// prefix: "Rp "
	});
	
	//Fungsi: untuk memunculkan tab kode rekening di Box Program
	$('#tableKegiatan').on('click','.view_data', function(){
		$('.tabKodeRekening').removeClass('hidden');
		window.scrollTo(0,0);
		kodeKegiatan = $(this).data('kegiatan');
		console.log(kodeKegiatan);
	})

	// Fungsi: untuk menampikan Box Rekening
	$('#tab-nav').on('click', '.tabKodeRekening', function(){
		if ($('#boxKegiatan').hasClass('hidden')) {
			//Nothing
		}else{
			$('#boxKegiatan').slideUp(1000);
			$('#boxKegiatan').addClass('hidden');
			// if (tableKegiatan instanceof $.fn.dataTable.Api) {
			// 	tableKegiatan.destroy();
			// }
		}
		console.log(kodeKegiatan);
		//Funsgi: reinitialize tableRekening when click tab KodeRekening
		if (tableRekening instanceof $.fn.dataTable.Api == false) {
			funcTableRekening(kodeInstansi,kodeProgram,kodeKegiatan);
		}else {
			tableRekening.destroy();
			funcTableRekening(kodeInstansi,kodeProgram,kodeKegiatan);
		}
	});

	//Fungsi: untuk show box kegiatan ketika klik tabProgram
	// $("#tabProgram").click(function(){
	// 	$('#boxKegiatan').slideDown(1000);
	// 	$('#boxKegiatan').removeClass('hidden');
	// 	if (tableKegiatan instanceof $.fn.dataTable.Api == false) {
	// 		funcTableKegiatan(kodeProgram);
	// 	}
	// })

	//Fungsi: Insert kegiatan
	$('#btnAddKegiatan').click(function(){
		$('#modalTambahKegiatan').modal('show');
		$('#kodeProgram').val(kodeProgram);
	})
	//Fungsi: Insert Rekening
	$('#btnAddRekening').click(function(){
		$("#formActionRekening").find("#actionTypeRekening").val("add");
		$('#modalRekening').modal('show');
		$('#KodeKegiatanRekening').val(kodeKegiatan);
		$('#KodeInstansiRekening').val(kodeInstansi);
		$('#KodeProgramRekening').val(kodeProgram);
	})

	//Fungsi: Insert Detail Rekening input Total Real-Time
	$("#addVolume, #addHarga").keyup(function(){
		var volume = $("#addVolume").val();
		var harga = $("#addHarga").val();
		$("#addTotal").val(volume * harga);
	})

	// Fungsi:Insert Indikator
	$("#btnAddIndikator").click(function(){
		$("#modalIndikator").modal("show");
		$("#FormAddIndikator").find("#actionTypeIndikator").val("add");
		$("#FormAddIndikator").find("#KodeInstansiIndikator").val(kodeInstansi);
		$("#FormAddIndikator").find("#KodeProgramIndikator").val(kodeProgram);
		$("#FormAddIndikator").find("#idSiswaIndikator").val(idSiswa);
		$("#FormAddIndikator").find("#addJenisIndikator").val("");
		$("#FormAddIndikator").find("#addUraianIndikator").val("");
		$("#FormAddIndikator").find("#addSatuanIndikator").val("");
		$("#FormAddIndikator").find("#addTarget").val("");
	})

	//Fungsi: Insert Pembahasan
	$("#btnAddPembahasan").click(function(){
		$("#actionTypePembahasan").val("add");
		$("#KodeInstansiPembahasan").val(kodeInstansi);
		$("#KodeProgramPembahasan").val(kodeProgram);
		$("#addNamaPembahasan").val();
		$("#addTotalRekeningPembahasan").val("");
		$("#addT1Pembahasan").val("");
		$("#addT2Pembahasan").val("");
		$("#addT3Pembahasan").val("");
		$("#addT4Pembahasan").val("");
		$("#addT1RekeningPembahasan").val("");
		$("#addT2RekeningPembahasan").val("");
		$("#addT3RekeningPembahasan").val("");
		$("#addT4RekeningPembahasan").val("");
		$("#addNilaiPembahasan").val("");
		$("#addUraianPembahasan").val("");
		$.ajax({
			url: "<?=site_url('ProgramCtrl/GetDataInsertPembahasanSatu/')?>"+"Satu"+"/"+kodeInstansi+"/"+kodeProgram,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				$("#FormAddPembahasan").find("#addProgramPembahasan").val(data[0].nama_program);
				$("#FormAddPembahasan").find("#addPlafonPembahasan").val(data[0].plafon);
				$("#FormAddPembahasan").find("#addInstansiPembahasan").val(data[0].nama_instansi);
				$("#FormAddPembahasan").find("#addNamaPembahasan").val(data[0].nama);
				$("#FormAddPembahasan").find("#IdSiswaPembahasan").val(data[0].id_siswa);
				$.ajax({
					url: "<?= site_url('ProgramCtrl/GetDataInsertPembahasanDua/') ?>"+"Dua"+"/"+kodeInstansi+"/"+kodeProgram,
					type: "POST",
					success:function(result){
						var data = JSON.parse(result);
						var html = "<option>Pilih Kegiatan</option>";
						$.each(data,function(i){
							html += '<option value="'+data[i].kode_kegiatan+'">'+data[i].nama_kegiatan+'</option>';
							$("#addNamaKegiatanPembahasan").html(html);
						})
					}
				}).done(function(){
					$("#modalPembahasan").modal("show");
				})
			}
		});
	})

	//Fungsi: Change data rekening pembahasan [Insert Pembahasan]
	$("#addNamaKegiatanPembahasan").on('change', function(){
		var kegiatanKode = $(this).val();
		$.ajax({
			url: "<?= site_url('ProgramCtrl/GetDataInsertPembahasanTiga/') ?>"+"Tiga"+"/"+kodeInstansi+"/"+kodeProgram+"/"+kegiatanKode,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				$("#addTotalRekeningPembahasan").val(data[0].total_rekening);
				$("#addT1Pembahasan").val(data[0].total_rekening /100*20);
				$("#addT2Pembahasan").val(data[0].total_rekening /100*35);
				$("#addT3Pembahasan").val(data[0].total_rekening /100*30);
				$("#addT4Pembahasan").val(data[0].total_rekening /100*15);
				$("#addT1RekeningPembahasan").val("");
				$("#addT2RekeningPembahasan").val("");
				$("#addT3RekeningPembahasan").val("");
				$("#addT4RekeningPembahasan").val("");

			}
		})
		$.ajax({
			url: "<?= site_url('ProgramCtrl/GetDataInsertPembahasanEmpat/') ?>"+"Empat"+"/"+kodeInstansi+"/"+kodeProgram+"/"+kegiatanKode,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				var html = "<option selected>Nama Rekening</option>";
				$.each(data,function(i){
					console.log(data);
					if (data == null) {
						console.log(data);
						html += '<option value="">Kosong</option>';
						$("#addNamaRekeningPembahasan").html(html);
					}else {
						html += '<option value="'+data[i].kode_rekening+'">'+data[i].uraian_rekening+'</option>';
						$("#addNamaRekeningPembahasan").html(html);
					}
				})
			}
		})
	})

	//Fungsi: Show data triwulan [Insert Pembahasan]
	$("#addNamaRekeningPembahasan").on("change",function(){
		var kegiatanKode = $("#addNamaKegiatanPembahasan").val();
		var rekeningKode = $(this).val();
		$.ajax({
			url: "<?= site_url('ProgramCtrl/GetDataInsertPembahasanLima/') ?>"+"Lima"+"/"+kodeInstansi+"/"+kodeProgram+"/"+kegiatanKode+"/"+rekeningKode,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				$("#addT1RekeningPembahasan").val(data[0].triwulan_1);
				$("#addT2RekeningPembahasan").val(data[0].triwulan_2);
				$("#addT3RekeningPembahasan").val(data[0].triwulan_3);
				$("#addT4RekeningPembahasan").val(data[0].triwulan_4);
			}
		})
	})

	//Fungsi: Show modal view pembahasan
	// $("#tablePembahasan").on("click",".view_data",function(){
	// 	$("#modalViewPembahasan").modal("show");

	// })

	//Fungsi: Initialize tableSiswaCetak
	$("#tabCetakProgram").click(function(){
		if (tableSiswaCetak instanceof $.fn.dataTable.Api == false) {
			funcTableSiswaCetak();
		}
	})

	//Fungsi: show table print kegiatan
	$("#tableSiswaCetak").on("click",".view_data", function(){
		var programKode = $(this).data("program");
		var instansiKode = $(this).data("instansi");
		if (tableKegiatanCetak instanceof $.fn.dataTable.Api) {
			tableKegiatanCetak.destroy();
			funcTableKegiatanCetak(instansiKode,programKode);
		}else {
			$("#kegiatanCetak").slideDown(300);
			// $("#kegiatanCetak").removeClass("hidden");
			funcTableKegiatanCetak(instansiKode,programKode);
		}
	})

	//Fungsi: Export PDF AKB
	$("#tableSiswaCetak").on("click",".print_akb_pdf",function(){
		var programKode = $(this).data("program");
		var instansiKode = $(this).data("instansi");
		window.open("<?=site_url('Export_pdf/AKB/')?>"+instansiKode+'/'+programKode,"_blank");
	})
	//Fungsi: Export Excel AKB
	$("#tableSiswaCetak").on("click",".print_akb_excel",function(){
		var instansiKode = $(this).data("instansi");
		var programKode = $(this).data("program");
		$.ajax({
			url: window.location = "<?= site_url('Export_excel/AKB/') ?>"+instansiKode+"/"+programKode,
			beforeSend:function(){
				$("#modalLoading").modal("show");
			},
			success:function(result){
				$("#modalLoading").modal("hide");
			}
		})
	})
	//Fungsi: Export PDF Cover
	$("#tableKegiatanCetak").on("click",".print_cover",function(){
		var instansiKode = $(this).data("instansi");
		var programKode = $(this).data("program");
		var kegiatanKode = $(this).data("kegiatan");
		window.open("<?=site_url('Export_pdf/Cover/')?>"+instansiKode+'/'+programKode+'/'+kegiatanKode,'_blank');
	})

	//Fungsi: Export PDF RKA
	$("#tableKegiatanCetak").on("click",".print_rka_p",function(){
		var instansiKode = $(this).data("instansi");
		var programKode = $(this).data("program");
		var kegiatanKode = $(this).data("kegiatan");
		window.open("<?=site_url('Export_pdf/RKA/')?>"+instansiKode+'/'+programKode+'/'+kegiatanKode,'_blank');
	})
	//Fungsi: Export Excel RKA
	$("#tableKegiatanCetak").on("click",".print_rka_e",function(){
		var instansiKode = $(this).data("instansi");
		var programKode = $(this).data("program");
		var kegiatanKode = $(this).data("kegiatan");
		$.ajax({
			url: window.location = "<?= site_url('Export_excel/RKA/') ?>"+instansiKode+"/"+programKode+"/"+kegiatanKode,
			beforeSend:function(){
				$("#modalLoading").modal("show");
			},
			success:function(result){
				$("#modalLoading").modal("hide");
			}
		})
	})

</script>