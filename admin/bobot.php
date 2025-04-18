<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Rekap Data  Penyakit </h1>
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
                <th>Kode Penyakit</th>
                <th>Nama Penyakit</th>
                <th>Jumlah Gejala</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "
                SELECT 
                  p.id_penyakit, 
                  p.nama_penyakit, 
                  COUNT(r.id_gejala) AS jumlah_gejala
                FROM tb_penyakit p
                LEFT JOIN tb_rekap r ON p.id_penyakit = r.id_penyakit
                GROUP BY p.id_penyakit
              ";
              $result = $mysqli->query($query);
              $no = 1;
              while ($data = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>{$data['id_penyakit']}</td>";
                echo "<td>{$data['nama_penyakit']}</td>";
                echo "<td>{$data['jumlah_gejala']}</td>";
                echo "<td>
                        <a href='?hal=bobot_olah&id={$data['id_penyakit']}' 
                          class='btn btn-info btn-sm' title='Lihat Detail'>
                          <i class='fa fa-eye'></i> Lihat Detail
                        </a>
                      </td>";
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
