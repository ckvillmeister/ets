<table class="table table-xs table-hover table-striped table-condensed" id="tbl" style="width:100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Image</th>
            <th class="text-center">File Name</th>
            <th class="text-center">Type</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody id="table-filelist">
		@php ($ctr = 1)
		@foreach ($files as $file)
		<tr>
		    <td class="text-center">{{ $ctr++ }}</td>
		    <td class="text-center">
		    	@if (in_array($file->type,  ['jpg', 'jpeg', 'png', 'bmp', 'gif']))
		            <img src="{{ asset('files/'.$file->filename) }}" style="height: 50px; width: 50px">
		        @elseif ($file->type == 'pdf')
		            <i class="far fa-file-pdf pt-2" style="height: 50px; width: 50px; font-size: 25pt"></i>
		        @elseif ($file->type == 'docx')
		            <i class="far fa-file-word pt-2" style="height: 50px; width: 50px; font-size: 25pt"></i>
		        @endif
		    </td>
		    <td>{{ $file->filename }}</td>
		    <td>{{ $file->type }}</td>
		    <td class="text-center">
		        <button class="btn btn-sm btn-primary waves-effect" data-id="{{ $file->id }}" data-filename="{{ $file->filename }}" onclick="selectFile(this)">
		           Select</button>
		    </td>
		</tr>
		@endforeach
	</tbody>
</table>

<script>
	var tbl = $('#tbl').DataTable({
        lengthMenu: [5, 10, 25, 50, 75]
    });

    function selectFile(){
    	var id = $(event.target).attr('data-id');
    	var filename = $(event.target).attr('data-filename');
    	var duplicate = false;

    	$('#table-list').find('tr').each(function(){
		    var $this = $(this);

		    if(filename == $('td:eq(1)', $this).text()){
		    	swal("Duplicate", "File selected already attached!", "error");
		        duplicate = true;
		    }
		});

    	if (!duplicate){
	    	$('#attached-file-list').append('<tr>' +
	    										'<td class="text-center">' + ctr++ + '</td>' +
	    										'<td>' + filename + '</td>' +
	    										'<td class="text-center">' +
	    											'<button type="button" class="btn btn-sm btn-danger" id="remove-file" value="'+id+'" data-permanent="0"><i class="fas fa-trash-alt"></i></button>' +
	    										'</td>' +
	    									'</tr>');
	    }
    }
</script>