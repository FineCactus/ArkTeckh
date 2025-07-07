<?php
include("header.php");
include("../dboperation.php");
$obj = new dboperation();
$s = "select * from tbl_category";
$res = $obj->executequery($s);
?>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">CATEGORY VIEW PANEL</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="index.php">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Category View</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h4 class="card-title m-0">Category</h4>
                      <div class="ms-auto">
                      <input type="text" id="categorySearch" class="form-control" style="width: 250px;" placeholder="Search Categories...">
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Category Photo </th>
                          </tr>
                        </thead>
            <tbody>
              <?php
               while ($r = mysqli_fetch_array($res)) {
              ?>
                <tr>
                  <td><?php echo $r["category_id"]; ?></td>
                  <td><?php echo $r["category_name"]; ?></td>
                  <td> <img src="../uploads/<?php echo $r['photo']; ?>" width="100" height="100"> </td> 
                  <td>

                <button class="btn-edit"
                    data-id="<?php echo $r['category_id']; ?>"
                    style="background-color:rgb(44, 130, 220); color: #fff; padding: 6px 12px; border: none; text-decoration: none; border-radius: 4px; font-weight: 500; display: inline-block;">
                   <i class="bi bi-pencil"></i> Edit
                  </button>
                 <button class="btn-delete"
                  data-id="<?php echo $r['category_id']; ?>"
                style="background-color:rgb(220, 44, 44); color: #fff; padding: 6px 12px; border: none; text-decoration: none; border-radius: 4px; font-weight: 500; display: inline-block;">
                <i class="bi bi-trash"></i> Delete
                </button>
              </td>
               
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

<script>
  document.getElementById("categorySearch").addEventListener("keyup", function () {
    var input = this.value.toLowerCase();
    var rows = document.querySelectorAll("#basic-datatables tbody tr");
    rows.forEach(function (row) {
      var text = row.innerText.toLowerCase();
      row.style.display = text.includes(input) ? "" : "none";
    });
  });


  document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const categoryId = this.getAttribute("data-id"); /* category id */

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
          if (result.isConfirmed) {
            // Redirect to deletion URL
            window.location.href = `category_delete.php?eid=${categoryId}`;
          }
        });
      });
    });
  }); 

  document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".btn-edit");

  editButtons.forEach(function (btn) {
    btn.addEventListener("click", function () {
      const categoryId = this.getAttribute("data-id");

      Swal.fire({
        title: 'Edit Category',
        text: "Do you want to edit this category?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2c82dc',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, edit it!',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `categoryedit.php?eid=${categoryId}`;
        }
      });
    });
  });
});

</script>


<?php
include_once("footer.php");
?>