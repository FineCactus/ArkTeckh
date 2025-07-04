<?php 

include_once('header.php');
include_once('../dboperation.php');
$obj=new dboperation();


if(isset($_GET["eid"]))
{
  $cid=$_GET["eid"];
  $sql="select* from tbl_category where category_id='$cid'";
   $res=$obj->executequery($sql);
   $display=mysqli_fetch_array($res);
}
?>
 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form action="categoryeditaction.php" method="POST" enctype="multipart/form-data">

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
                    <div class="card-title">Category Updation</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            name="catname" value="<?php echo $display["category_name"]; ?>"
                            placeholder="Enter Your Name"
                          />
                          </div>
                          <div class="form-group">
                          <label for="email2"></label>
                          <img src="../uploads/<?php echo $display['photo']; ?>" width="100" height="100">
                        </div><br>
                          <div class="form-group">
                          <label for="email2">Image</label>
                          <input
                            type="file"
                            class="form-control"
                            name="photo"
                          />
                        </div><br>
                          <div class="form-group">
                          <input
                            type="hidden"
                            class="form-control"
                            name="CategoryId"
                            value="<?php echo $display["category_id"]; ?>"
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

<?php if (isset($_GET['status'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let status = "<?php echo $_GET['status']; ?>";

      if (status === "success") {
        Swal.fire({
          icon: 'success',
          title: 'Category Added!',
          text: 'Your category has been successfully added.',
        });
      } else if (status === "exist") {
        Swal.fire({
          icon: 'warning',
          title: 'Already Exists',
          text: 'This category already exists!',
        });
      } else if (status === "empty") {
        Swal.fire({
          icon: 'info',
          title: 'Empty Field',
          text: 'Please enter a category name!',
        });
      } else if (status === "error") {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong while adding the category.',
        });
      }

      // Remove status from URL
      window.history.replaceState({}, document.title, "category.php");
    });
  </script>
<?php endif; ?>


<!-- Footer -->

<?php include("footer.php"); ?>