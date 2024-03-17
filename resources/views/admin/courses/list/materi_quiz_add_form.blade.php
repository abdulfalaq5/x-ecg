<form action="" id="form-data">
    <div class="modal-body">
        <div class="container-fluid">
            <div id="alertBox"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title_quiz" id="title_quiz" class="form-control" placeholder=""
                            aria-describedby="helpId">
                        <input type="hidden" id="materi_id" name="materi_id" value="{{ $data->id }}">
                        <input type="hidden" id="course_id" name="course_id" value="{{ $data->course_id }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Waktu Mulai Quiz</label>
                        <input type="date" name="waktu_quiz" id="waktu_quiz" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Waktu Akhir Quiz</label>
                        <input type="date" name="waktu_akhir_quiz" id="waktu_akhir_quiz" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea name="des_quiz" class="form-control" id="des_add"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="{{ route('courses.list.view', $token) }}" type="button" class="btn btn-secondary"
            data-dismiss="modal">Kembali</a>
        <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
        <div class="spinner-border text-primary" role="status" id="spin" style="display: none">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</form>
<script>
    $(".isian").show();
    $(".ganda").hide();
    $(".true_or_false").hide();

    $('#des_add').summernote({
        height: 200,
    })

    function cekJenis() {
        var jenis = $("#jenis").val();
        if (jenis == 1) {
            $(".isian").show();
            $(".ganda").hide();
            $(".true_or_false").hide();
        } else if (jenis == 2) {
            $(".isian").hide();
            $(".ganda").show();
            $(".true_or_false").hide();
        } else if (jenis == 3) {
            $(".isian").hide();
            $(".ganda").hide();
            $(".true_or_false").show();
        }
    }

    $("#form-data").submit(function(e) {
        e.preventDefault();
        let postData = new FormData();
        $.each($('#form-data :input').serializeObject(), function(x, y) {
            postData.append(x, y);
        });

        ajax({
            url: "{{ route('courses.materi.quiz.do.create') }}",
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
