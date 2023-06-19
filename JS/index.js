//Mode Change Logic
$("body").ready(function () {
  
  
  let mode = document.querySelector(".mode");
  let modeLocalStorage = localStorage.getItem("mode");
  let body = document.querySelector("body");

  if (modeLocalStorage == null) {
    localStorage.setItem("mode", "light");

   
      body.classList.remove("dtheme_body");
      body.classList.add("ltheme_body");
      mode.innerHTML = `<span class="icon"><i class="lni lni-night"></i></span> Dark Mode`;

  }

  else {
    if (modeLocalStorage == "dark") {
      mode.innerHTML = `<span class="icon"><i class="lni lni-sun"></i></span> Light Mode`;
      body.classList.remove("ltheme_body");
      body.classList.add("dtheme_body");
    }
    else {
      body.classList.remove("dtheme_body");
      body.classList.add("ltheme_body");
      mode.innerHTML = `<span class="icon"><i class="lni lni-night"></i></span> Dark Mode`;
    }
  }


  mode.addEventListener("click", function () {
    let body = document.querySelector("body");

    if (body.classList.contains("dtheme_body")) {
      body.classList.remove("dtheme_body");
      body.classList.add("ltheme_body");
      mode.innerHTML = `<span class="icon"><i class="lni lni-night"></i></span> Dark Mode`;
      localStorage.setItem("mode","light");
      return;
    }

    mode.innerHTML = `<span class="icon"><i class="lni lni-sun"></i></span> Light Mode`;
    body.classList.remove("ltheme_body");
    body.classList.add("dtheme_body");
    localStorage.setItem("mode","dark");
  });
});