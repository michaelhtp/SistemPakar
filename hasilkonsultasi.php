<?php
include './setting/koneksi.php';
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Diagnosa</title>
  <link rel="shortcut icon" href="assets/images/padi2.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">
  <link href="./assets/css/style2.css" rel="stylesheet">
  <style>
    .diagnosa {
      margin: 10px;
      max-height: 300px;
      overflow: auto;
      border: 3px solid #a3f0ff;
      padding: 10px;
      text-align: center;
      letter-spacing: 1px;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #f0f0f0;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Hasil Diagnosa Penyakit Tanaman Padi</h2>

    <?php
    if (isset($_POST['bukti']) && isset($_POST['nama_user'])) {
      $nama_user = htmlspecialchars($_POST['nama_user']);
      $gejaladipilih = $_POST['bukti'];

      echo "<div class='mb-4'><h5>Nama Pengguna: <strong>$nama_user</strong></h5></div>";
      echo "<div class='form'><p><b>Gejala yang dipilih:</b></p>";

      $gejala_text = [];
      foreach ($gejaladipilih as $gjlplh) {
        $qry = mysqli_query($mysqli, "SELECT * FROM tb_gejala WHERE id_gejala='$gjlplh'");
        while ($data = mysqli_fetch_array($qry)) {
          echo "{$data['id_gejala']} | {$data['gejala']}<br>";
          $gejala_text[] = $data['id_gejala'];
        }
      }
      echo "</div>";

      // Proses Dempster-Shafer
      $bukti = [];
      foreach ($gejaladipilih as $id) {
        $query = mysqli_query($mysqli, "SELECT GROUP_CONCAT(id_penyakit), 1 FROM tb_rekap WHERE id_gejala='$id'");
        if ($query) {
          $row = mysqli_fetch_row($query);
          if (!empty($row[0])) $bukti[] = $row;
        }
      }

      if (empty($bukti)) {
        echo "<div class='alert alert-warning text-center mt-4'><b>Gejala yang dipilih tidak dapat digunakan untuk diagnosa.</b></div>";
        exit;
      }

      // FOD
      $result = mysqli_query($mysqli, "SELECT GROUP_CONCAT(id_penyakit) FROM tb_penyakit");
      $fod = mysqli_fetch_row($result)[0];

      $densitas_baru = [];
      while (!empty($bukti)) {
        $densitas1[0] = array_shift($bukti);
        $densitas1[1] = [$fod, 1 - $densitas1[0][1]];

        $densitas2 = empty($densitas_baru) ? [array_shift($bukti)] : [];
        foreach ($densitas_baru as $k => $r) {
          if ($k !== "&theta;") $densitas2[] = [$k, $r];
        }

        $theta = 1;
        foreach ($densitas2 as $d) $theta -= $d[1];
        $densitas2[] = [$fod, $theta];

        $densitas_baru = [];
        foreach ($densitas2 as $y => $d2) {
          foreach ($densitas1 as $x => $d1) {
            if (!($y == count($densitas2) - 1 && $x == 1)) {
              $v = explode(',', $d1[0]);
              $w = explode(',', $d2[0]);
              $vw = array_intersect($v, $w);
              $k = empty($vw) ? "&theta;" : implode(',', $vw);
              $densitas_baru[$k] = ($densitas_baru[$k] ?? 0) + $d1[1] * $d2[1];
            }
          }
        }

        foreach ($densitas_baru as $k => $d) {
          if ($k !== "&theta;") {
            $densitas_baru[$k] = $d / (1 - ($densitas_baru["&theta;"] ?? 0));
          }
        }
      }

      unset($densitas_baru["&theta;"]);
      arsort($densitas_baru);

      if (empty($densitas_baru)) {
        echo "<div class='alert alert-danger text-center mt-4'>Tidak ada hasil diagnosa ditemukan.</div>";
        exit;
      }

      // Ambil hasil tertinggi
      $codes = array_keys($densitas_baru);
      $final_codes = explode(',', $codes[0]);
      $penyakit_utama = $final_codes[0];

      // Simpan ke tabel 
      $tanggal = date('Y-m-d H:i:s');
      $gejala_terpilih = implode(',', $gejala_text);

      $insert = mysqli_query($mysqli, "INSERT INTO riwayat_diagnosa (nama_user, tanggal, gejala_terpilih, hasil_diagnosa) 
        VALUES ('$nama_user', '$tanggal', '$gejala_terpilih', '$penyakit_utama')");

      if (!$insert) {
        echo "<div class='alert alert-danger'>Gagal menyimpan ke riwayat: " . $mysqli->error . "</div>";
      }

      // Ambil detail penyakit
      $queryData = mysqli_query($mysqli, "SELECT * FROM tb_penyakit WHERE id_penyakit IN('" . implode("','", $final_codes) . "')");

      echo "<h5 class='text-center mt-5'><b>Detail Penyakit</b></h5>";
      echo "<table class='table'><thead><tr><th>Kode Penyakit</th><th>Nama Penyakit</th><th>Definisi</th><th>Pengobatan</th></tr></thead><tbody>";

      while ($row = mysqli_fetch_array($queryData)) {
        echo "<tr>";
        echo "<td>{$row['id_penyakit']}</td>";
        echo "<td>{$row['nama_penyakit']}</td>";
        echo "<td>{$row['definisi']}</td>";
        echo "<td>{$row['pengobatan']}</td>";
        echo "</tr>";
      }
      echo "</tbody></table>";
    } else {
      echo "<div class='alert alert-danger text-center'>Data tidak lengkap. Silakan ulangi konsultasi.</div>";
    }
    ?>

    <div class="d-flex justify-content-center mt-4">
      <a href="./konsultasi.php" class="btn btn-outline-danger">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Konsultasi
      </a>
    </div>
  </div>
</body>

</html>