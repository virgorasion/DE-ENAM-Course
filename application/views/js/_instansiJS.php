<script>
    // Row selection (single row)
	// -----------------------------------------------------------------
	var rowSelection = $('#datatable').DataTable({
		"order": [5, "DESC"],
		"responsive": true,
		"language": {
			"paginate": {
				"previous": '<i class="fa fa-angle-left"></i>',
				"next": '<i class="fa fa-angle-right"></i>'
			}
		}
	});
var faIcon = {
	valid: 'fa fa-check-circle fa-lg text-success',
	invalid: 'fa fa-times-circle fa-lg',
	validating: 'fa fa-refresh'
}
$('#datatable').on('click', '#btnView', function () {
	var $item = $(this).closest('tr');
	var $kode = $item.find('#kode').text();
	// alert($kode+"asdasd");
	window.location = "<?= site_url('ProgramCtrl/index/') ?>" + $kode;

});

// data program di instansi
$('#addInstansiSiswa').on('change', function(){
    var dataInstansi = $(this).val();
    console.log(dataInstansi);
    var url = "<?= site_url('InstansiCtrl/getDataProgramAPI/') ?>" + dataInstansi;
    $.ajax({
        url: url,
        type: 'POST',
        success:function(result){
            var data = JSON.parse(result);
            console.log(data);
            var html = '';
            $.each(data, function(i){
                html += '<option value="'+data[i].kode_program+'">'+data[i].nama_program+'</option>';
                $('#addProgramSiswa').html(html);
            })
        }
    })
})

$('#datatable').on('click', '#btnEdit', function () {
	var $item = $(this).closest('tr');
	var id = $item.find('#idInstansi').val();
	var url = "<?= site_url('InstansiCtrl/DataEdit/') ?>" + id;
	$.ajax({
		url: url,
		type: 'POST',
		success: function (result) {
			var data = JSON.parse(result);
			// console.log(data[0].tahun);
			$('#mainID').val(id);
			$('#editUser').val(data[0].username);
			$('#editTahun').val(data[0].tahun);
			$('#editId').val(data[0].kode_instansi);
			$('#editInstansi').val(data[0].nama_instansi);
			$('#editVersi').val(data[0].versi);
			$('#editKet').val(data[0].keterangan);
		}
	});
})

$(".alert").fadeTo(2000, 500).slideUp(500, function(){
	$(".alert").slideUp(500);
});

$('#formTambah').bootstrapValidator({
	message: 'This value is not valid',
	feedbackIcons: faIcon,
	fields: {
		addPass: {
			validators: {
				notEmpty: {
					message: 'The password is required and can\'t be empty'
				},
				identical: {
					field: 'confirmPassword',
					message: 'The password and its confirm are not the same'
				}
			}
		},
		confirmPassword: {
			validators: {
				notEmpty: {
					message: 'The confirm password is required and can\'t be empty'
				},
				identical: {
					field: 'addPass',
					message: 'The password and its confirm are not the same'
				}
			}
		}
	}
});

$('#formEdit').bootstrapValidator({
	message: 'Kolom tidak boleh kosong',
	feedbackIcons: faIcon,
	fields: {
		editPass: {
			validators: {
				identical: {
					field: 'passConfirmEdit',
					message: 'The password and its confirm are not the same'
				}
			}
		},
		passConfirmEdit: {
			validators: {
				identical: {
					field: 'editPass',
					message: 'The password and its confirm are not the same'
				}
			}
		}
	}
});

$('#formTambahSiswa').bootstrapValidator({
	message: 'This value is not valid',
	feedbackIcons: faIcon,
	fields: {
		addPassSiswa: {
			validators: {
				notEmpty: {
					message: 'The password is required and can\'t be empty'
				},
				identical: {
					field: 'confPassSiswa',
					message: 'The password and its confirm are not the same'
				}
			}
		},
		confPassSiswa: {
			validators: {
				notEmpty: {
					message: 'The confirm password is required and can\'t be empty'
				},
				identical: {
					field: 'addPassSiswa',
					message: 'The password and its confirm are not the same'
				}
			}
		}
	}
});

$('#datatable').on('click', '#btnDelete', function () {
	var $item = $(this).closest("tr");
	var $nama = $item.find("#unit").text();
	console.log($nama);
	// $item.find("input[id$='no']").val();
	// alert("hai");
	$.confirm({
		theme: 'supervan',
		title: 'Hapus Data Ini ?',
		content: 'Instansi ' + $nama,
		autoClose: 'Cancel|10000',
		buttons: {
			Cancel: function () {},
			delete: {
				text: 'Delete',
				action: function () {
					window.location = "<?= site_url('InstansiCtrl/Hapus/') ?>" + $item.find("#idInstansi").val();
				}
			}
		}
	});
});
</script>