<script>
	var kodeProgram = "";
	var kodeInstansi = "";
	var table = "";
    // Setup datatables
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

	function tableKegiatan(kodeProgram) {
		$('#boxDetail').fadeIn(1000);
		$('#boxDetail').removeClass('hidden');
		kodeInstansi = "<?= $kodeInstansi ?>";
		// console.log(kodeProgram);
		table = $("#tableKegiatan").DataTable({
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
						{"data": "total_rinci", render: $.fn.dataTable.render.number(',', '.', '')},
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
	return table;
	}

	// Row selection (single row)
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

	<?php if (@$_SESSION['kodeProgram'] != null) { ?>
		kodeProgram = "<?= @$_SESSION['kodeProgram']; ?>";
		tableKegiatan(kodeProgram);
	<?php 
} ?>

	$('#tableProgram').on('click', '#btnView', function () {
		if ($('#boxDetail').hasClass('hidden')) {
			var $item = $(this).closest('tr');
			kodeProgram = $.trim($item.find('#kode_program').text());
			// console.log(kodeProgram);
			tableKegiatan(kodeProgram);
		}else {
			$('#boxDetail').fadeOut(1000);
			$('#boxDetail').addClass('hidden');
			table.destroy();
		}
	});
	$('#btnHidden').click(function(){
		$('#boxDetail').fadeOut(1000);
		$('#boxDetail').addClass('hidden');
		table.destroy();
	});

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
				$('#programIdEdit').val(id);
				$('#editKodeProgram').val(data[0].kode_program);
				$('#editNamaProgram').val(data[0].nama_program);
				$('#editPlafon').val(data[0].plafon);
			}
		});
	})

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

	$('#btnAddKegiatan').click(function(){
		$('#modalTambahKegiatan').modal('show');
		$('#kodeProgram').val(kodeProgram);
	})

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

	$('#btnAddKegiatan').click(function(){
		$('#modalTambahKegiatan').modal('show');
		$('#kodeProgram').val(kodeProgram);
	})

	$('#addPlafon,#editPlafon, .inputMask').inputmask('decimal', {
		digits: 2,
		placeholder: "0",
		digitsOptional: true,
		radixPoint: ",",
		groupSeparator: ".",
		autoGroup: true,
		rightAlign: false
		// prefix: "Rp "
	});

</script>