<form action="" id="form-data">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Klasifikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div id="alertBox"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="klasifikasi_name" id="klasifikasi_name" class="form-control" placeholder=""
                            aria-describedby="helpId">

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

        ajax({
            url: "{{ route('master.klasifikasi.do.create') }}",
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
