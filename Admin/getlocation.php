<?php
if (isset($_POST["districtid"])) {
    $districtid = $_POST["districtid"];

    include_once("../dboperation.php");
    $sql = "SELECT * FROM tbl_location WHERE district_id = $districtid";
    $obj = new dboperation();
    $result = $obj->executequery($sql);
    $s = 1;

    while ($row = mysqli_fetch_array($result)) {
?>
        <tr>
            <td><?php echo $s++; ?></td>
            <td><?php echo $row["location_name"]; ?></td>
            <td>
                <a href="location_edit.php?location_id=<?php echo $row["location_id"]; ?>" 
                   class="btn-edit"
                   style="background-color:rgb(44, 130, 220); color: #fff; padding: 6px 12px; border: none; text-decoration: none; border-radius: 4px; font-weight: 500; display: inline-block;">
                   <i class="bi bi-pencil"></i> Edit
                </a>

                <a href="location_delete.php?location_id=<?php echo $row["location_id"]; ?>" 
                   class="btn-delete"
                   onclick="return confirm('Are you sure you want to delete?')"
                   style="background-color:rgb(220, 44, 44); color: #fff; padding: 6px 12px; border: none; text-decoration: none; border-radius: 4px; font-weight: 500; display: inline-block;">
                   <i class="bi bi-trash"></i> Delete
                </a>
            </td>
        </tr>
<?php
    }
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Delete
  const deleteButtons = document.querySelectorAll(".btn-delete");
  deleteButtons.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      e.preventDefault(); // prevent default link action
      const location_id = this.getAttribute("data-id");

      Swal.fire({
        title: 'Are you sure?',
        text: "This location will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `location_delete.php?location_id=${location_id}`;
        }
      });
    });
  });

  // Edit
  const editButtons = document.querySelectorAll(".btn-edit");
  editButtons.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      const location_id = this.getAttribute("data-id");

      Swal.fire({
        title: 'Edit Location',
        text: "Do you want to edit this location?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2c82dc',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, edit it!',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `location_edit.php?location_id=${location_id}`;
        }
      });
    });
  });
});

</script>
