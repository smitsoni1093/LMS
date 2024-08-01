<!-- HEADER -->
<?php include('./includes/header.php'); ?>
<!-- HEADER -->

<!-- NAVIGATION -->
<?php include('./includes/navigation.php'); ?>
<!-- NAVIGATION -->
<main class="container-fluid">
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div>
          <div class="image-cover"></div>
          <img src="./images/vaccination.jpg" class="images" alt="">
        </div>

        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Vaccination saves lives</h1>
            <p class="fs-5">Most COVID-19 vaccines require two doses. Getting your both doses, as soon as it's available to you, will give you the best protection against COVID-19.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Book Your Vaccine</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div>
          <div class="image-cover"></div>
          <img src="./images/leb.jpg" class="images" alt="">
        </div>

        <div class="container">
          <div class="carousel-caption">
            <h1>Laboratory Priority Services Delivered</h1>
            <p class="fs-5">Check out different Loboratories which provide different testing services around INDIA.</p>
            <p><a class="btn btn-lg btn-primary" href="#">View Testing Services</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div>
          <div class="image-cover"></div>
          <img src="./images/bed.jpg" class="images" alt="">
        </div>

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Looking for Hospital beds?</h1>
            <p class="fs-5">Check out different hospitals with available beds around INDIA.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Checkout Availablity Of Beds</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</main>


<div class="d-flex justify-content-center">
  <div class="card m-1 shadow" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="./images/vaccination.jpg" style="height:220px;width:200px;object-fit:cover;" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Vaccination</h5>
          <p class="card-text">Most COVID-19 vaccines require two doses. Getting your both doses, as soon as it's available to you, will give you the best protection against COVID-19.</p>
          <a href="#" class="btn btn-outline-primary">Do a Vaccination</a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card m-1 shadow" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="./images/leb.jpg" style="height:220px;width:200px;object-fit:cover;" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Testing</h5>
          <p class="card-text">Check out different Loboratories which provide different testing services around INDIA.</p>
          <a href="#" class="btn btn-outline-primary">Register for Testing</a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card m-1 shadow" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="./images/bed.jpg" style="height:220px;width:200px;object-fit:cover;" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Vacancy of Beds</h5>
          <p class="card-text">Check out different hospitals with available beds around INDIA.</p>
          <a href="#" class="btn btn-outline-primary">Check Vacan of Beds</a>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- FOOTER -->
<?php include('./includes/footer.php'); ?>
<!-- FOOTER -->