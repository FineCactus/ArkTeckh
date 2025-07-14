<?php 
include_once('header.php');
include_once('../dboperation.php');
$obj=new dboperation();


if(isset($_GET["location_id"]))
{
  $location_id=$_GET["location_id"];
  $sql="select* from tbl_location where location_id='$location_id'";
  $res=$obj->executequery($sql);
  $r=mysqli_fetch_array($res);
}
?>
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form action="locationeditaction.php" method="POST">

<div class="container" >
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Forms</h3>
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
                  <a href="#">Forms</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Basic Form</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Location Updation</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            name="location_name" value="<?php echo $r["location_name"]; ?>"
                            placeholder="Enter Your location"
                          />
                          </div>
                          <div class="form-group">
                          <input
                            type="hidden"
                            class="form-control"
                            name="location_id"
                            value="<?php echo $r["location_id"]; ?>"
                          />
                        </div><br>
                    <button class="btn btn-success" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</form>

<!-- FORM ending -->




<!-- Footer -->

<?php include("footer.php"); ?>