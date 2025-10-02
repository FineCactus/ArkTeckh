<?php include("header.php"); ?>
<?php
include_once("../dboperation.php");
$obj = new dboperation();
$architect_id = $_GET["cid"];
$sql = "SELECT p.payid, p.amount, p.status, pl.plan_name, pl.plan_id, pl.duration 
        FROM tbl_subscriptionplan p 
        INNER JOIN tbl_plan pl ON p.plan_id = pl.plan_id 
        WHERE p.architect_id='$architect_id'";
$res = $obj->executequery($sql);
$row = mysqli_fetch_array($res);
?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <h3 class="text-center text-primary mb-4">Secure Payment</h3>

                    <div class="text-center mb-3">
                        <h5><?php echo $row['plan_name']; ?></h5>
                        <p>
                            <strong>Total: ₹<?php echo $row['amount']; ?></strong><br>
                            <span class="badge bg-warning text-dark"><?php echo $row['status']; ?></span>
                        </p>
                    </div>

                    <form action="" method="post">
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" name="fname" placeholder="First Name" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="cardnumber" placeholder="Card Number" maxlength="16" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <input type="password" class="form-control" name="cvv" placeholder="CVV" maxlength="3" required>
                            </div>
                            <div class="col-8">
                                <input type="month" class="form-control" name="expiry" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="pay" class="btn btn-success">Submit Payment</button>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['pay'])) {
                        $payid = $row['payid'];
                        $pid= $row['plan_id'];
                        $d=$row['duration'];
                        $ren = date('Y-m-d', strtotime("+$d days"));
                        $update = "UPDATE tbl_subscriptionplan SET status='Paid',renewaldate='$ren' WHERE payid='$payid'";
                        $result = $obj->executequery($update);
                        $update1 = "UPDATE tbl_architects SET renewaldate='$ren',plan_id='$pid' WHERE architect_id='$architect_id'";
                        $result1 = $obj->executequery($update1);
                        if ($result) {
                            echo "<script>alert('Payment Successful! Plan Activated.');window.location='index.php'</script>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Error updating payment status.</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
