<?php
include("header.php");
include("../dboperation.php");
$obj = new dboperation();
$s = "select * from tbl_district";
$res = $obj->executequery($s);
?>
<div class="row" style="margin-top:100px">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex align-items-center">
          <div>
            <h4 class="card-title">DISTRICT</h4>
          </div>
        </div>
        <div class="table-responsive mt-4">
          <table class="table table-bordered table-hover table-striped text-center">
            <thead class="table-dark">
              <tr>
                <th scope="col">District ID</th>
                <th scope="col">District</th>
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
