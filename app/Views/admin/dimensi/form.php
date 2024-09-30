<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_submit">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />

        <div class="row mb-3">
            <div class="col-lg col-xxl-5">
                <div class="row">
                    <input type="hidden" name="id_kategori" value="<?= session()->get('id_kategori') ?>" class="form form-control form-50" size="40" readonly />
                    <div class="col">
                        Sub Dimensi:<br />
                        <input type="text" name="sub_dimensi" value="<?php if (isset($detail['sub_dimensi'])) echo $detail['sub_dimensi']; ?>" class="form form-control form-50" size="40" />
                    </div>
                </div>
            </div>

        </div>
        <span id="report"></span>

        <input type="submit" name="submit" value="<?= $tombol ?>" class="btn btn-primary mt-3" />
    </form>
</div>
<script>
    utils.$document.ready(function() {
        var datetimepicker = $('.datetimepicker');
        datetimepicker.length && datetimepicker.each(function(index, value) {
            var $this = $(value);
            var options = $.extend({
                dateFormat: 'd/m/y',
                disableMobile: true
            }, $this.data('options'));
            $this.flatpickr(options);
        });
    });

    utils.$document.ready(function() {
        var select2 = $('.selectpicker');
        select2.length && select2.each(function(index, value) {
            var $this = $(value);
            var options = $.extend({
                theme: 'bootstrap4'
            }, $this.data('options'));
            $this.select2(options);
        });
    });
    utils.$document.ready(function() {
        $('.custom-file-input').on('change', function(e) {
            var $this = $(e.currentTarget);
            var fileName = $this.val().split('\\').pop();
            $this.next('.custom-file-label').addClass('selected').html(fileName);
        });
    });
    $(document).ready(function() {
        $('#add_submit').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this)[0]; // Get the raw HTML form element
            var formData = new FormData(form); // Create a new FormData object

            // Add any additional data to the FormData object if needed
            // Example: formData.append('key', 'value');

            $.ajax({
                type: 'POST',
                url: "<?= site_url('admin2053/bagian/submitdata') ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData, // Use the FormData object as the data
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    $('#add_submit input[type="text"]').val(''); // Clear text inputs
                    $('#add_submit textarea').val(''); // Clear textareas
                    $('#add').modal('hide'); // Hide the modal
                    showToast("success", response.message);
                    window.location.reload(); // Reload the page after submission
                },
                error: function(xhr, status, error) {
                    var response = xhr.responseJSON;
                    showToastError('Error', response);
                }
            });
        });

        $('#add').on('hidden.bs.modal', function() {
            dataindex(); // Call dataindex() if necessary
            $('#report_edit').html(''); // Clear any previous content
        });
    });
</script>