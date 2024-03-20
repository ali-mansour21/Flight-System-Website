let scrollCounter = 0;
const hero = document.getElementsByClassName("hero");

const card = document.getElementById("image-card");
const back = document.getElementById("image-bck");
let page = 0;

let lastScrollPosition = window.scrollY;

let scrollDirectionElement;

window.addEventListener("scroll", function () {
  let currentScrollPosition = window.scrollY;

  if (currentScrollPosition > lastScrollPosition) {
    scrollDirectionElement = "Down";

    if (this.window.scrollY > 100) {
      switch (page) {
        case 0:
          card.classList.add("fade-out");
          back.classList.add("fade-out");
          setTimeout(() => {
            card.src = "../../assets/bookig-page/card-2.webp";
            back.src = "../../assets/bookig-page/bck-2.webp";
            card.classList.remove("fade-out");
            back.classList.remove("fade-out");
            page = 1;
            window.scrollTo(0, 0);
          }, 500);
          break;

        case 1:
          card.classList.add("fade-out");
          back.classList.add("fade-out");
          setTimeout(() => {
            card.src = "../../assets/bookig-page/card-3.png";
            back.src = "../../assets/bookig-page/bck-3.webp";
            card.classList.remove("fade-out");
            back.classList.remove("fade-out");
            page = 2;
            window.scrollTo(0, 0);
          }, 500);
          break;
        case 2:
          this.scrollTo(0, 600);
          page = 3;
          console.log(window.scrollY);
          break;

        default:
          break;
      }
    }
  } else {
    scrollDirectionElement = "Up";
  }

  lastScrollPosition = currentScrollPosition;
});
