<x-layout.app-admin title="{!! __('Detail Kursus') !!}">

    <div class="row">
        <div class="col-12">
            @include('components.layout.message-admin')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{!! __('Detail Kursus') !!}</h3>
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
                        <div class="col-md-9 text-right">
                            <a href="{{ route('courses.materi.tambah', $token) }}" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                Tambah {!! __('Materi') !!}
                            </a>
                        </div>
                    </div>
                    <br />

                    <div class="row">
                        <div class="col-12">
                            <table id="tbl-data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Kode') }}</th>
                                        <th>{{ __('Nama Kursus') }}</th>
                                        <th>{{ __('Tanggal Mulai') }}</th>
                                        <th>{{ __('Tanggal Selesai') }}</th>
                                        <th>{{ __('Materi') }}</th>
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
        var role_table = $( '#tbl-data' ).DataTable( {
            processing: true,
            serverSide: true,
            searchable: false,
            searching: false,
            lengthChange: false,
            autoWidth: false,

            ajax: {
                url: "{{ route('courses.get.materi', $token) }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
                },

                data: function ( d ) {

                    d.search = $( '#search-box' ).val();
                }

            },
            columns: [ {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'code',
                    name: 'code',
                    searchable: false,
                }, {
                    data: "title",
                    name: "title",
                    orderable: false,

                }, {
                    data: 'star_date',
                    name: 'star_date',
                    render: function ( data, type, row, meta ) {
                        return moment( data ).format( 'DD MMMM YYYY HH:mm' );
                    }
                }, {
                    data: 'end_date',
                    name: 'end_date',
                    render: function ( data, type, row, meta ) {
                        return moment( data ).format( 'DD MMMM YYYY HH:mm' );
                    }
                }, {
                    data: 'title_materi',
                    name: 'title_materi'
                }, {
                    data: 'status_materi',
                    name: 'status_materi'
                }, {
                    data: 'created_at',
                    name: 'created_at',
                    render: function ( data, type, row, meta ) {
                        return moment( data ).format( 'DD MMMM YYYY HH:mm' );
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
                [ 8, 'desc' ]
            ],
        } );
        $( "#search-btn" ).click( function ( e ) {
            e.preventDefault();
            role_table.draw();

        } );

        function deleteData( id ) {
            //show confirm dialog
            if ( !confirm( "Apakah anda yakin untuk menghapus data ini?" ) ) {
                return false;
            }
            $.ajax( {
                url: "{{ route('courses.materi.delete') }}/" + id,
                type: 'DELETE',
                success: function ( result ) {

                    $( '#tbl-data' ).DataTable().ajax.reload();
                }
            } );
        }

    </script>
    @endpush
</x-layout.app-admin>
