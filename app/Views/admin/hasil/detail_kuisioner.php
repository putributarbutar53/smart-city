<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->
<div class="card mb-3">
    <div class="card-body">
        <div class="row align-items-center text-center mb-3">
            <div class="col text-sm-right mt-3 mt-sm-0">
                <h5><?= esc($kuisioner['nama']) ?></h5>
                <p class="fs--1 mb-0"><?= esc($kuisioner['email']) ?></p>
            </div>
        </div>
        <div class="card-footer bg-light">
            <p class="fs--1 mb-0"><strong>Notes: </strong>1 = “Tidak Setuju”; 2 = “Kurang Setuju”; 3 = “Setuju”; dan 4 = “Sangat Setuju”; atau 9 bila tidak menjawab</p>
        </div>
        <div class="table-responsive mt-4 fs--1">
            <?php if (!empty($sub_dimensi)): ?>
                <?php foreach ($sub_dimensi as $index => $dimensi): ?>
                    <h6>Sub Dimensi <?= $index + 1 ?>: <?= esc($dimensi['sub_dimensi']) ?></h6>
                    <div class="table-responsive mt-4 fs--1">
                        <table class="table table-bordered table-striped border-bottom">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th class="border-0">Pertanyaan</th>
                                    <th class="border-0 text-center">1</th>
                                    <th class="border-0 text-center">2</th>
                                    <th class="border-0 text-center">3</th>
                                    <th class="border-0 text-center">4</th>
                                    <th class="border-0 text-center">9</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dimensi['pertanyaan'])): ?>
                                    <?php foreach ($dimensi['pertanyaan'] as $pertanyaan): ?>
                                        <tr>
                                            <td class="align-middle">
                                                <p class="mb-0 text-nowrap"><?= esc($pertanyaan['pertanyaan']) ?></p>
                                            </td>
                                            <!-- Cek apakah jawaban adalah option_1 -->
                                            <td class="align-middle text-center">
                                                <?php if ($pertanyaan['jawaban'] === '1'): ?>
                                                    <i class="fas fa-check text-success"></i>
                                                <?php endif; ?>
                                            </td>
                                            <!-- Cek apakah jawaban adalah option_2 -->
                                            <td class="align-middle text-center">
                                                <?php if ($pertanyaan['jawaban'] === '2'): ?>
                                                    <i class="fas fa-check text-success"></i>
                                                <?php endif; ?>
                                            </td>
                                            <!-- Cek apakah jawaban adalah option_3 -->
                                            <td class="align-middle text-center">
                                                <?php if ($pertanyaan['jawaban'] === '3'): ?>
                                                    <i class="fas fa-check text-success"></i>
                                                <?php endif; ?>
                                            </td>
                                            <!-- Cek apakah jawaban adalah option_4 -->
                                            <td class="align-middle text-center">
                                                <?php if ($pertanyaan['jawaban'] === '4'): ?>
                                                    <i class="fas fa-check text-success"></i>
                                                <?php endif; ?>
                                            </td>
                                            <!-- Cek apakah jawaban adalah option_9 -->
                                            <td class="align-middle text-center">
                                                <?php if ($pertanyaan['jawaban'] === '9'): ?>
                                                    <i class="fas fa-check text-success"></i>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada pertanyaan untuk sub dimensi ini.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <label style="font-weight: bold; margin-bottom: 5px;">Sub Dimensi: Tidak ada sub dimensi yang tersedia.</label>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $this->endsection() ?>