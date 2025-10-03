<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if architect is logged in
if (!isset($_SESSION['architect_id'])) {
    header("Location: ../Guest/login.php");
    exit();
}

include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$sql = "SELECT * FROM tbl_plan";
$result = $obj->executequery($sql);

$architect_id = $_SESSION['architect_id'];
?>

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        font-family: 'Open Sans', sans-serif;
        color: #252525;
    }

    .pricing-section {
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

    .pricing-card {
        background: #ffffff;
        border-radius: 15px;
        padding: 40px 30px;
        border: 2px solid #f8f9fa;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .pricing-card:hover {
        transform: translateY(-8px);
        border-color: #B78D65;
        box-shadow: 0 15px 35px rgba(183, 141, 101, 0.2);
    }

    .plan-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #252525;
        font-family: 'Teko', sans-serif;
    }

    .price {
        font-size: 3rem;
        font-weight: 600;
        margin: 15px 0;
        color: #B78D65;
        font-family: 'Teko', sans-serif;
    }

    .price span {
        font-size: 1rem;
        font-weight: 400;
        color: #6c757d;
        font-family: 'Open Sans', sans-serif;
    }

    .features {
        list-style: none;
        padding: 0;
        margin: 25px 0;
        flex-grow: 1;
    }

    .features li {
        margin-bottom: 15px;
        font-size: 1rem;
        color: #495057;
        padding-left: 25px;
        position: relative;
    }

    .features li::before {
        content: "✓";
        color: #B78D65;
        font-weight: bold;
        position: absolute;
        left: 0;
        top: 0;
        font-size: 1.1rem;
    }

    .btn-subscribe {
        display: inline-block;
        padding: 15px 30px;
        background: #B78D65;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        width: 100%;
        font-size: 1rem;
        margin-top: auto;
    }

    .btn-subscribe:hover {
        background: #a6784f;
        transform: translateY(-2px);
        text-decoration: none;
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(183, 141, 101, 0.3);
    }

    .popular-tag {
        background: linear-gradient(45deg, #B78D65, #a6784f);
        color: #ffffff;
        font-size: 0.85rem;
        padding: 6px 15px;
        border-radius: 20px;
        position: absolute;
        top: 20px;
        right: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .container {
        max-width: 1200px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .pricing-section {
            padding: 50px 0;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .pricing-card {
            margin-bottom: 30px;
            padding: 30px 25px;
        }
        
        .price {
            font-size: 2.5rem;
        }
    }
</style>

<section class="pricing-section">
    <div class="container text-center">
        <h2 class="section-title">Choose Your Plan</h2>
        <p class="section-subtitle">Enjoy unlimited access to premium features</p>
        <div class="row justify-content-center mt-5">

            <?php 
            $count = 0;
            while ($row = mysqli_fetch_array($result)) { 
                $count++;
            ?>
                <div class="col-md-5 col-lg-4 mb-4 d-flex">
                    <div class="pricing-card w-100">
                        <?php if($count == 1) { ?>
                            <span class="popular-tag">Most Popular</span>
                        <?php } ?>
                        <div class="plan-name"><?php echo $row['plan_name']; ?></div>
                        <div class="price">&#8377;<?php echo $row['amount']; ?><span>/ <?php echo $row['duration']; ?> days</span></div>
                        <ul class="features">
                            <li>Unlimited Project Upload</li>
                            <li>High-Quality Content</li>
                            <li>Cancel Anytime</li>
                        </ul>
                        <form action="paymentaction.php" method="post">
                            <input type="hidden" name="plan_id" value="<?php echo $row['plan_id']; ?>">
                            <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>">
                            <input type="hidden" name="architect_id" value="<?php echo $architect_id; ?>">
                            <button type="submit" class="btn-subscribe">Choose  <?php echo $row['plan_name']; ?></button>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<?php include("footer.php"); ?>
