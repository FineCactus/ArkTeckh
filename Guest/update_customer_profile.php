<?php
session_start();
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../login.php");
    exit();
}
$customer_id = $_SESSION['customer_id'];

$sql = "SELECT * FROM tbl_customer WHERE customer_id='$customer_id'";
$res = $obj->executequery($sql);
$customer = mysqli_fetch_assoc($res);
?>

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        font-family: 'Open Sans', sans-serif;
        color: #252525;
        margin: 0;
        padding: 0;
    }

    .profile-section {
        padding: 20px 0 60px 0;
        margin-top: -20px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #252525;
        font-family: 'Teko', sans-serif;
        text-align: center;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 50px;
        text-align: center;
    }

    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .profile-box {
        background: #ffffff;
        border-radius: 15px;
        padding: 40px 30px;
        border: 2px solid #f8f9fa;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }

    .profile-box:hover {
        transform: translateY(-5px);
        border-color: #B78D65;
        box-shadow: 0 15px 35px rgba(183, 141, 101, 0.2);
    }

    /* Profile Info Box */
    .profile-info-box {
        text-align: center;
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
        margin-bottom: 25px;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #B78D65;
        box-shadow: 0 8px 20px rgba(183, 141, 101, 0.3);
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #252525;
        font-family: 'Teko', sans-serif;
    }

    .profile-status {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .profile-info {
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
        text-align: left;
    }

    .info-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #252525;
        margin-bottom: 15px;
        font-family: 'Teko', sans-serif;
    }

    .info-details {
        margin-top: 15px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .detail-label {
        font-weight: 600;
        color: #252525;
    }

    .detail-value {
        color: #B78D65;
        font-weight: 500;
    }

    /* Edit Form Box */
    .edit-form-box h3 {
        font-size: 1.6rem;
        font-weight: 600;
        margin-bottom: 30px;
        color: #252525;
        font-family: 'Teko', sans-serif;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 10px;
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

    .form-control {
        border: 2px solid #f8f9fa;
        border-radius: 8px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #495057;
        width: 100%;
    }

    .form-control:focus {
        border-color: #B78D65;
        box-shadow: 0 0 0 0.2rem rgba(183, 141, 101, 0.25);
        outline: none;
    }

    .form-control:read-only {
        background: #f8f9fa;
        border-color: #e9ecef;
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input {
        position: absolute;
        left: -9999px;
    }

    .file-input-label {
        display: block;
        padding: 15px 20px;
        background: #f8f9fa;
        border: 2px dashed #B78D65;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-input-label:hover {
        background: #B78D65;
        color: white;
    }

    .btn-save {
        background: #B78D65;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        font-family: 'Open Sans', sans-serif;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 20px;
    }

    .btn-save:hover {
        background: #a6784f;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(183, 141, 101, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-section {
            padding: 40px 0;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .profile-box {
            padding: 25px 20px;
        }
        
        .profile-image {
            width: 120px;
            height: 120px;
        }
    }
</style>

<section class="profile-section">
    <div class="container">
        <h2 class="section-title">Profile Settings</h2>
        <p class="section-subtitle">Manage and update your profile information</p>
        
        <div class="profile-container">
            <div class="row">
                <!-- Profile Info Box -->
                <div class="col-lg-4">
                    <div class="profile-box profile-info-box">
                        <div class="profile-image-container">
                            <img src="<?php echo $customer['cprofile'] ? '../uploads/'.$customer['cprofile'] : '../uploads/default.png'; ?>"
                                 class="profile-image" alt="Profile Picture" id="profileImagePreview">
                        </div>
                        <h3 class="profile-name"><?php echo  ($customer['cname']); ?></h3>
                        <p class="profile-status">Valued Customer</p>
                        
                        <div class="profile-info">
                            <h4 class="info-title">👤 Profile Info</h4>
                            
                            <div class="info-details">
                                <div class="detail-item">
                                    <span class="detail-label">📍 Location:</span>
                                    <span class="detail-value"><?php echo  ($customer['locations']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">📱 Phone:</span>
                                    <span class="detail-value"><?php echo  ($customer['phone']); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">🏠 Address:</span>
                                    <span class="detail-value"><?php echo  ($customer['addres']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form Box -->
                <div class="col-lg-8">
                    <div class="profile-box edit-form-box">
                        <h3>📝 Edit Profile Information</h3>
                        
                        <form action="customer_profile_action.php" method="POST" enctype="multipart/form-data">
                            <!-- First Row: Full Name (single column) -->
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="cname"
                                       value="<?php echo  ($customer['cname']); ?>" readonly>
                                <small class="text-muted">Name cannot be changed</small>
                            </div>

                            <!-- Second Row: Email and Phone (2 columns) -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email"
                                               value="<?php echo  ($customer['email']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="<?php echo  ($customer['phone']); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Third Row: Address and Location (2 columns) -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="addres"
                                               value="<?php echo  ($customer['addres']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control" name="locations"
                                               value="<?php echo  ($customer['locations']); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Fourth Row: Profile Picture (single column) -->
                            <div class="form-group">
                                <label class="form-label">Profile Picture</label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="file-input" id="photo" name="photo" accept="image/*">
                                    <label for="photo" class="file-input-label">
                                        📁 Choose New Profile Picture
                                    </label>
                                </div>
                            </div>

                            <input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
                            
                            <button type="submit" name="submit" class="btn-save">
                                💾 Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Preview profile image when selected
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImagePreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?php include("footer.php"); ?>
