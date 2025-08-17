<?php
if (isset($_POST["districtid"])) {
    $districtid = $_POST["districtid"];
    include_once("../dboperation.php");
    $sql = "SELECT * FROM tbl_location WHERE district_id = $districtid";
    $obj = new dboperation();
    $result = $obj->executequery($sql);
    ?>
    <option selected disabled>-- Select location --</option>
    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $row['location_id']; ?>"><?php echo $row['location_name']; ?></option>
    <?php
    }
}
?>
