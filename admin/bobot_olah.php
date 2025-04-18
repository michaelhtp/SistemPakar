<?php
if (isset($_GET['id'])) {
  $kode = $_GET['id'];
  $data_penyakit = ArrayData($mysqli, "tb_penyakit", "id_penyakit='$kode'");

  if ($data_penyakit) {
    extract($data_penyakit); // hanya dijalankan jika $data_penyakit bukan null
  } else {
    echo "<script>alert('Data penyakit tidak ditemukan di database!'); window.location='index.php?hal=bobot';</script>";
    exit;
  }
} else {
  echo "<script>alert('ID penyakit tidak tersedia!'); window.location='index.php?hal=bobot';</script>";
  exit;
}
?>



<!-- Main content -->
<section class="content" style="margin-top: 10px;">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Data Penyakit</h3>
          </div>

          <!-- form start -->
          <form role="form" id="quickForm" action="bobot_proses.php" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-3">Kode Penyakit</label>
                <input type="text" name="id_penyakit" class="form-control col-sm-7" value="<?=$id_penyakit?>" readonly>
              </div>

              <div class="form-group row">
                <label class="col-sm-3">Nama Penyakit</label>
                <input type="text" name="nama_penyakit" class="form-control col-sm-7" value="<?=$nama_penyakit?>" readonly>
              </div>

              <div class="form-group row">
                <label class="col-sm-3">Gejala</label>
                <select class="form-control select2 col-sm-7" name="id_gejala[]" multiple="multiple" id="id_gejala">
                <?php
                  $query = "SELECT * FROM tb_gejala WHERE id_gejala NOT IN (
                            SELECT id_gejala FROM tb_rekap WHERE id_penyakit='$id_penyakit')";
                  echo "<pre>DEBUG QUERY: $query</pre>";

                  $result = $mysqli->query($query);
                  echo "<pre>JUMLAH DATA GEJALA: {$result->num_rows}</pre>";

                  if ($result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                      echo '<option value="'.$data['id_gejala'].'">'.$data['id_gejala'].' - '.$data['gejala'].'</option>';
                    }
                  } else {
                     echo '<option value="">Tidak ada gejala yang tersedia</option>';
                   }
                ?>

                </select>
              </div>
            </div>

            <div class="card-footer">
              <input type="submit" name="tambah" class="btn btn-primary" value="Simpan">
              <a href="?hal=bobot" class="btn btn-default">Batal</a>
            </div>
          </form>
        </div>
      </div>

      <!-- Data Gejala Terkait -->
      <div class="col-12 mt-3">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Gejala Penyakit</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Penyakit</th>
                  <th>Nama Penyakit</th>
                  <th>Kode Gejala</th>
                  <th>Nama Gejala</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "SELECT 
                              r.id_rekap,
                              r.id_penyakit,
                              p.nama_penyakit,
                              g.id_gejala,
                              g.gejala
                            FROM tb_rekap r
                            JOIN tb_gejala g ON r.id_gejala = g.id_gejala
                            JOIN tb_penyakit p ON r.id_penyakit = p.id_penyakit
                            WHERE r.id_penyakit = '$id_penyakit'";

                  $result = $mysqli->query($query); // pastikan pakai $mysqli, bukan $koneksi

                  if ($result && $result->num_rows > 0) {
                    $no = 1;
                    $rowCount = $result->num_rows;
                    $first = true;

                    while ($data = $result->fetch_assoc()) {
                      echo "<tr>";
                      if ($first) {
                        echo "<td rowspan='$rowCount'>$no</td>";
                        echo "<td rowspan='$rowCount'>{$data['id_penyakit']}</td>";
                        echo "<td rowspan='$rowCount'>{$data['nama_penyakit']}</td>";
                        $first = false;
                      }
                      echo "<td>{$data['id_gejala']}</td>";
                      echo "<td>{$data['gejala']}</td>";
                      echo "<td>
                              <a class='btn btn-danger btn-sm' 
                                href='bobot_proses.php?hapus={$data['id_rekap']}&id={$data['id_penyakit']}'
                                onclick='return confirm(\"Yakin ingin menghapus gejala ini?\")'>
                                <i class='fa fa-trash'></i>
                              </a>
                            </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='6' class='text-center'>Belum ada gejala dipilih untuk penyakit ini.</td></tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- JS & CSS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<!-- Activation script -->
<script>
  $(document).ready(function() {
    $('#id_gejala').select2({
      placeholder: 'Pilih minimal 3 gejala',
      closeOnSelect: false,
      width: '100%',
    });

    // Validasi minimal 3 gejala
    $('#quickForm').on('submit', function(e) {
      var selected = $('#id_gejala').val();
      if (!selected || selected.length < 3) {
        alert('Minimal pilih 3 gejala!');
        e.preventDefault();
      }
    });
  });
</script>
