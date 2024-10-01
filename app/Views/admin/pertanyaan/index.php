<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->

<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>/assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">Pertanyaan</h3>

            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col">
                <button class="btn btn-primary" onclick="adddata()"><i class="fas fa-plus-square"></i> Tambah Pertanyaan</button>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="row list">
            <div class="col">
                <table id="table_index" width="100%" class="table mb-0 table-striped table-dashboard border-bottom border-200">
                    <thead class="bg-200">
                        <tr>
                            <th><b>No.</b></th>
                            <th><b>Pertanyaan</b></th>
                            <th data-orderable="false"><b>#</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pertanyaan)): ?>
                            <?php foreach ($pertanyaan as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <?= $item['pertanyaan'] ?>

                                    </td>
                                    <td>
                                        <button onclick="editdata(<?= $item['id'] ?>)" class="btn btn-primary btn-sm">Edit</button>
                                        <button onclick="deletedata(<?= $item['id'] ?>)" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Tidak ada data yang tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>

<script>
    $(document).ready(function() {
        // Mengatur DataTable dan melakukan penyesuaian kolom
        const dataTable = $('#table_index').DataTable().columns.adjust();

        // Timeout yang tidak melakukan apa-apa bisa dihapus atau disesuaikan
        setTimeout(function() {}, 100);
    });

    // Fungsi untuk menghapus data
    function deletedata(iddata) {
        $('#alert_modal').modal('show');

        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2053/pertanyaan/delete') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide');
                    showToast('success', response.message);
                    // Refresh DataTable
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    // Fungsi untuk mengedit data
    function editdata(iddata) {
        $.get("<?= site_url('admin2053/pertanyaan/edit') ?>/" + iddata, function(data) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    // Fungsi untuk menambahkan data
    function adddata(id_kategori) {
        $('#editor_add').load('<?= site_url('admin2053/pertanyaan/add/') ?>' + id_kategori, function() {
            $('#add').modal('show');
        });
    }

    // Setelah data berhasil ditambahkan atau diedit, refresh DataTable
    function afterDataChange() {
        dataTable.ajax.reload(); // Refresh DataTable
    }
</script>
<?php $this->endsection() ?>