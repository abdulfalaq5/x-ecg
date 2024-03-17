<form action="" id="form-data">
    <div class="modal-body">
        <div class="container-fluid">
            <div id="alertBox"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Jenis Quiz</label>
                        <select class="form-control" id="jenis" name="jenis" onchange="cekJenis()">
                            <option value="">Pilih Jenis Quiz</option>
                            <option value="1" {{ $data->jenis == '1' ? 'selected' : '' }}>Isian</option>
                            <option value="2" {{ $data->jenis == '2' ? 'selected' : '' }}>Pilihan Ganda</option>
                            <option value="3" {{ $data->jenis == '3' ? 'selected' : '' }}>Benar atau Salah</option>
                        </select>
                        <input type="hidden" id="materi_id" name="materi_id" value="{{ !empty($data->materi_id) ? $data->materi_id : "" }}">
                        <input type="hidden" id="course_id" name="course_id" value="{{ !empty($data->course_id) ? $data->course_id : "" }}">
                        <input type="hidden" id="bank_quiz_id" name="bank_quiz_id" value="{{ !empty($data->bank_quiz_id) ? $data->bank_quiz_id : "" }}">
                    </div>
                </div>
                <div class="col-md-12 isian">
                    <div class="form-group">
                        <label for="">Pertanyaan</label>
                        <input type="text" name="pertanyaan_1" id="pertanyaan_1" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->pertanyaan) ? $data->pertanyaan : "" }}">
                    </div>
                </div>
                <div class="col-md-12 ganda">
                    <div class="form-group">
                        <label for="">Pertanyaan</label>
                        <input type="text" name="pertanyaan_2" id="pertanyaan_2" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->pertanyaan) ? $data->pertanyaan : "" }}">
                    </div>
                </div>
                <div class="col-md-6 ganda">
                    <div class="form-group">
                        <label for="">Option A</label>
                        <input type="text" name="option_1" id="option_1" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->option_1) ? $data->option_1 : "" }}">
                    </div>
                </div>
                <div class="col-md-6 ganda">
                    <div class="form-group">
                        <label for="">Option B</label>
                        <input type="text" name="option_2" id="option_2" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->option_2) ? $data->option_2 : "" }}">
                    </div>
                </div>
                <div class="col-md-6 ganda">
                    <div class="form-group">
                        <label for="">Option C</label>
                        <input type="text" name="option_3" id="option_3" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->option_3) ? $data->option_3 : "" }}">
                    </div>
                </div>
                <div class="col-md-6 ganda">
                    <div class="form-group">
                        <label for="">Option D</label>
                        <input type="text" name="option_4" id="option_4" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->option_4) ? $data->option_4 : "" }}">
                    </div>
                </div>
                <div class="col-md-12 ganda">
                    <div class="form-group">
                        <label for="">Jawaban</label>
                        <select class="form-control" name="jawaban_2" id="jawaban_2">
                            <option value="">Pilih Jawaban</option>
                            <option value="A" {{ $data->jawaban == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $data->jawaban == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ $data->jawaban == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ $data->jawaban == 'D' ? 'selected' : '' }}>D</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 true_or_false">
                    <div class="form-group">
                        <label for="">Pertanyaan</label>
                        <input type="text" name="pertanyaan_3" id="pertanyaan_3" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->pertanyaan) ? $data->pertanyaan : "" }}">
                    </div>
                </div>
                <div class="col-md-12 true_or_false">
                    <div class="form-group">
                        <label for="">Jawaban</label>
                        <select class="form-control" name="jawaban_3" id="jawaban_3">
                            <option value="">Pilih Jawaban</option>
                            <option value="true" {{ $data->jawaban == 'true' ? 'selected' : '' }}>True</option>
                            <option value="false" {{ $data->jawaban == 'false' ? 'selected' : '' }}>False</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Bobot Nilai</label>
                        <input type="text" name="bobot_nilai" id="bobot_nilai" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ !empty($data->bobot_nilai) ? $data->bobot_nilai : "" }}">
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
    cekJenis();
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
            url: "{{ route('courses.quiz.update', $data->_token) }}",
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
