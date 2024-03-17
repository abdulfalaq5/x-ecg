<form action="" id="form-data">
    <div class="modal-body">
        <div class="container-fluid">
            <div id="alertBox"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title_materi" id="title_materi" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <input type="hidden" name="course_id" id="course_id" class="form-control" placeholder="" value="{{ $data->id }}"
                            aria-describedby="helpId">

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="status_materi" id="status_materi">
                            <option value="">Pilih Status</option>
                            <option value="Publish">Publish</option>
                            <option value="UnPublish">UnPublish</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Mulai</label>
                        <input type="date" name="star_date" id="star_date" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Dokumen</label>
                        <input type="file" name="file_materi" id="file_materi" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="des_materi" class="form-control" id="des_add"></textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
            data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
        <div class="spinner-border text-primary" role="status" id="spin" style="display: none">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</form>
<script>
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

        if ($('#file_materi')[0].files[0]) {
            postData.append('file_materi', $('#file_materi')[0].files[0]);

        } else {
            postData.append('file_materi', 'undifined');
        }

        ajax({
            url: "{{ route('courses.materi.do.create') }}",
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
                location.reload();
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
