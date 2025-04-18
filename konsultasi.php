<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tanaman</title>
  <link rel="shortcut icon" href="assets/images/padi2.png">

  <!-- Favicons -->
  <link href="./assets/img/favicon.png" rel="icon">
  <link href="./assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="./assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="./assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="./assets/css/style2.css" rel="stylesheet">

  <style>
    .gejala {
      color: blue;
      padding: 5px;
      display: flex;
      justify-content: center;
    }
  </style>
</head>

<body>
  <?php
  include './setting/koneksi.php';
  session_start();
  ?>

  <section>
    <div class="card mt-4 col-md-7 mx-auto">
      <div class="mt-4">
        <a href="./index.php" type="button" class="btn btn-outline-danger btn-sm ms-3"><i class="bi bi-box-arrow-left"></i> Konsultasi Selesai</a>
      </div>
      <h4 class="text-dark d-flex justify-content-center mt-4">Proses Diagnosa Penyakit Tanaman Padi</h4>

      <div class="card-body">
        <div class="bg-info rounded-1">
          <h3 class="mt-4 ms-2 p-1">Petunjuk Pengisian</h3>
          <p class="ms-3 me-2 pb-2">Proses konsultasi terdiri dari beberapa pertanyaan. Anda diminta menjawab dengan klik opsi gejala apabila gejala tersebut sesuai dengan kondisi tanaman Anda. Bacalah dan jawab setiap gejala dengan teliti dan seksama.</p>
        </div>

        <h5 class="text-secondary text-center mt-4">Identitas & Pilih Gejala</h5>

        <form action="./hasilkonsultasi.php" method="POST">
          <!-- Input Nama -->
          <div class="form-group mb-4">
            <label for="nama_user" class="form-label"><strong>Nama Anda:</strong></label>
            <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Masukkan nama Anda" required>
          </div>

          <?php
          $koneksi = mysqli_connect("localhost", "root", "", "db_pakar");

          if (mysqli_connect_errno()) {
            echo "Koneksi database gagal: " . mysqli_connect_error();
            exit;
          }

          $sqli = "SELECT * FROM tb_gejala ORDER BY id_gejala ASC";
          $result = $koneksi->query($sqli);

          while ($row = $result->fetch_object()) {
            echo "<hr>";
            echo "<label for='checkbox" . $row->id_gejala . "' style='cursor: pointer;'>";
            echo "<input style='cursor: pointer; width:20px;height:20px;' type='checkbox' id='checkbox" . $row->id_gejala . "' name='bukti[]' value='" . $row->id_gejala . "'>";
            echo "&ensp; " . $row->id_gejala . " | " . $row->gejala . "</label><br>";
          }
          ?>

          <div class="mt-4">
            <button type="reset" class="btn btn-outline-danger btn-md mr-2"> <i class="bi bi-x"></i> Reset</button>
            <button class="btn btn-outline-success btn-md" onclick="return validateForm();"> <i class="bi bi-check-lg"></i> Diagnosa</button>
          </div>
        </form>

        <script>
          function validateForm() {
            var nama = document.getElementById("nama_user").value.trim();
            if (nama === "") {
              alert("Nama tidak boleh kosong.");
              return false;
            }

            var boxes = document.getElementsByName("bukti[]");
            var checkboxesChecked = 0;
            for (var i = 0; i < boxes.length; i++) {
              if (boxes[i].checked) {
                checkboxesChecked++;
              }
            }

            if (checkboxesChecked < 2) {
              alert("Maaf, Anda harus memilih minimal 2 gejala");
              return false;
            }

            return true;
          }
        </script>

      </div>
    </div>
  </section>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main2.js"></script>
</body>

</html>
