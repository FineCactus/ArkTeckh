<?php 
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$sql = "SELECT * FROM tbl_plan";
$result = $obj->executequery($sql);
$cid = $_GET["cid"];
?>

<style>
    body {
        background: #5a5858ff;
        font-family: 'Poppins', sans-serif;
        color: #fff;
    }

    .pricing-section {
        padding: 80px 0;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        color: #fff;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .pricing-card {
        background: #1c1c1c;
        border-radius: 15px;
        padding: 40px 25px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .pricing-card:hover {
        transform: translateY(-6px);
        border-color: #B78D65;
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.5);
    }

    .plan-name {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #fff;
    }

    .price {
        font-size: 3rem;
        font-weight: 900;
        margin: 10px 0;
        color: #B78D65;
    }

    .price span {
        font-size: 1rem;
        font-weight: 400;
        color: rgba(255, 255, 255, 0.6);
    }

    .features {
        list-style: none;
        padding: 0;
        margin: 25px 0;
        flex-grow: 1;
    }

    .features li {
        margin-bottom: 12px;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .features li::before {
        content: "✓";
        color: #B78D65;
        margin-right: 10px;
    }

    .btn-subscribe {
        display: inline-block;
        padding: 12px 28px;
        background: #e50914;
        color: #fff;
        font-weight: bold;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        width: 100%;
    }

    .btn-subscribe:hover {
        background: #B78D65;
        transform: scale(1.05);
        text-decoration: none;
        color: #fff;
    }

    .popular-tag {
        background: #f70707ff;
        color: #fff;
        font-size: 0.8rem;
        padding: 4px 12px;
        border-radius: 12px;
        position: absolute;
        top: 20px;
        right: 20px;
        font-weight: bold;
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
                            <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                            <button type="submit" class="btn-subscribe">Choose  <?php echo $row['plan_name']; ?></button>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>

<?php include("footer.php"); ?>
