<?php 
include_once("../dboperation.php");
$obj = new dboperation();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../jquery-3.6.0.min.js"></script>
  <title>Signup</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
      --light-brown: #b78d65;
      --dark-brown: #9c6b42;
      --form-bg: rgba(255, 250, 245, 0.95);
      --input-border: #d9c1a7;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }

    body {
      background: url('img/house.jpg') no-repeat center center;
      background-size: cover;
      display: flex; align-items: center; justify-content: center;
      height: 100vh; overflow: hidden; position: relative;
    }

    body::before {
      content: ''; position: fixed; inset: 0;
      background: linear-gradient(120deg, rgba(183,141,101,0.4), rgba(255,255,255,0.25), rgba(156,107,66,0.35));
      background-size: 300% 300%; animation: gradientMove 8s ease infinite; z-index: -2;
    }
    @keyframes gradientMove { 0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}

    .orb { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.3); box-shadow: 0 0 20px rgba(183,141,101,0.6); animation: floatOrb 12s infinite ease-in-out; z-index:-1; }
    @keyframes floatOrb {0%{transform:translateY(0)translateX(0);opacity:.6}50%{transform:translateY(-60px)translateX(40px);opacity:1}100%{transform:translateY(0)translateX(0);opacity:.6}}
    .orb:nth-child(1){width:120px;height:120px;top:20%;left:8%;animation-duration:14s}
    .orb:nth-child(2){width:90px;height:90px;bottom:18%;right:12%;animation-duration:11s}
    .orb:nth-child(3){width:70px;height:70px;top:65%;left:28%;animation-duration:16s}

    .auth-container {
      background-color: var(--form-bg); border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.35);
      padding: 1.5rem; width: 95%; max-width: 550px; animation: fadeIn 0.8s ease; z-index: 10;
    }
    @keyframes fadeIn {from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}

    .tabs { text-align: center; margin-bottom: 1rem; }
    .tab { font-weight: bold; font-size: 1.4rem; color: var(--light-brown); }

    .form-row { display: flex; gap: 10px; }
    .form-row .input-group { flex: 1; }

    .input-group { position: relative; margin-bottom: 0.8rem; }
    .input-group i { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--light-brown); font-size: 0.9rem; }
    .input-group input, .input-group select {
      width: 100%; padding: 0.65rem 0.65rem 0.65rem 2.2rem;
      border: 1px solid var(--input-border); border-radius: 8px; font-size: 0.95rem; transition: all 0.3s ease;
    }
    .input-group input:focus, .input-group select:focus { border-color: var(--light-brown); box-shadow: 0 0 6px rgba(183,141,101,0.4); outline: none; }

    input[type="file"] { border: 1px solid var(--input-border); border-radius: 8px; padding: 0.4rem; width: 100%; font-size: 0.9rem; }

    button {
      background: linear-gradient(135deg, var(--light-brown), var(--dark-brown)); color: white; padding: 0.75rem;
      border: none; border-radius: 8px; cursor: pointer; font-size: 1rem; font-weight: bold;
      transition: all 0.3s ease; width: 100%; margin-top: 0.3rem;
    }
    button:hover { background: linear-gradient(135deg, var(--dark-brown), var(--light-brown)); transform: translateY(-2px); box-shadow: 0 5px 12px rgba(183,141,101,0.5); }

    .bottom-link { text-align: center; margin-top: 0.8rem; font-size: 0.9rem; }
    .bottom-link a { color: var(--light-brown); font-weight: bold; text-decoration: none; }
    .bottom-link a:hover { color: var(--dark-brown); text-decoration: underline; }

.file-input {
  padding: 0.55rem 0.65rem 0.55rem 2.2rem;
  font-size: 0.95rem;
  border: 1px solid var(--input-border);
  border-radius: 8px;
  width: 100%;
  cursor: pointer;
}

.file-input::file-selector-button {
  margin-right: 10px;
  border: none;
  background: var(--light-brown);
  color: white;
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s ease;
}

.file-input::file-selector-button:hover {

}


  </style>
</head>
<body>

  <div class="orb"></div><div class="orb"></div><div class="orb"></div>

  <div class="auth-container">
    <div class="tabs"><div class="tab">Create Account</div></div>

    <form action="signupaction.php" method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <div class="input-group"><i class="fas fa-user"></i><input type="text" name="customer_name" placeholder="Full Name" required /></div>
        <div class="input-group"><i class="fas fa-home"></i><input type="text" name="address" placeholder="Address" required /></div>
      </div>

      <div class="form-row">
        <div class="input-group"><i class="fas fa-envelope"></i><input type="email" name="email" placeholder="Email" required /></div>
        <div class="input-group"><i class="fas fa-phone"></i><input type="text" name="phone" placeholder="Phone Number" required /></div>
      </div>

      <div class="form-row">
        <div class="input-group"><i class="fas fa-user-circle"></i><input type="text" name="username" placeholder="Username" required /></div>
        <div class="input-group"><i class="fas fa-lock"></i><input type="password" name="password" placeholder="Password" required /></div>
      </div>

      <div class="form-row">
        <div class="input-group">
          <i class="fas fa-map"></i>
          <select name="district_id" id="district_id" required>
            <option value="" disabled selected>Select District</option>
            <?php
              $locs = $obj->executequery("SELECT * FROM tbl_district");
              while ($row = mysqli_fetch_assoc($locs)) {
                echo "<option value='{$row['district_id']}'>{$row['district_name']}</option>";
              }
            ?>
          </select>
        </div>
        <div class="input-group">
          <i class="fas fa-location-dot"></i>
          <select name="location_id" id="location" required>
            <option value="" disabled selected>Select Location</option>
          </select>
        </div>
      </div>

        <div class="input-group">
  <i class="fas fa-image"></i>
  <input type="file" name="photo1" id="photo1" class="file-input" required />
</div>



      <button type="submit" name="submit">Register</button>
      <div class="bottom-link">Already have an account? <a href="../Guest/login.php">Login</a></div>
    </form>
  </div>

  <script>
    $("#district_id").change(function () {
      var district_id = $(this).val();
      $.ajax({
        url: "getlocation.php",
        method: "POST",
        data: { districtid: district_id },
        success: function (response) { $("#location").html(response); },
        error: function () { $("#location").html("<option>Error loading locations</option>"); }
      });
    });
  </script>

  <script>
document.getElementById("photo1").addEventListener("change", function () {
  const fileName = this.files[0] ? this.files[0].name : "Choose Profile Picture";
  document.getElementById("fileLabelText").textContent = fileName;
});

    </script>

</body>
</html>
