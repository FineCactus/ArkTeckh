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

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        font-family: 'Open Sans', sans-serif;
        color: #252525;
    }

    .payment-section {
        padding: 80px 0;
        min-height: 70vh;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #252525;
        font-family: 'Teko', sans-serif;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 50px;
    }

    .payment-gateway {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e1e8ed;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        max-width: 520px;
        margin: 0 auto;
        overflow: hidden;
    }

    .gateway-header {
        background: linear-gradient(135deg, #B78D65, #a6784f);
        color: white;
        padding: 25px 30px;
        text-align: center;
        position: relative;
    }

    .gateway-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #B78D65;
    }

    .gateway-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin: 0;
        font-family: 'Teko', sans-serif;
    }

    .gateway-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        margin: 5px 0 0 0;
    }

    .order-summary {
        background: #f8f9fa;
        padding: 20px 30px;
        border-bottom: 1px solid #e9ecef;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .summary-row:last-child {
        margin-bottom: 0;
        padding-top: 8px;
        border-top: 1px solid #dee2e6;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .summary-label {
        color: #6c757d;
    }

    .summary-value {
        color: #252525;
        font-weight: 500;
    }

    .total-amount {
        color: #B78D65;
        font-family: 'Teko', sans-serif;
        font-size: 1.3rem !important;
    }

    .status-indicator {
        background: #B78D65;
        color: white;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .payment-form {
        padding: 30px;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #252525;
        margin-bottom: 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid #f8f9fa;
        font-family: 'Teko', sans-serif;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        color: #252525;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 1rem;
    }

    .gateway-form-control {
        border: 1px solid #d1d9e0;
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: #ffffff;
        color: #495057;
    }

    .gateway-form-control:focus {
        border-color: #B78D65;
        box-shadow: 0 0 0 3px rgba(183, 141, 101, 0.1);
        outline: none;
    }

    .gateway-form-control::placeholder {
        color: #9ca3af;
        font-size: 0.9rem;
    }

    .input-icon {
        position: relative;
    }

    .input-icon .gateway-form-control {
        padding-left: 40px;
    }

    .input-icon::before {
        content: attr(data-icon);
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1.1rem;
        z-index: 2;
    }

    .btn-secure-payment {
        background: linear-gradient(135deg, #B78D65, #a6784f);
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        width: 100%;
        padding: 16px 24px;
        font-size: 1rem;
        font-family: 'Open Sans', sans-serif;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(183, 141, 101, 0.3);
    }

    .btn-secure-payment:hover {
        background: linear-gradient(135deg, #a6784f, #B78D65);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(183, 141, 101, 0.4);
    }

    .security-footer {
        background: #f8f9fa;
        padding: 15px 30px;
        text-align: center;
        border-top: 1px solid #e9ecef;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .security-badges {
        margin-top: 10px;
    }

    .security-badge {
        display: inline-block;
        margin: 0 8px;
        color: #28a745;
        font-size: 0.8rem;
    }

    .container {
        max-width: 1200px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .payment-section {
            padding: 50px 0;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .payment-gateway {
            margin: 0 15px;
        }
        
        .gateway-header {
            padding: 20px 25px;
        }
        
        .payment-form {
            padding: 25px 20px;
        }
        
        .order-summary {
            padding: 15px 20px;
        }
    }
</style>

<section class="payment-section">
    <div class="container text-center">
        <h2 class="section-title">Secure Payment</h2>
        <p class="section-subtitle">Complete your subscription payment securely</p>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-gateway">
                    <!-- Gateway Header -->
                    <div class="gateway-header">
                        <h3 class="gateway-title">🔒 Secure Checkout</h3>
                        <p class="gateway-subtitle">ArkTech Payment Gateway</p>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary">
                        <div class="summary-row">
                            <span class="summary-label">Plan:</span>
                            <span class="summary-value"><?php echo $row['plan_name']; ?></span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Duration:</span>
                            <span class="summary-value"><?php echo $row['duration']; ?> days</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Status:</span>
                            <span class="status-indicator"><?php echo $row['status']; ?></span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Total Amount:</span>
                            <span class="total-amount">₹<?php echo $row['amount']; ?></span>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="payment-form">
                        <h4 class="form-section-title">💳 Payment Information</h4>
                        
                        <form action="" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control gateway-form-control" name="fname" placeholder="John" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control gateway-form-control" name="lname" placeholder="Doe" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Card Number</label>
                            <div class="input-icon" data-icon="💳">
                                <input type="text" class="form-control gateway-form-control" name="cardnumber" placeholder="1234 5678 9012 3456" maxlength="16" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">CVV</label>
                                    <div class="input-icon" data-icon="🔐">
                                        <input type="password" class="form-control gateway-form-control" name="cvv" placeholder="123" maxlength="3" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Expiry Date</label>
                                    <div class="input-icon" data-icon="📅">
                                        <input type="month" class="form-control gateway-form-control" name="expiry" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="pay" class="btn-secure-payment">
                                🔒 Process Secure Payment
                            </button>
                        </div>

                        <div class="security-info">
                            <p class="mb-0">� Your payment is secured with 256-bit SSL encryption</p>
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
