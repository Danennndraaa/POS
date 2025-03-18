<form action="{{ url('/level/ajax/' . $level->level_id) }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-edit-level" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Level</label>
                    <input type="text" name="level_kode" id="edit_level_kode" class="form-control" maxlength="3" required value="{{ $level->level_kode }}">
                    <small id="error-edit_level_kode" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Level</label>
                    <input type="text" name="level_nama" id="edit_level_nama" class="form-control" required value="{{ $level->level_nama }}">
                    <small id="error-edit_level_nama" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#form-edit").validate({
            rules: {
                level_kode: { required: true, maxlength: 3 },
                level_nama: { required: true }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#modal-edit-level').closest('.modal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success
                            });
                            if (typeof dataLevel !== 'undefined') {
                                dataLevel.ajax.reload();
                            }
                        }
                    },
                    error: function (xhr) {
                        $('.error-text').text('');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (prefix, val) {
                                $('#error-edit_' + prefix).text(val[0]);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: 'Terjadi kesalahan pada server'
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
