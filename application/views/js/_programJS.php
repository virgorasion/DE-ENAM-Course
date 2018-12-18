<script>
	var kodeInstansi = "";
	var kodeProgram = "";
	var kodeKegiatan = "";
	var kodeRekening = "";
	var tableKegiatan = "";
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

	//Fungsi: untuk memunculkan data dan menampilkan box kegiatan & toggle
	$('#tableProgram').on('click', '#btnView', function () {
		if ($('#boxKegiatan').hasClass('hidden')) {
			var $item = $(this).closest('tr');
			kodeProgram = $.trim($item.find('#kode_program').text());
			funcTableKegiatan(kodeProgram);
		}else {
			$('#boxKegiatan').slideDown(1000);
			$('#boxKegiatan').addClass('hidden');
			tableKegiatan.destroy();
		}
	});
	//Fungsi: Hidden box Kegiatan
	$('#btnHidden').click(function(){
		$('#boxKegiatan').fadeOut(1000);
		$('#boxKegiatan').addClass('hidden');
		tableKegiatan.destroy();
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
    });


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

	//Fungsi: untuk delete ketika btn delete di tableProgram di klik
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

	//Fungsi: untuk menampilkan modal tambah kegiatan
	$('#btnAddKegiatan').click(function(){
		$('#modalTambahKegiatan').modal('show');
		$('#kodeProgram').val(kodeProgram);
	})
	//Fungsi: untuk menampilkan modal tambah Rekening
	$('#btnAddRekening').click(function(){
		$("#formActionRekening").find("#actionTypeRekening").val("add");
		$('#modalRekening').modal('show');
		$('#KodeKegiatanRekening').val(kodeKegiatan);
		$('#KodeInstansiRekening').val(kodeInstansi);
		$('#KodeProgramRekening').val(kodeProgram);
	})

	//Fungsi: untuk delete ketika btn delete di tableKegiatan di klik
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

	//Fungsi: untuk delete ketika btn delete di tableRekening di klik
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

	//Fungsi: Delete Data Detail Rekening
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

	$("#tabProgram").click(function(){
		$('#boxKegiatan').slideDown(1000);
		$('#boxKegiatan').removeClass('hidden');
		if (tableKegiatan instanceof $.fn.dataTable.Api == false) {
			funcTableKegiatan(kodeProgram);
			console.log("kegiatan initialize");
		}
	})

	//Fungsi: Insert Detail Rekening input Total Real-Time
	$("#addVolume, #addHarga").keyup(function(){
		var volume = $("#addVolume").val();
		var harga = $("#addHarga").val();
		$("#addTotal").val(volume * harga);
	})

	// Fungsi:Insert Indikator
	$("#btnAddIndikator").click(function(){
		$("#modalAddIndikator").modal("show");
	})


</script>