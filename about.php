  <!-- navbar -->
  <?php include "tamplate/navbar.php"; ?>

  <section class="hero-wrap hero-wrap-2" style="background-image: url('assets/images/padi.jpeg')" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs mb-2">
            <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
            <span>Tentang <i class="ion-ios-arrow-forward"></i></span>
          </p>
          <h1 class="mb-0 bread">Tentang</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="ftco-section ftco-faqs">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 order-md-last">
          <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image: url(assets/images/padi1..jpeg); background-size: contain; background-repeat: no-repeat;">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="heading-section mb-5 mt-5 mt-lg-0">
            <h2 class="mb-3">Penyakit Tanaman Padi</h2>
            <p>
              Berikut Beberapa Penyakit Yang Ada Pada Tanaman Padi.
            </p>
          </div>
          <div id="accordion" class="myaccordion w-100" aria-multiselectable="true">
            <?php
            include 'setting/koneksi.php';
            $sql = "SELECT * FROM tb_penyakit ORDER BY kdpenyakit";
            $qry = mysqli_query($mysqli, $sql) or die("SQL Error" . mysqli_error($mysqli));

            while ($data = mysqli_fetch_array($qry)) {
              $id_penyakit = $data['kdpenyakit'];
            ?>
              <div class="card">
                <div class="card-header p-0" id="heading_<?php echo $id_penyakit; ?>" role="tab">
                  <h2 class="mb-0">
                    <button href="#collapse_<?php echo $id_penyakit; ?>" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="false" aria-controls="collapse_<?php echo $id_penyakit; ?>">
                      <p class="mb-0"><?php echo $data['nama_penyakit']; ?></p>
                      <i class="fa" aria-hidden="true"></i>
                    </button>
                  </h2>
                </div>
                <div class="collapse" id="collapse_<?php echo $id_penyakit; ?>" role="tabpanel" aria-labelledby="heading_<?php echo $id_penyakit; ?>">
                  <div class="card-body py-3 px-0">
                    <ul>
                      <li>
                        <label>Definisi Penyakit :</label>
                        <p class="text-info"><?php echo $data['definisi']; ?></p>
                      </li>
                      <li>
                        <label>Saran :</label>
                        <p class="warning"><?php echo $data['pengobatan']; ?></p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section bg-light ftco-faqs">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image: url(assets/images/padi1..jpeg); background-size: contain; background-repeat: no-repeat;">
          </div>
        </div>

        <div class="col-lg-6 order-md-last">
          <div class="heading-section mb-5 mt-5 mt-lg-0">
            <h2 class="mb-3">Gejala-gejala Penyakit Tanaman Padi</h2>
            <p>
              Berikut Beberapa Gejala Penyakit Pada Sistem Pakar Diagnosa Tanaman Padi.
            </p>
          </div>
          <div id ="accordion" class="myaccordion w-100" aria-multiselectable="true">
            <div class="card">
              <div class="card-header p-0" id ="headingThree" role="tab">
                <h2 class="mb-0">
                  <button href="#collapseThree" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                    <p class="mb-0">
                      Lihat Gejala-gejala Penyakit Tanaman Padi
                    </p>
                    <i class="fa" aria-hidden="true"></i>
                  </button>
                </h2>
              </div>
              <div class="collapse" id ="collapseThree" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-body py-3 px-0">
                  <?php
                  include 'setting/koneksi.php';
                  $sqli = "SELECT * FROM tb_gejala ORDER BY id_gejala ASC";
                  $qry = mysqli_query($mysqli, $sqli) or die("SQL Error" . mysqli_error($mysqli));

                  while ($data = mysqli_fetch_array($qry)) {
                  ?>
                    <ul>
                      <li><?php echo $data['gejala']; ?></li>
                    </ul>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- footer -->
  <?php include "tamplate/footer.php"; ?>