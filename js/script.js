function headerMobile() {
  const btnMobile = document.getElementById("btn-mobile");
  const btnAnchor = document.getElementsByClassName("menu__item");
  var countBtnAnchor = btnAnchor.length;

  function toggleMenu(event) {
    if (event.type === "touchstart") event.preventDefault();
    const nav = document.getElementById("nav");
    nav.classList.toggle("active");
    const active = nav.classList.contains("active");
    event.currentTarget.setAttribute("aria-expanded", active);
    if (active) {
      event.currentTarget.setAttribute("aria-label", "Close menu");
      document.body.style.overflow = "hidden";
    } else {
      event.currentTarget.setAttribute("aria-label", "Open Menu");
      document.body.style.overflow = "unset";
    }
  }
  btnMobile.addEventListener("click", toggleMenu);
  btnMobile.addEventListener("touchstart", toggleMenu);
  for (var i = 0; i < countBtnAnchor; i++) {
    btnAnchor[i].addEventListener("click", toggleMenu);
  }
}



headerMobile();


