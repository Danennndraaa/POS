<form action="{{ url('/supplier/ajax/' . $supplier->supplier_id) }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')

    <!-- Modal -->
    <div class="modal fade" id="modal-edit-supplier" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Supplier</label>
                        <input type="text" name="supplier_kode" id="edit_supplier_kode" class="form-control"
                            maxlength="10" required value="{{ $supplier->supplier_kode }}">
                        <small id="error-edit_supplier_kode" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" name="supplier_nama" id="edit_supplier_nama" class="form-control" required
                            value="{{ $supplier->supplier_nama }}">
                        <small id="error-edit_supplier_nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Alamat Supplier</label>
                        <textarea name="supplier_alamat" id="edit_supplier_alamat" class="form-control" rows="3"
                            required>{{ $supplier->supplier_alamat }}</textarea>
                        <small id="error-edit_supplier_alamat" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#modal-edit-supplier').modal('show');

        $('#modal-edit-supplier').on('hidden.bs.modal', function () {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });

        $("#form-edit").validate({
            rules: {
                supplier_kode: { required: true, maxlength: 10 },
                supplier_nama: { required: true },
                supplier_alamat: { required: true }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status) {
                            $('#modal-edit-supplier').modal('hide');

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });

                            if (typeof dataSupplier !== 'undefined') {
                                dataSupplier.ajax.reload(); // Reload DataTable jika ada
                            }
                        }
                    },
                    error: function (xhr) {
                        $('.error-text').text('');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.msgField;
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