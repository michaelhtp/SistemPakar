<?php
include "../setting/koneksi.php";

// Cek jika ada permintaan hapus
if (isset($_GET['hapus']) && isset($_GET['id'])) {
  $id_hapus = $_GET['id'];
  $hapus = $mysqli->query("DELETE FROM riwayat_diagnosa WHERE id = '$id_hapus'");
  if ($hapus) {
    echo "<script>alert('Data berhasil dihapus'); window.location='./rekap.php';</script>";
    exit;
  } else {
    echo "<script>alert('Gagal menghapus data');</script>";
  }
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Riwayat Konsultasi</h1>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">List Data</h3>
        </div>

        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Gejala Terpilih</th>
                <th>Penyakit Terdiagnosa</th>
                <th>Definisi</th>
                <th>Pengobatan</th>
                <th>Tanggal Konsultasi</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              $query = "SELECT * FROM riwayat_diagnosa ORDER BY tanggal DESC";
              $result = $mysqli->query($query);

              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_user']) . "</td>";

                // Gejala Terpilih
                echo "<td>";
                $gejala_ids = explode(",", $row['gejala_terpilih']);
                foreach ($gejala_ids as $gid) {
                  $gid = trim($gid);
                  if (!empty($gid)) {
                    $gq = $mysqli->query("SELECT id_gejala, gejala FROM tb_gejala WHERE id_gejala = '$gid'");
                    if ($gq && $g = $gq->fetch_assoc()) {
                      echo $g['id_gejala'] . " - " . $g['gejala'] . "<br>";
                    }
                  }
                }
                echo "</td>";

                // Penyakit & Detail
                $kode_penyakit = $row['hasil_diagnosa'];
                $pq = $mysqli->query("SELECT * FROM tb_penyakit WHERE id_penyakit = '$kode_penyakit'");
                if ($pq && $p = $pq->fetch_assoc()) {
                  echo "<td>$kode_penyakit - {$p['nama_penyakit']}</td>";
                  echo "<td>{$p['definisi']}</td>";
                  echo "<td>{$p['pengobatan']}</td>";
                } else {
                  echo "<td colspan='3'>$kode_penyakit - (tidak ditemukan)</td>";
                }

                echo "<td>" . $row['tanggal'] . "</td>";

                // Tombol Hapus
                echo "<td><a href=../rekap.php={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">
                  <i class='fa fa-trash'></i> Hapus
                </a></td>";

                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>