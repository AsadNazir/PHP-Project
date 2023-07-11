<div class="MainPage">
  <h1 class="MainDashBoardHeadings">Milk Production</h1>
  <div class="MilkProduction">

    <?php

    require_once("./Model/CowModal.php");
    $CowModalObj = new CowModal();
    $allCows = $CowModalObj->getAllCows($CowModalObj->conn->connection, "cows");
    $res = $CowModalObj->getACowMilkRecord($CowModalObj->conn->connection, "milk");
    ?>
    <div>
      <h1>Annual</h1>
      <!-- Upadate the Production here in PHP  -->
      <h3>
        <?php

        if ($res['total_year'] == null) {
          echo "0 ltr";
        } else {
          echo $res['total_year'] . " ltr";
        }
        ?>
      </h3>
    </div>
    <div>
      <h1>Monthly</h1>
      <!-- Upadate the Production here in PHP  -->
      <h3>
        <?php
        if ($res['total_month'] == null) {
          echo "0 ltr";
        } else {
          echo $res['total_month'] . " ltr";
        }

        ?>
      </h3>
    </div>
    <div>
      <h1>Weekly</h1>
      <!-- Upadate the Production here in PHP  -->
      <h3>
        <?php
        if ($res['total_week'] == null) {
          echo "0 ltr";
        } else {
          echo $res['total_week'] . " ltr";
        }

        ?>
      </h3>

    </div>
    <div>
      <h1>Daily</h1>
      <!-- Upadate the Production here in PHP  -->
      <h3>
        <?php
        if ($res['total_day'] == null) {
          echo "0 ltr";
        } else {
          echo $res['total_day'] . " ltr";
        }

        ?>
      </h3>

    </div>
  </div>
  <div class="CowStats">
    <div><span class="CowStatIcon"><svg xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 640 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
          <path
            d="M96 224v32V416c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V327.8c9.9 6.6 20.6 12 32 16.1V368c0 8.8 7.2 16 16 16s16-7.2 16-16V351.1c5.3 .6 10.6 .9 16 .9s10.7-.3 16-.9V368c0 8.8 7.2 16 16 16s16-7.2 16-16V343.8c11.4-4 22.1-9.4 32-16.1V416c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V256l32 32v49.5c0 9.5 2.8 18.7 8.1 26.6L530 427c8.8 13.1 23.5 21 39.3 21c22.5 0 41.9-15.9 46.3-38l20.3-101.6c2.6-13-.3-26.5-8-37.3l-3.9-5.5V184c0-13.3-10.7-24-24-24s-24 10.7-24 24v14.4l-52.9-74.1C496 86.5 452.4 64 405.9 64H272 256 192 144C77.7 64 24 117.7 24 184v54C9.4 249.8 0 267.8 0 288v17.6c0 8 6.4 14.4 14.4 14.4C46.2 320 72 294.2 72 262.4V256 224 184c0-24.3 12.1-45.8 30.5-58.9C98.3 135.9 96 147.7 96 160v64zM560 336a16 16 0 1 1 32 0 16 16 0 1 1 -32 0zM166.6 166.6c-4.2-4.2-6.6-10-6.6-16c0-12.5 10.1-22.6 22.6-22.6H361.4c12.5 0 22.6 10.1 22.6 22.6c0 6-2.4 11.8-6.6 16l-23.4 23.4C332.2 211.8 302.7 224 272 224s-60.2-12.2-81.9-33.9l-23.4-23.4z" />
        </svg></span>

      <span class="CowStatInfo">Total</span><span class="CowStatValue">
        <?php echo count($allCows) ?>
      </span>
    </div>
    <div>


      <!-- Healthy -->
      <span class="CowStatIcon"><svg xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
          <path
            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
        </svg></span><span class="CowStatInfo">Healthy</span><span class="CowStatValue">0</span>
    </div>
    <div>

      <!-- Sick -->
      <span class="CowStatIcon"><svg xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 640 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
          <path
            d="M192 0c13.3 0 24 10.7 24 24V37.5c0 35.6 43.1 53.5 68.3 28.3l9.5-9.5c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-9.5 9.5C293 124.9 310.9 168 346.5 168H360c13.3 0 24 10.7 24 24s-10.7 24-24 24H346.5c-35.6 0-53.5 43.1-28.3 68.3l9.5 9.5c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-9.5-9.5C259.1 293 216 310.9 216 346.5V360c0 13.3-10.7 24-24 24s-24-10.7-24-24V346.5c0-35.6-43.1-53.5-68.3-28.3l-9.5 9.5c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l9.5-9.5C91 259.1 73.1 216 37.5 216H24c-13.3 0-24-10.7-24-24s10.7-24 24-24H37.5c35.6 0 53.5-43.1 28.3-68.3l-9.5-9.5c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l9.5 9.5C124.9 91 168 73.1 168 37.5V24c0-13.3 10.7-24 24-24zm48 224a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm-48-64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm320 80c0 33 39.9 49.5 63.2 26.2c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6C574.5 312.1 591 352 624 352c8.8 0 16 7.2 16 16s-7.2 16-16 16c-33 0-49.5 39.9-26.2 63.2c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0C551.9 446.5 512 463 512 496c0 8.8-7.2 16-16 16s-16-7.2-16-16c0-33-39.9-49.5-63.2-26.2c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6C417.5 423.9 401 384 368 384c-8.8 0-16-7.2-16-16s7.2-16 16-16c33 0 49.5-39.9 26.2-63.2c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0C440.1 289.5 480 273 480 240c0-8.8 7.2-16 16-16s16 7.2 16 16zm0 112a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
        </svg></span><span class="CowStatInfo">Sick</span>

      <span class="CowStatValue">0</span>
    </div>



    <!-- Pregnant -->
    <div>


      <span class="CowStatIcon"><svg xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 384 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
          <path
            d="M192 0a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM120 383c-13.8-3.6-24-16.1-24-31V296.9l-4.6 7.6c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c15-24.9 40.3-41.5 68.7-45.6c4.1-.6 8.2-1 12.5-1h1.1 12.5H192c1.4 0 2.8 .1 4.1 .3c35.7 2.9 65.4 29.3 72.1 65l6.1 32.5c44.3 8.6 77.7 47.5 77.7 94.3v32c0 17.7-14.3 32-32 32H304 264v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384h-8-8v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V383z" />
        </svg></span><span class="CowStatInfo">Pregnant</span><span class="CowStatValue">0</span>
    </div>

  </div>

  <!-- </div> -->
  <!-- Separated the cards and footer view from the main dashboard page -->
  <!-- Cards.php has the cards function now just including it here now -->
  <!-- Footer.php has the Footer function now just including it here now -->
  <h1 class="MainDashBoardHeadings">Search</h1>
  <form class="d-flex SearchBar" id="searchCow">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
    <button class="btn btn-outline-success">Search</button>
  </form>

  <h1 class="MainDashBoardHeadings">Cattles List</h1>
  <?php

  //Cards is optional
  include("cards.php");

  ?>


  <script>
    // Get the search input element
    const searchInput = document.querySelector('.SearchBar input');
    console.log(searchInput);

    // Add event listener to the search input for keyup event
    searchInput.addEventListener('keyup', function () {
      const searchValue = searchInput.value.toLowerCase();
      const dietCards = document.querySelectorAll('.cardCont');

      console.log(dietCards);

      dietCards.forEach(function (card) {
        const title = card.querySelector('.card-title').innerText.toLowerCase();
        const text = card.querySelector('.card-text').innerText.toLowerCase();

        console.log(title, text);
        if (title.includes(searchValue) || text.includes(searchValue)) {
          card.style.display = 'block'; // Display the card if the search text is found
        } else {
          card.style.display = 'none'; // Hide the card if the search text is not found
        }
      });
    })
  </script>