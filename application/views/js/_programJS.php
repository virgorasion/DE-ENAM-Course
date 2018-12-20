<script>
	var kodeInstansi = "";
	var kodeProgram = "";
	var kodeKegiatan = "";
	var kodeRekening = "";
	var tableKegiatan = "";
	var tableIndikator = "";
	var tableRekening = "";
	var tableDetailRekening = "";
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

	//Fungsi: untuk menggenerate table Kegiatan secara serverSide
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
				ajax: {"url": "<?= site_url('ProgramCtrl/dataTableApi/') ?>"+kodeInstansi+"/"+kodeProgram, "type": "POST"},
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

	//Fungsi: untuk menggenerate table IndkatorKegiatan secara serverSide
	function funcTableIndikator() {
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

	//Fungsi: untuk menggenerate table Rekening secara serverSide
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

	//Fungsi: untuk memunculkan Box Kegiatan seusai edit & delete
	<?php if (@$_SESSION['kodeProgram'] != null) { ?>
		kodeProgram = "<?= @$_SESSION['kodeProgram']; ?>";
		funcTableKegiatan(kodeProgram);
	<?php 
} ?>

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
			funcTableKegiatan(kodeProgram);
			funcTableIndikator();
 		}else {
			$('#boxKegiatan').slideDown(1000);
			$('#boxKegiatan').addClass('hidden');
			tableKegiatan.destroy();
			tableIndikator.destroy();
		}
	});
	//Fungsi: Hidden box Kegiatan
	$('#btnHidden').click(function(){
		$('#boxKegiatan').fadeOut(1000);
		$('#boxKegiatan').addClass('hidden');
		tableKegiatan.destroy();
		tableIndikator.destroy();
	});

	//Fungsi: Show Data IndikatorKegiatan
    $("#tabIndikatorKegiatan").click(function(){
		if (tableIndikator instanceof $.fn.dataTable.Api == false) {
			funcTableIndikator();
		}
    })

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
		$("#FormAddIndikator").find("#addJenisIndikator").val(jenis);
		$("#FormAddIndikator").find("#addUraianIndikator").val(uraian);
		$("#FormAddIndikator").find("#addSatuanIndikator").val(satuan);
		$("#FormAddIndikator").find("#addTarget").val(target);
		$("#FormAddIndikator").find("#MainIdIndikator").val(id);
		$("#FormAddIndikator").find("#actionTypeIndikator").val("edit");
		$("#FormAddIndikator").find("#KodeInstansiIndikator").val(kodeInstansi);
		$("#FormAddIndikator").find("#KodeProgramIndikator").val(kodeProgram);
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
              window.location = "<?= site_url('ProgramCtrl/HapusKegiatan/') ?>" + id +"/"+ kodeProgram +"/"+ kodeInstansi;
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
              window.location = "<?= site_url('ProgramCtrl/HapusIndikator/') ?>" + id +"/"+ kodeProgram +"/"+ kodeInstansi;
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
	$("#tabProgram").click(function(){
		$('#boxKegiatan').slideDown(1000);
		$('#boxKegiatan').removeClass('hidden');
		if (tableKegiatan instanceof $.fn.dataTable.Api == false) {
			funcTableKegiatan(kodeProgram);
			console.log("kegiatan initialize");
		}
	})

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
		$("#FormAddIndikator").find("#actionTypeIndikator").val("add");
	})

	//Fungsi: Insert Pembahasan
	$("#btnAddPembahasan").click(function(){
		$.ajax({
			url: "<?=site_url('ProgramCtrl/GetDataInsertPembahasanSatu/')?>"+"Satu"+"/"+kodeInstansi+"/"+kodeProgram,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				$("#FormAddPembahasan").find("#addProgramPembahasan").val(data[0].nama_program);
				$("#FormAddPembahasan").find("#addPlafonPembahasan").val(data[0].plafon);
				$("#FormAddPembahasan").find("#addInstansiPembahasan").val(data[0].nama_instansi);
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
				})
			}
		});
	})

	//Fungsi: Change data rekening pembahasan
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

			}
		})
		$.ajax({
			url: "<?= site_url('ProgramCtrl/GetDataInsertPembahasanEmpat/') ?>"+"Empat"+"/"+kodeInstansi+"/"+kodeProgram+"/"+kegiatanKode,
			type: "POST",
			success:function(result){
				var data = JSON.parse(result);
				var html = "<option>Nama Rekening</option>";
				$.each(data,function(i){
					html += '<option value="'+data[i].kode_rekening+'">'+data[i].uraian_rekening+'</option>';
					$("#addNamaRekeningPembahasan").html(html);
				})
			}
		})
	})

	//Fungsi: Show data triwulan
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

	//Fungsi: Insert Pembahasan
	$("#btnAddPembahasan").click(function(){
		$("#modalPembahasan").modal("show");
	})

</script>