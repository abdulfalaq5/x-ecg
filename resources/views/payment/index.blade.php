<x-layout.app-admin title="{!! __('Pembayaran') !!}">

    <div class="row">
        <div class="col-12">
            @include('components.layout.message-admin')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{!! __('Pembayaran') !!}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text" id="search-box" class="form-control" placeholder="Keyword..." />
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="search-btn" class="btn btn-default">Cari</button>
                        </div>
                    </div>
                    <br />

                    <div class="row">
                        <div class="col-12">
                            <table id="tbl-data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Nama') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Kode Kursus') }}</th>
                                        <th>{{ __('Nama Kursus') }}</th>
                                        <th>{{ __('Total Tagihan') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Dibuat') }}</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex">
                    <div class="text-truncate mr-auto">
                    </div>
                    <div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var table;
            var role_table = $('#tbl-data').DataTable({
                processing: true,
                serverSide: true,
                searchable: false,
                searching: false,
                lengthChange: false,
                autoWidth: false,

                ajax: {
                    url: "{{ route('payment.tagihan.list') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data: function(d) {

                        d.search = $('#search-box').val();
                    }

                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: false,
                    }, {
                        data: "email",
                        name: "email",
                        orderable: false,

                    }, {
                        data: 'code',
                        name: 'code'
                    }, {
                        data: 'title',
                        name: 'title'
                    }, {
                        data: 'total_tagihan',
                        name: 'total_tagihan'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD MMMM YYYY HH:mm');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "order": [
                    [5, 'desc']
                ],
            });
            $("#search-btn").click(function(e) {
                e.preventDefault();
                role_table.draw();

            });

            function deleteData(id) {
                //show confirm dialog
                if (!confirm("Apakah anda yakin untuk menghapus data ini?")) {
                    return false;
                }
                $.ajax({
                    url: "{{ route('user.instruktur.delete') }}/" + id,
                    type: 'DELETE',
                    success: function(result) {

                        $('#tbl-data').DataTable().ajax.reload();
                    }
                });
            }
        </script>
    @endpush
</x-layout.app-admin>
