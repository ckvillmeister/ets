<div class="table-responsive mt-3">
    <table class="display table table-striped table-hover dataTable" id="table-list" style="width: 100%">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Document Type</th>
                <th class="text-center">No. Series</th>
                <th class="text-center">Title</th>
                <th class="text-center">Created By</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @if ($documents)
                @foreach ($documents as $document)
                <tr>
                    <td>{{ $ctr++ }}</td>
                    <td>{{ $document->category()->first()->category }}</td>
                    <td>{{ ($document->series) ? $document->series : '' }}</td>
                    <td>{{ $document->title }}</td>
                    <td>{{ $document->creator()->first()->firstname.' '.$document->creator()->first()->lastname }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var tbl = $('#table-list').DataTable({
            "dom": 'Brt',
            "buttons": ['print', 'excel', 'pdf'],
            "scrollX": true,
            "ordering": false,
            "paging": false
        });
    });
</script>


