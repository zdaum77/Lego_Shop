<?php require "parts/header.php"; ?>
    <div class="hero">
      <div class="mask">
        <div class="content d-flex">
          <div class="content1">
            <h2>
              Welcome To Muadz's Shop of Lego, where creativity knows no limits.
            </h2>
            <p>
              “Build your world, one brick at a time.” <br />Find your very own
              lego set that really clicks with you.
            </p>
          </div>
         
          <img
            class="images"
            src="https://file.garden/Z8ZtW5YstQe2hBpC/image-removebg-preview.png"
          />
          <img
            class="images"
            src="https://file.garden/Z8ZtW5YstQe2hBpC/lego-removebg-preview.png"
          />
        </div>
      </div>
    </div>
    <div class="mt-5 justify-content-center align-content-center d-flex">
      <h2><?php echo (isUserLoggedIn() ? "Welcome back, " . $_SESSION["user"]["name"] : ""  ); ?> </h2>
    </div>
    <div class="famoussets d-flex row">
      <div class=" card1 col-lg-2 col-md-3 col-4">
        <a href="/ninjago"
          ><img
            src="https://file.garden/Z8ZtW5YstQe2hBpC/ninjago.png"
            class="card-img-top"
        /></a>
        <div class="card-body">
          <p class="card-text">LEGO® NINJAGO</p>
        </div>
      </div>
      <div class=" card1 col-lg-2 col-md-3 col-4">
        <a href="/city"
          ><img
            src="https://file.garden/Z8ZtW5YstQe2hBpC/city.png"
            class="card-img-top"
        /></a>
        <div class="card-body">
          <p class="card-text">LEGO® CiTY</p>
        </div>
      </div>
      <div class=" card1 col-lg-2 col-md-3 col-4">
        <a href="/star-wars"
          ><img
            src="https://file.garden/Z8ZtW5YstQe2hBpC/star%20wars.png"
            class="card-img-top"
        /></a>
        <div class="card-body">
          <p class="card-text">LEGO® STAR WARS</p>
        </div>
      </div>
      <div class=" card1 col-lg-2 col-md-3 col-4">
        <a href="/creator"
          ><img
            src="https://i.ebayimg.com/images/g/Zw8AAOSweFVmaYim/s-l1200.jpg"
            class="card-img-top"
        /></a>
        <div class="card-body">
          <p class="card-text">LEGO® CREATOR</p>
        </div>
      </div>
      <div class=" card1 col-lg-2 col-md-3 col-4">
        <a href="/others"
          ><img
            src="https://file.garden/Z8ZtW5YstQe2hBpC/city%20(1).png"
            class="card-img-top"
        /></a>
        <div class="card-body">
          <p class="card-text">Other LEGO® Sets</p>
        </div>
      </div>
    </div>
  </body>
</html>
