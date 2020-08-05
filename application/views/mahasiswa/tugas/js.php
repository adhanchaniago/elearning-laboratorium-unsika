<script type="text/javascript">
	function cekKodeTugas() {
		var idTugas = $('#idTugas').val();
		$.ajax({
			url  : "<?php echo site_url('mahasiswa/tugas/cekKode') ?>/"+idTugas,
			type : "POST",
			dataType : "JSON",
			success  : function(data)
			{
				if(data.status == true){
					$('#pesanpesan').empty();
					$('#FormidTugas').removeClass('has-error');
					$('#FormidTugas').addClass('has-success');
					$('#pesanpesan').append(data.message);
					$('#uploadTugas').removeAttr('disabled');
				}
				else {
					$('#pesanpesan').empty();
					$('#FormidTugas').removeClass('has-success');
					$('#FormidTugas').addClass('has-error');
					$('#pesanpesan').append(data.message);
					$('#uploadTugas').attr('disabled','disabled');
				}
			}
		})
	}
</script>