//Mode Change Logic
$("body").ready(function () {
  let mode = document.querySelector(".mode");
  let modeLocalStorage = localStorage.getItem("mode");
  let body = document.querySelector("body");
  let navbar = document.querySelector(".navbar");

  if (modeLocalStorage == null) {
    localStorage.setItem("mode", "light");

    body.classList.remove("dtheme_body");
    body.classList.add("ltheme_body");
    mode.innerHTML = `<span class="icon"><i class="lni lni-night"></i></span> Dark Mode`;
    if (navbar != null) {
      navbar.classList.add("navbar-ligth");
    }
  } else {
    if (modeLocalStorage == "dark") {
      mode.innerHTML = `<span class="icon"><i class="lni lni-sun"></i></span> Light Mode`;
      body.classList.remove("ltheme_body");
      body.classList.add("dtheme_body");
      if (navbar != null) {
        navbar.classList.remove("navbar-ligth");
        navbar.classList.add("navbar-dark");
      }
    } else {
      body.classList.remove("dtheme_body");
      body.classList.add("ltheme_body");
      mode.innerHTML = `<span class="icon"><i class="lni lni-night"></i></span> Dark Mode`;
      if (navbar != null) {
        navbar.classList.remove("navbar-dark");
        navbar.classList.add("navbar-light");
      }
    }
  }

  mode.addEventListener("click", function () {
    let body = document.querySelector("body");

    if (body.classList.contains("dtheme_body")) {
      body.classList.remove("dtheme_body");
      body.classList.add("ltheme_body");
      mode.innerHTML = `<span class="icon"><i class="lni lni-night"></i></span> Dark Mode`;
      localStorage.setItem("mode", "light");
      if (navbar != null) {
        navbar.classList.remove("navbar-dark");
        navbar.classList.add("navbar-ligth");
      }
      return;
    }

    mode.innerHTML = `<span class="icon"><i class="lni lni-sun"></i></span> Light Mode`;
    body.classList.remove("ltheme_body");
    body.classList.add("dtheme_body");
    localStorage.setItem("mode", "dark");
    if (navbar != null) {
      navbar.classList.remove("navbar-ligth");
      navbar.classList.add("navbar-dark");
    }
  });

  // Side Bar Logic

  let sidebar = document.querySelector(".wrapperSideBar");
  let options = document.querySelector(".btnOptions");
  let closeBtn = document.querySelector(".closeOptionsBtn");

  options.addEventListener("click", function () {
    if (sidebar.classList.contains("activeSideBar")) {
      sidebar.classList.remove("activeSideBar");
      return;
    }

    sidebar.classList.add("activeSideBar");
  });

  closeBtn.addEventListener("click", function () {
    sidebar.classList.remove("activeSideBar");
  });
});
