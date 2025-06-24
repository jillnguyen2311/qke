jQuery(document).ready(function ($) {
  // Carousel banner
  $(".custom-banner-gallery").slick({
    slidesToShow: 1,
    dots: true,
    arrows: true,
    fade: true,
    cssEase: "linear",
    autoplay: true,
    autoplaySpeed: 5000,
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const accordionItems = document.querySelectorAll(
    ".custom-product-accordion .custom-accordion-item"
  );

  accordionItems.forEach((item) => {
    const title = item.querySelector(".custom-accordion-title");
    title.addEventListener("click", () => {
      // Bật/tắt accordion hiện tại
      item.classList.toggle("active");
    });
  });
});
