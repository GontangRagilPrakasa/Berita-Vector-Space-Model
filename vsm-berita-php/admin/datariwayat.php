<!DOCTYPE html>
<html lang="en">
<?php
  set_time_limit(0);
  include "library/asset.php";
?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Latent Semantic Analysis</title>



</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

      <?php
      include "sidebar.php";
      ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Semua Data</h1>
          <p class="mb-4">Dataset yang digunakan diambil dari </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTable Reviewer Journal</h6>
            </div>
            <?php
              $json=file_get_contents("http://localhost:5000/test");
              $data = json_decode($json, true);
             
                
            ?>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Query</th>
                      <th>Rekomendasi 1</th>
                      <th>Rekomendasi 2</th>
                      <th>Rekomendasi 3</th>
                      <th>Rekomendasi 4</th>
                      <th>Rekomendasi 5</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Query</th>
                      <th>Rekomendasi 1</th>
                      <th>Rekomendasi 2</th>
                      <th>Rekomendasi 3</th>
                      <th>Rekomendasi 4</th>
                      <th>Rekomendasi 5</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php  foreach ($data as $value) { ?>
                  <tr>
                  <?php
                        echo "<td>";
                        echo $value['id'];
                        echo "<td>";
                        echo $value['query']; 
                        echo "</td>";
                        echo "</td>";
                        foreach ($value['details'] as $dataa) {
                          echo "<td>";
                          echo $dataa['Judul']." [Score = ".$dataa['score']."]";
                          echo "</td>";
                        }
                        echo "</td>";
                  ?>
                  </tr>
                  <?php } ?>
                   <!--  <tr>
                      <td>Donna Snider</td>
                      <td>Customer Support</td>
                      <td>New York</td>
                      <td>27</td>
                      <td>2011/01/25</td>
                      <td>$112,000</td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
            <?php  ?>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  

</body>

</html>
