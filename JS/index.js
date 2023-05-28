//Mode Change Logic
$(document).ready(function () {
    let mode = document.querySelector(".mode");
    mode.addEventListener("click", function () {
      let body = document.querySelector("body");

      if (body.classList.contains("dtheme_body")) {
        body.classList.remove("dtheme_body");
        body.classList.add("ltheme_body");
        mode.innerHTML = `<span class="icon"><i class="lni lni-night"></i></span> Dark Mode`;
        return;
      }

      mode.innerHTML = `<span class="icon"><i class="lni lni-sun"></i></span> Light Mode`;
      body.classList.remove("ltheme_body");
      body.classList.add("dtheme_body");
    });
  });