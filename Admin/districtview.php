<?php
include("header.php");
include("../dboperation.php");
$obj = new dboperation();
$s = "select * from tbl_district";
$res = $obj->executequery($s);
?>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">DISTRICT VIEW PANEL</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">District View</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Districts</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>District ID</th>
                            <th>District</th>
                          </tr>
                        </thead>
            <tbody>
              <?php
              while ($r = mysqli_fetch_array($res)) {
              ?>
                <tr>
                  <td><?php echo $r["district_id"]; ?></td>
                  <td><?php echo $r["district_name"]; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once("footer.php");
?>
