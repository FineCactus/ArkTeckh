<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

$sql="select* from tbl_architects";
$res=$obj->executequery($sql);
$display=mysqli_fetch_array($res);
?>

<style>
  /* Background */
  .background-image {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      background: url('img/project-1.jpg') no-repeat center center fixed;
      background-size: cover;
      z-index: -2;
  }
  .overlay {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      background: linear-gradient(120deg, rgba(255,255,255,0.6), rgba(255,255,255,0.4));
      backdrop-filter: blur(6px);
      z-index: -1;
  }

  /* Layout */
  body, html {
      height: 100%;
      margin: 0;
      font-family: "Segoe UI", sans-serif;
      overflow-x: hidden;
  }
  main {
      position: relative;
      padding: 40px 0 60px 0;
      min-height: 90vh;
      display: flex;
      justify-content: center;
      align-items: start;
      z-index: 1;
  }

  /* Card */
  .project-card {
      width: 90%;
      max-width: 700px;
      background: rgba(255, 255, 255, 0.85);
      border-radius: 18px;
      padding: 36px 30px 40px 30px;
      backdrop-filter: blur(8px);

      /* New lively effects */
      border: 2px solid transparent;
      background-clip: padding-box, border-box;
      background-origin: border-box;
      background-image: 
          linear-gradient(white, white), 
          linear-gradient(135deg, #B78D65, #a6784f);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);

      animation: floatCard 5s ease-in-out infinite;
      transition: all 0.3s ease;
  }

  .project-card:hover {
      transform: translateY(-6px) scale(1.02);
      box-shadow: 0 12px 32px rgba(183, 141, 101, 0.25);
      border-color: #B78D65;
  }

  /* Floating animation */
  @keyframes floatCard {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
  }

  @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
  }

  /* Headings */
  h2 {
      text-align: center;
      color: #3e3127;
      font-weight: 700;
      margin-bottom: 40px;
      font-size: 30px;
      letter-spacing: 0.7px;
      position: relative;
  }
  h2::after {
      content: "";
      position: absolute;
      bottom: -12px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      border-radius: 2px;
      background: #B78D65;
  }

  /* Form */
  .form-group {
      margin-bottom: 28px;
  }
  label {
      font-weight: 600;
      margin-bottom: 8px;
      display: block;
      color: #5a4a39;
      font-size: 15px;
  }
  /* Style for dropdowns */
  /* Style for dropdowns and textboxes (replace your old select block with this) */
    .form-group select,
    .form-group input[type="text"] {
    width: 100%;
    padding: 14px 18px;
    border-radius: 12px;
    border: 2px solid #ddd;
    background-color: #fff;
    box-sizing: border-box;
    font-size: 16px;
    color: #3e3127;
    transition: all 0.25s ease;
    font-family: "Segoe UI", sans-serif;
    }

    /* Select-only: remove default arrow + custom arrow icon */
    .form-group select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml;utf8,<svg fill='%23B78D65' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 18px;
    padding-right: 45px; /* space for arrow */
    }

    /* Hover state */
    .form-group select:hover,
    .form-group input[type="text"]:hover {
    border-color: #B78D65;
    background-color: #faf7f2;
    box-shadow: 0 4px 10px rgba(183, 141, 101, 0.15);
    }

    /* Focus state (fixed selector) */
    .form-group select:focus,
    .form-group input[type="text"]:focus {
    border-color: #B78D65;
    outline: none;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(183, 141, 101, 0.3);
    transform: scale(1.02);
    }



  /* Button */
  .next-btn {
      background: linear-gradient(135deg, #B78D65, #a6784f);
      color: white;
      padding: 15px 0;
      border: none;
      border-radius: 14px;
      font-size: 18px;
      font-weight: 700;
      letter-spacing: 0.7px;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 100%;
      margin-top: 10px;
      box-shadow: 0 6px 16px rgba(183, 141, 101, 0.25);
  }
  .next-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 22px rgba(183, 141, 101, 0.35);
  }

  /* Responsive */
  @media (max-width: 600px) {
      .project-card {
          padding: 28px 18px;
      }
      h2 {
          font-size: 22px;
          margin-bottom: 28px;
      }
  }
</style>

<form action="get_locationaction.php" method="POST">
  <input type="hidden" name="architect_id" value="<?php echo $display['architect_id']; ?>">
  <div class="background-image"></div>
  <div class="overlay"></div>

  <main>
    <div class="project-card">
      <h2>Select Details</h2>

      <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
          <option value="" selected disabled>-- Select Category --</option>
          <?php 
          $locs = $obj->executequery("SELECT * FROM tbl_category");
          while ($row = mysqli_fetch_assoc($locs)) {
            echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
          }?>
        </select>
      </div>

      <div class="form-group">
        <label for="district_id">District</label>
        <select name="district_id" id="district_id" required>
          <option value="" selected disabled>-- Select District --</option>
          <?php 
          $locs = $obj->executequery("SELECT * FROM tbl_district");
          while ($row = mysqli_fetch_assoc($locs)) {
            echo "<option value='{$row['district_id']}'>{$row['district_name']}</option>";
          }?>
        </select>
      </div>

    <div class="form-group">
         <label for="location_id">Location</label>
         <input type="text" name="location_id" id="location_id" placeholder="Enter Location" required>
</div>


      <button type="submit" class="next-btn" name="submit">Next →</button>
    </div>
  </main>
</form>
<?php include("footer.php"); ?>
