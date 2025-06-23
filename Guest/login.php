<body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="css/style.css" rel="stylesheet">
<section class="h-100 gradient-form" style="background-color: #f8e4cc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="img\icons\icon-1.png"
                    style="width: 90px; height:90px;" alt="logo">
                  <h3 class="mt-1 mb-5 pb-1">LOGIN</h3>
                </div>
                            <!-- Linking PHP page using method POST -->

                <form action="loginaction.php" method="POST">                    
                    <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="user" class="form-control"
                      placeholder="Username" />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="pass" class="form-control" placeholder="Password" />
                  </div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log
                      in</button>
                    <a class="text-muted" href="#!">Forgot password?</a>
                  </div>                
                  <div class="d-flex align-items-center justify-content-center pb-4">
                  <button  type="button" class="btn btn-outline-danger">Create new</button>

                  </div>
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a company</h4>
                <p class="small mb-0">Book trusted architects and interior designers with ease.<br>
                                    Sign in to explore services, manage bookings, and bring your dream spaces to life.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>