<script type="text/javascript">
	var table;
    $(document).ready(function() {
	 
	        //datatables
    table = $('#dtable_get_list').DataTable({ 
	 
	            "processing": true, 
	            "serverSide": true, 
	            "order": [], 
	             
	            "ajax": {
	                "url": "<?php echo site_url('aslab/kelas/dtable_get_list_tugas')?>",
	                "type": "POST"
	            },
	 
	            buttons: [
		            'pdfHtml5'
		        ],

	            "columnDefs": [
	            { 
	                "targets": [ 0 ], 
	                "orderable": false, 
	            },
	            ],

		        
	 
	    });
	 
	});
</script>

<script type="text/javascript">
	function deleteTugas(id){
		if(confirm('Apakah anda yakin menghapus data ini?')){

			$.ajax({
				url  : "<?php echo site_url('aslab/Kelas/dtable_drop_row_tugas') ?>/"+id,
				type : "POST",
				dataType : "JSON",
				success  : function(data)
				{
					reload_table();
				}
			})
			reload_table();
		}
	}
</script>

<script type="text/javascript">
	function reload_table()
	{
		table.ajax.reload(null,false);
	}
</script>
<script type="text/javascript">
	function viewTugas(id){
		$('#viewTugas').modal('show');
		$.ajax({
			url  : "<?php echo site_url('aslab/Kelas/get_list_tugas'); ?>/"+id,
			type : "POST",
			dataType : "JSON",
			success  : function(data)
			{
				$('#tableTugaslist').empty();
				$.each(data, function(i, item) {
					
				    $('#tableTugaslist').append('<tr><td>'+(i+1)+'</td><td>'+data[i].npm+'</td><td><a class="btn btn-sm btn-primary m-1" href="../../uploads/tugas/'+data[i].namaFile+'" title="Download"><i class="fa fa-download"></i></a></td></tr>');
				});
			}
		});
	}
</script>