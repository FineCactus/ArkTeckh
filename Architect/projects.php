<?php include("header.php"); 

include_once("../dboperation.php");
$obj = new dboperation();

$sql="select* from tbl_previous_works";
$res=$obj->executequery($sql);
$display=mysqli_fetch_array($res);

?>

<link href="css/projects.css" rel="stylesheet">

<style>
    html, body {
    height: auto;       /* allow page to grow */
    min-height: 100%;
    margin: 0;
    font-family: "Segoe UI", sans-serif;
    overflow-x: hidden; /* keep horizontal scroll hidden */
    overflow-y: auto;   /* enable vertical scroll */
}

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

        /* lively effects */
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
    @keyframes floatCard {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    /* Heading */
    h2 {
        text-align: center;
        color: #3e3127;
        font-weight: 700;
        margin-bottom: 30px;
        font-size: 28px;
        letter-spacing: 0.6px;
        position: relative;
    }
    h2::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        border-radius: 2px;
        background: #B78D65;
    }

    /* Labels */
    label {
        font-weight: 600;
        margin: 15px 0 8px;
        display: block;
        color: #5a4a39;
        font-size: 15px;
    }

    /* Inputs & Textarea */
    input[type="text"], textarea, input[type="file"] {
        width: 100%;
        padding: 14px 15px;
        border-radius: 12px;
        border: 2px solid #ddd;
        background-color: #fff;
        font-size: 15px;
        color: #3e3127;
        transition: all 0.3s ease;
        font-family: "Segoe UI", sans-serif;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    textarea:focus {
        border-color: #B78D65;
        outline: none;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(183, 141, 101, 0.3);
        transform: scale(1.02);
    }

    /* File upload layout */
    .file-row {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-top: 10px;
    }
    .file-col {
        flex: 1;
    }
    input[type="file"] {
        padding: 10px;
        border-radius: 10px;
        border: 1px dashed #B78D65;
        cursor: pointer;
        background: #faf7f2;
    }
    input[type="file"]:hover {
        background: #fff7ef;
        border-color: #a6784f;
    }

    /* Button */
    button {
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
        margin-top: 20px;
        box-shadow: 0 6px 16px rgba(183, 141, 101, 0.25);
    }
    button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(183, 141, 101, 0.35);
    }
</style>

<div class="background-image"></div>
<div class="overlay"></div>

<main>
    <div class="project-card">
        <h2>Add New Project</h2>
        <form action="projects1_action.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="prev_work_id" value="<?php echo $display['prev_work_id']; ?>">

            <!-- Project Title -->
            <label for="project_title">Project Title</label>
            <input type="text" id="project_title" name="project_title" placeholder="Enter project title" required>

            <!-- Project Description -->
            <label for="project_description">Description</label>
            <textarea id="project_description" name="project_description" rows="5" placeholder="Enter project details" required></textarea>

            <!-- Upload Images -->
            <label>Upload Images (3 only)</label>
            <div class="file-row">
                <div class="file-col">
                    <input type="file" name="photo1" accept="image/*" required>
                </div>
                <div class="file-col">
                    <input type="file" name="photo2" accept="image/*" required>
                </div>
                <div class="file-col">
                    <input type="file" name="photo3" accept="image/*" required>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" name="submit">Submit Project</button>
        </form>
    </div>
</main>

<?php include("footer.php"); ?>
