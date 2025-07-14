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
