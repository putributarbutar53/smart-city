 <?php $this->extend('web/layout/main') ?>

 <?php $this->section('content') ?>
 <div class="tp-hero-area p-relative">
     <img class="tp-hero-bus-shape d-none d-xxl-block up-down p-absolute" src="<?= base_url() ?>asset/img/banner/bus/shaep1.png" alt="shape">
     <img class="tp-hero-bus-shape-2 up-down p-absolute" src="<?= base_url() ?>asset/img/banner/bus/shape3.png" alt="shape">
     <img class="tp-hero-bus-shape-6 up-down d-none d-lg-block p-absolute" src="<?= base_url() ?>asset/img/banner/bus/shape6.png" alt="shape">
     <img class="tp-hero-bus-shape-7 tree-move p-absolute" src="<?= base_url() ?>asset/img/banner/bus/shape7.png" alt="shape">
     <div class="container">
         <div class="row">
             <div class="row">
                 <p style="margin-top: 10px;"> <!-- Ganti 20px dengan nilai yang diinginkan -->
                     <a href="<?= base_url() ?>" class="btn" style="margin-left: -10px;"> <!-- Ganti -10px dengan nilai yang diinginkan -->
                         <i class="fas fa-arrow-left"></i> Kembali
                     </a>
                 </p>

                 <div class="col-lg-12">
                     <div class="tp-contact-form-2">

                         <h6 class="tp-contact-form-title-2 mb-40 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s" style="margin-top: -20px;">Kuesioner Evaluasi Implementasi Smart City</h6>

                         <p style="margin-top: -20px;"><?= esc($kategori['nama']) ?></p>
                         <form id="form-kuisioner" method="POST" class="wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">
                             <div class="row" id="data-diri">
                                 <div class="col-lg-12 mb-20">
                                     <label style="font-weight: bold; margin-bottom: 5px;">Nama : </label>
                                     <div class="tp-contact-single-input">
                                         <input type="text" name="nama" placeholder="Masukkan Nama Anda" style="height: 40px;">
                                     </div>
                                 </div>
                                 <div class="col-lg-12 mb-20">
                                     <label style="font-weight: bold; margin-bottom: 5px;">Email : </label>
                                     <div class="tp-contact-single-input">
                                         <input type="text" name="email" placeholder="Masukkan Email Anda" style="height: 40px;">
                                     </div>
                                 </div>

                                 <!-- Jenis Kelamin -->
                                 <div class="col-lg-12 mb-20">
                                     <div class="tp-contact-single-input" style="display: flex; align-items: center;">
                                         <label for="jenis_kelamin" style="font-weight: bold; margin-right: 10px;">Jenis Kelamin:</label>
                                         <div style="margin-right: 20px; display: flex; align-items: center;">
                                             <input type="radio" id="laki-laki" name="jenis_kelamin" value="L" style="margin-top: 5px;">
                                             <label for="laki-laki" style="margin-left: 5px; margin-top: 5px;">Laki-laki</label>
                                         </div>
                                         <div style="display: flex; align-items: center;">
                                             <input type="radio" id="perempuan" name="jenis_kelamin" value="P" style="margin-top: 5px;">
                                             <label for="perempuan" style="margin-left: 5px; margin-top: 5px;">Perempuan</label>
                                         </div>
                                     </div>
                                 </div>

                                 <input type="hidden" name="id_kategori" value="<?= esc($kategori['id']) ?>">

                                 <!-- Umur -->
                                 <div class="col-lg-12 mb-20">
                                     <label style="font-weight: bold; margin-bottom: 5px;">Umur : </label>
                                     <div class="tp-contact-single-input">
                                         <input type="number" name="umur" placeholder="Masukkan Umur Anda" style="height: 40px;">
                                     </div>
                                 </div>

                                 <!-- Pekerjaan -->
                                 <div class="col-lg-12 mb-20">
                                     <label style="font-weight: bold; margin-bottom: 5px;">Pekerjaan : </label>
                                     <div class="tp-contact-single-input">
                                         <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" style="height: 40px;">
                                     </div>
                                 </div>

                                 <!-- Pilih Layanan/Program -->
                                 <div class="col-lg-12 mb-20">
                                     <div class="tp-contact-single-input">
                                         <label style="font-weight: bold; margin-bottom: 5px;">Pilih Layanan/Program:</label>
                                         <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                             <?php if (!empty($layanan)): ?>
                                                 <?php foreach ($layanan as $item): ?>
                                                     <label style="display: flex; align-items: center;">
                                                         <input type="checkbox" name="nama_layanan[]" value="<?= $item['n_layanan']; ?>" style="margin-right: 5px;"> <?= $item['n_layanan']; ?>
                                                     </label>
                                                 <?php endforeach; ?>
                                             <?php else: ?>
                                                 <p>Tidak ada layanan yang tersedia untuk kategori ini.</p>
                                             <?php endif; ?>
                                             <label style="display: flex; align-items: center;">
                                                 <input type="checkbox" style="margin-right: 5px;" id="lainnya-checkbox"> Lainnya
                                             </label>
                                             <input type="text" id="nama_layanan_lain" placeholder="Sebutkan Layanan Lainnya" style="height: 40px; display: none; width: 100%;">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- Sasaran Layanan/Program -->
                                 <div class="col-lg-12 mb-20">
                                     <div class="tp-contact-single-input">
                                         <label style="font-weight: bold; margin-bottom: 5px;">Pilih Sasaran Layanan/Program:</label>
                                         <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                             <?php if (!empty($sasaran)): ?>
                                                 <?php foreach ($sasaran as $item): ?>
                                                     <label style="display: flex; align-items: center;">
                                                         <input type="checkbox" name="sasaran_layanan[]" value="<?= $item['n_sasaran']; ?>" style="margin-right: 5px;"> <?= $item['n_sasaran']; ?>
                                                     </label>
                                                 <?php endforeach; ?>
                                             <?php else: ?>
                                                 <p>Tidak ada sasaran yang tersedia untuk kategori ini.</p>
                                             <?php endif; ?>
                                             <label style="display: flex; align-items: center;">
                                                 <input type="checkbox" style="margin-right: 5px;" id="sasaran-lainnya-checkbox"> Lainnya
                                             </label>
                                             <input type="text" id="sasaran_lain" placeholder="Sebutkan Sasaran Lainnya" style="height: 40px; display: none; width: 100%;">
                                         </div>
                                     </div>
                                 </div>

                                 <!-- Selfie -->
                                 <div class="col-lg-12 mb-20">
                                     <label style="font-weight: bold; margin-bottom: 5px;">Ambil Selfie: </label>
                                     <video id="video" width="100%" height="350px" style="border: 1px solid black;"></video>
                                     <button type="button" id="take-selfie" class="tp-btn" style="margin-top: 10px;">Ambil Selfie</button>
                                     <canvas id="selfie-canvas" style="display:none;"></canvas>
                                     <input type="hidden" name="selfie_data" id="selfie_data">
                                     <div id="selfie-preview" style="margin-top: 10px; text-align: center;">
                                         <label style="font-weight: bold;">Preview Selfie:</label>
                                         <img id="selfie-image" style="display: none; max-width: 100%; height: auto; border: 1px solid black; margin-top: 5px; display: block; margin-left: auto; margin-right: auto;">
                                     </div>
                                 </div>

                                 <!-- Tanda Tangan -->
                                 <div class="col-lg-12 mb-20">
                                     <label style="font-weight: bold; margin-bottom: 5px;">Tanda Tangan: </label>
                                     <br>
                                     <div style="display: flex; align-items: center;">
                                         <canvas id="signature-canvas" width="300" height="110" style="border: 1px solid #000;"></canvas>
                                         <span id="clear-signature" style="cursor: pointer; margin-left: 10px;">
                                             <i class="fas fa-trash" style="font-size: 18px; color: #cc0a0a;"></i>
                                         </span>
                                     </div>
                                     <input type="hidden" name="signature_data" id="signature_data">
                                 </div>

                                 <!-- Button -->
                                 <div class="col-lg-12 mb-20">
                                     <div class="tp-contact-btn-2">
                                         <button type="button" id="btn-selanjutnya" class="tp-btn">Selanjutnya</button>
                                         <p class="ajax-response"></p>
                                     </div>
                                 </div>
                             </div>

                             <div id="kuisioner" class="hidden">
                                 <p>Kuesioner ini mengukur persepsi Anda sebagai masyarakat terhadap implementasi program smart city yang dilaksanakan oleh Pemerintah Daerah. Silakan klik angka dengan skala nilai yang sesuai. (1 = “Tidak Setuju”; 2 = “Kurang Setuju”; 3 = “Setuju”; dan 4 = “Sangat Setuju”; atau 9 bila tidak menjawab)</p>
                                 <?php
                                    $roman_numbers = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X']; // Tambah lebih banyak jika diperlukan
                                    ?>

                                 <?php if (!empty($sub_dimensi)): ?>
                                     <?php foreach ($sub_dimensi as $index => $dimensi): ?>
                                         <label style="font-weight: bold; margin-bottom: 8px;">
                                             Sub Dimensi <?= isset($roman_numbers[$index]) ? esc($roman_numbers[$index]) : ($index + 1) ?>: <?= esc($dimensi['sub_dimensi']) ?>
                                         </label>
                                         <br>
                                         <input type="hidden" name="id_subdimensi[]" value="<?= esc($dimensi['id']) ?>">

                                         <!-- Looping pertanyaan untuk sub dimensi ini -->
                                         <?php if (!empty($dimensi['pertanyaan'])): ?>
                                             <?php $nomor = 1; // Inisialisasi nomor urut pertanyaan 
                                                ?>
                                             <?php foreach ($dimensi['pertanyaan'] as $pertanyaan): ?>
                                                 <div class="col-lg-12 mb-20">
                                                     <!-- Tampilkan nomor urut pertanyaan -->
                                                     <label style="margin-bottom: 2px;">
                                                         <?= $nomor++ ?>. <?= esc($pertanyaan['pertanyaan']) ?>
                                                     </label>
                                                     <div class="tp-contact-single-input" style="display: flex; align-items: center; margin-top: -19px;">
                                                         <?php for ($i = 1; $i <= 4; $i++): ?>
                                                             <div style="margin-right: 20px; display: flex; align-items: center;">
                                                                 <input type="radio" id="pertanyaan_<?= esc($pertanyaan['id']) ?>_<?= $i ?>" name="pertanyaan_<?= esc($pertanyaan['id']) ?>" value="option_<?= $i ?>" style="margin-top: 5px;">
                                                                 <label for="pertanyaan_<?= esc($pertanyaan['id']) ?>_<?= $i ?>" style="margin-left: 5px;"><?= esc($pertanyaan['option_' . $i]) ?></label>
                                                             </div>
                                                         <?php endfor; ?>
                                                         <!-- Tambahan untuk option_9 jika diperlukan -->
                                                         <div style="display: flex; align-items: center;">
                                                             <input type="radio" id="pertanyaan_<?= esc($pertanyaan['id']) ?>_9" name="pertanyaan_<?= esc($pertanyaan['id']) ?>" value="option_9" style="margin-top: 5px;">
                                                             <label for="pertanyaan_<?= esc($pertanyaan['id']) ?>_9" style="margin-left: 5px;"><?= esc($pertanyaan['option_9']) ?></label>
                                                         </div>
                                                     </div>
                                                 </div>
                                             <?php endforeach; ?>
                                         <?php else: ?>
                                             <div style="margin-left: 20px;">
                                                 <p>Tidak ada pertanyaan untuk sub dimensi ini.</p>
                                             </div>
                                         <?php endif; ?>
                                     <?php endforeach; ?>
                                 <?php else: ?>
                                     <label style="font-weight: bold; margin-bottom: 5px;">Sub Dimensi: Tidak ada sub dimensi yang tersedia.</label>
                                 <?php endif; ?>

                                 <div class="col-lg-12 mb-20">
                                     <div class="tp-contact-btn-2">
                                         <button type="button" id="btn-kembali" class="tp-btn">Kembali</button>
                                         <button type="submit" class="tp-btn">Kirim</button>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <?php $this->endsection() ?>
 <?php $this->section('script') ?>
 <script>
     const canvas = document.getElementById('signature-canvas');
     const context = canvas.getContext('2d');
     let isDrawing = false;

     function setCanvasBackground() {
         context.fillStyle = "white";
         context.fillRect(0, 0, canvas.width, canvas.height);
     }
     setCanvasBackground();

     canvas.addEventListener('mousedown', (event) => {
         isDrawing = true;
         context.beginPath();
         context.moveTo(event.offsetX, event.offsetY);
     });

     canvas.addEventListener('mousemove', (event) => {
         if (isDrawing) {
             context.lineTo(event.offsetX, event.offsetY);
             context.strokeStyle = "black";
             context.lineWidth = 2;
             context.stroke();
         }
     });

     canvas.addEventListener('mouseup', () => {
         isDrawing = false;
         // Simpan data tanda tangan ke input hidden
         document.getElementById('signature_data').value = canvas.toDataURL('image/png');
     });

     canvas.addEventListener('mouseleave', () => {
         isDrawing = false;
     });

     // Event listener untuk tombol Bersihkan Tanda Tangan
     document.getElementById('clear-signature').addEventListener('click', (e) => {
         e.preventDefault();
         context.clearRect(0, 0, canvas.width, canvas.height);
         setCanvasBackground();
         document.getElementById('signature_data').value = ''; // Kosongkan data tanda tangan
     });
 </script>
 <script>
     // Mengakses webcam dan menampilkan aliran video
     const video = document.getElementById('video');
     const selfieCanvas = document.getElementById('selfie-canvas');
     const selfieImage = document.getElementById('selfie-image');
     const selfieData = document.getElementById('selfie_data');

     navigator.mediaDevices.getUserMedia({
             video: true
         })
         .then((stream) => {
             video.srcObject = stream;
             video.play();
         })
         .catch((error) => {
             console.error("Error accessing webcam: ", error);
         });

     // Mengambil selfie saat tombol diklik
     document.getElementById('take-selfie').onclick = function() {
         // Set ukuran canvas sesuai ukuran video
         selfieCanvas.width = video.videoWidth;
         selfieCanvas.height = video.videoHeight;

         // Menggambar gambar dari video ke canvas
         const context = selfieCanvas.getContext('2d');
         context.drawImage(video, 0, 0, selfieCanvas.width, selfieCanvas.height);

         // Mengambil data URL dari canvas dan menyimpannya di input tersembunyi
         const dataURL = selfieCanvas.toDataURL('image/png');
         selfieData.value = dataURL;

         // Menampilkan hasil selfie
         selfieImage.src = dataURL;
         selfieImage.style.display = 'block';
     };
 </script>
 <script>
     const lainnyaCheckbox = document.getElementById('lainnya-checkbox');
     const namaLayananLain = document.getElementById('nama_layanan_lain');

     const sasaranLainnyaCheckbox = document.getElementById('sasaran-lainnya-checkbox');
     const sasaranLain = document.getElementById('sasaran_lain');
     const sasaranLayanan = document.getElementById('sasaran_layanan');

     lainnyaCheckbox.addEventListener('change', function() {
         if (lainnyaCheckbox.checked) {
             namaLayananLain.style.display = 'block';
         } else {
             namaLayananLain.style.display = 'none';
             namaLayananLain.value = '';
         }
     });

     sasaranLainnyaCheckbox.addEventListener('change', function() {
         if (sasaranLainnyaCheckbox.checked) {
             sasaranLain.style.display = 'block';
         } else {
             sasaranLain.style.display = 'none';
             sasaranLain.value = '';
         }
     });

     document.querySelector('form').addEventListener('submit', function(event) {

         if (lainnyaCheckbox.checked && namaLayananLain.value.trim() !== "") {
             const hiddenInputLayanan = document.createElement('input');
             hiddenInputLayanan.type = 'hidden';
             hiddenInputLayanan.name = 'nama_layanan[]';
             hiddenInputLayanan.value = namaLayananLain.value.trim();
             this.appendChild(hiddenInputLayanan);
         }

         if (sasaranLainnyaCheckbox.checked && sasaranLain.value.trim() !== "") {
             const hiddenInputSasaran = document.createElement('input');
             hiddenInputSasaran.type = 'hidden';
             hiddenInputSasaran.name = 'sasaran_layanan[]';
             hiddenInputSasaran.value = sasaranLain.value.trim();
             this.appendChild(hiddenInputSasaran);
         }
     });
 </script>
 <script>
     document.getElementById('btn-selanjutnya').addEventListener('click', function() {
         document.getElementById('data-diri').classList.add('hidden');
         document.getElementById('kuisioner').classList.remove('hidden');
     });

     document.getElementById('btn-kembali').addEventListener('click', function() {
         document.getElementById('kuisioner').classList.add('hidden');
         document.getElementById('data-diri').classList.remove('hidden');
     });

     document.getElementById('form-kuisioner').addEventListener('submit', function(e) {
         e.preventDefault();
         // Ambil data dari form
         const formData = new FormData(this);

         // Kirim data ke server di sini (gunakan fetch atau XMLHttpRequest)
         fetch('<?= site_url('form/submit') ?>', {
                 method: 'POST',
                 body: formData
             })
             .then(response => response.json())
             .then(data => {
                 // Gunakan SweetAlert2 untuk menampilkan pesan sukses
                 Swal.fire({
                     title: 'Berhasil!',
                     text: 'Kuisioner telah dikirim!',
                     icon: 'success',
                     confirmButtonText: 'Ok'
                 }).then(() => {
                     location.reload();
                 });
             })
             .catch(error => {
                 console.error('Error:', error);
                 // Gunakan SweetAlert2 untuk menampilkan pesan kesalahan
                 Swal.fire({
                     title: 'Terjadi Kesalahan!',
                     text: 'Kesalahan saat mengirim data.',
                     icon: 'error',
                     confirmButtonText: 'Ok'
                 });
             });
     });
 </script>
 <?php $this->endsection() ?>