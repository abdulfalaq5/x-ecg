<form action="" id="form-data">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Kursus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div id="alertBox"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kode</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder=""
                            aria-describedby="helpId">

                    </div>

                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control kategori_id"></select>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Klasifikasi</label>
                        <select name="klasifikasi_id" id="klasifikasi_id" class="form-control klasifikasi_id"></select>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Instruktur</label>
                        <select name="instruktur" id="instruktur" class="form-control instruktur"></select>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder=""
                            aria-describedby="helpId">

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control status">
                            <option value="">Pilih Status</option>
                            <option value="Published">Published</option>
                            <option value="Unpublished">Unpublished</option>
                        </select>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Live</label>
                        <select name="live" id="live" class="form-control live">
                            <option value="">Pilih Live</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Jam Per minggu</label>
                        <input type="text" name="waktu_per_minggu" id="waktu_per_minggu" class="form-control" placeholder=""
                            aria-describedby="helpId">

                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder=""
                            aria-describedby="helpId">

                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" name="cover" id="cover" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Benefit</label>
                        <textarea name="income" class="form-control" id="income"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="des" class="form-control" id="des_add"></textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
        <div class="spinner-border text-primary" role="status" id="spin" style="display: none">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</form>

<script>
    $('.kategori_id').select2({
        minimumInputLength: 0,
        allowClear: true,
        placeholder: 'Masukkan nama kategori',
        theme: 'bootstrap4',
        ajax: {
            dataType: 'json',
            url: "{{ route('courses.kategori.option') }}",
            delay: 800,
            data: function(params) {
                return {
                    search: params.term
                }
            },
            processResults: function(data, page) {
                return {
                    results: data
                };
            },
        }
    }).on('kategori_id:select', function(evt) {
        var data = $(".kategori_id option:selected").text();
        var value = $(".kategori_id option:selected").val();
        // loadKota('kota_id', value)

    }).on('kategori_id:clear', function(evt) {
        //$('.select2-kota').empty();
    });

    $('.klasifikasi_id').select2({
        minimumInputLength: 0,
        allowClear: true,
        placeholder: 'Masukkan nama kategori',
        theme: 'bootstrap4',
        ajax: {
            dataType: 'json',
            url: "{{ route('courses.klasifikasi.option') }}",
            delay: 800,
            data: function(params) {
                return {
                    search: params.term
                }
            },
            processResults: function(data, page) {
                return {
                    results: data
                };
            },
        }
    }).on('klasifikasi_id:select', function(evt) {
        var data = $(".klasifikasi_id option:selected").text();
        var value = $(".klasifikasi_id option:selected").val();
        // loadKota('kota_id', value)

    }).on('klasifikasi_id:clear', function(evt) {
        // $('.select2-kota').empty();
    });

    $('.instruktur').select2({
        minimumInputLength: 0,
        allowClear: true,
        placeholder: 'Masukkan nama instruktur',
        theme: 'bootstrap4',
        ajax: {
            dataType: 'json',
            url: "{{ route('courses.instruktur.option') }}",
            delay: 800,
            data: function(params) {
                return {
                    search: params.term
                }
            },
            processResults: function(data, page) {
                return {
                    results: data
                };
            },
        }
    }).on('instruktur:select', function(evt) {
        var data = $(".instruktur option:selected").text();
        var value = $(".instruktur option:selected").val();
        // loadKota('kota_id', value)

    }).on('instruktur:clear', function(evt) {
        // $('.select2-kota').empty();
    });

    $('#des_add').summernote({
        height: 200,
    })

    $('input[name="tanggal_lahir"]').daterangepicker({
        autoApply: true,
        singleDatePicker: true,
        showDropdowns: true,
        maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            format: 'DD/MM/YYYY',
            cancelLabel: 'Clear'
        }
    });

    $("#form-data").submit(function(e) {
        e.preventDefault();
        let postData = new FormData();
        $.each($('#form-data :input').serializeObject(), function(x, y) {
            postData.append(x, y);
        });

        if ($('#cover')[0].files[0]) {
            postData.append('cover', $('#cover')[0].files[0]);

        } else {
            postData.append('cover', 'undifined');
        }

        ajax({
            url: "{{ route('courses.list.do.create') }}",
            postData: postData,
            processData: false,
            contentType: false,
            alert: false,
            beforeSend: function() {
                $("#submit").attr('style', "display:none");
                $("#spin").attr('style', "display:block");
            },
            success: function(response) {
                alert(response.msg);
                $("#myModal").modal("hide");
                $('#tbl-data').DataTable().ajax.reload();
            },
            error: function(err) {
                loadAlert(err.msg, true);
                loadAlert(err.message, true);
                $("#submit").attr('style', "display:block");
                $("#spin").attr('style', "display:none");
            },
            failure: function(err) {
                loadAlert(err.msg, true);
            }
        });
    });
</script>
