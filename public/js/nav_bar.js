const hamburger = document.querySelector(".hamburger");
const buttons = document.querySelector(".buttons");

const barsIcon = document.querySelector(".fa-bars");
const xIcon = document.querySelector(".fa-x");

const navHeight = document.querySelector("nav").offsetHeight;
// Ustawienie top na wysokość nawigacji
buttons.style.top = navHeight - 1 + "px";

function toggleIcons() {
  // kod zamieniający ikony fa-bars i fa-x
  if (hamburger.classList.contains("active")) {
    barsIcon.style.display = "none";
    xIcon.style.display = "inline-block";
  } else {
    barsIcon.style.display = "inline-block";
    xIcon.style.display = "none";
  }
}

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  buttons.classList.toggle("active");
  toggleIcons();
});

document.querySelectorAll(".buttons").forEach((n) =>
  n.addEventListener("click", () => {
    hamburger.classList.remove("active");
    buttons.classList.remove("active");
    toggleIcons();
  })
);
