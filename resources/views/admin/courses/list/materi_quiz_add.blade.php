<x-layout.app-admin title="{!! __('Tambah Quiz') !!}">

    <div class="row">
        <div class="col-12">
            @include('components.layout.message-admin')
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{!! __('Tambah Quiz') !!}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            @if (!empty($data_quiz_parent->id))
                                <a href="{{ route('courses.materi.quiz.tambah.detail', [$token, $data_quiz_parent->id]) }}"
                                    type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                    Tambah List {!! __('Quiz') !!}
                                </a>
                            @else
                                <a href="{{ route('courses.materi.quiz.tambah.form', $token) }}" type="button"
                                    class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                    Tambah {!! __('Quiz') !!}
                                </a>
                            @endif
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <table id="tbl-data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Pertanyaan') }}</th>
                                        <th>{{ __('Bobot Nilai') }}</th>
                                        <th>{{ __('Waktu Pembuatan') }}</th>
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
                    url: "{{ route('courses.get.quiz.detail', $token) }}",
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
                        data: 'pertanyaan',
                        name: 'pertanyaan',
                        searchable: false,
                    }, {
                        data: "bobot_nilai",
                        name: "bobot_nilai",
                        orderable: false,

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
                    [4, 'desc']
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
                    url: "{{ route('courses.quiz.delete') }}/" + id,
                    type: 'DELETE',
                    success: function(result) {
                        location.reload();
                    }
                });
            }
        </script>
    @endpush
</x-layout.app-admin>
