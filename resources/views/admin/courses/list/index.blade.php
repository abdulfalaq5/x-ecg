<x-layout.app-admin title="{!! __('Kursus') !!}">

    <div class="row">
        <div class="col-12">
            @include('components.layout.message-admin')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{!! __('Kursus') !!}</h3>
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
                            <a href="{{ route('courses.list.create') }}" type="button" class="btn btn-success"
                                data-toggle="modal" data-target="#myModal">
                                Tambah {!! __('Kursus') !!}
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
                                        <th>{{ __('Harga') }}</th>
                                        <th>{{ __('Kategori') }}</th>
                                        <th>{{ __('Klasifikasi') }}</th>
                                        <th>{{ __('Peserta') }}</th>
                                        <th>{{ __('Live') }}</th>
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
                url: "{{ route('courses.get.list') }}",
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
                    data: "harga",
                    name: "harga",
                    orderable: false,

                }, {
                    data: 'kategori_name',
                    name: 'kategori_name'
                }, {
                    data: 'klasifikasi_name',
                    name: 'klasifikasi_name'
                }, {
                    data: 'peserta',
                    name: 'peserta'
                }, {
                    data: 'live',
                    name: 'live'
                }, {
                    data: 'status',
                    name: 'status'
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
                [ 5, 'desc' ]
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
                url: "{{ route('courses.list.delete') }}/" + id,
                type: 'DELETE',
                success: function ( result ) {

                    $( '#tbl-data' ).DataTable().ajax.reload();
                }
            } );
        }

    </script>
    @endpush
</x-layout.app-admin>
