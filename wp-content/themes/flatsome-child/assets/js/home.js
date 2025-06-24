jQuery(document).ready(function ($) {
  // Chặn scroll khi trang tải
  document.body.classList.add("no-scroll");
  // Tạo hiệu ứng fade-out sau 2 giây
  setTimeout(() => {
    const loadingContainer = document.querySelector(".loading-container");
    loadingContainer.classList.add("hide"); // Thêm class để kích hoạt hiệu ứng mờ
    document.body.classList.remove("no-scroll");
  }, 3000); // Sau 2 giây
  // Carousel banner
  $(".section-banner >.section-content").slick({
    slidesToShow: 1,
    dots: true,
    arrows: false,
    fade: true,
    cssEase: "linear",
    autoplay: true,
    autoplaySpeed: 3000,
    pauseOnHover: false,
  });
  // Carousel danh sách đối tác
  $(".section-partners .list-partners").slick({
    slidesToShow: 6.5,
    autoplay: true,
    autoplaySpeed: 0,
    speed: 3000,
    cssEase: "linear",
    infinite: true, // Chạy liên tục mà không dừng lại
    arrows: false,
    dots: false,
    pauseOnHover: false,
    pauseOnFocus: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 3,
          infinite: true,
          dots: true,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 3,
        },
      },
    ],
  });
  // Hàm countup với thời gian đếm trong 1 giây
  function countUp(element, target) {
    return new Promise((resolve) => {
      let current = 0;
      const duration = 300; // Tổng thời gian đếm (1 giây)
      const steps = 10; // Số bước đếm
      const increment = Math.ceil(target / steps); // Bước nhảy mỗi lần
      const intervalTime = duration / steps; // Thời gian mỗi bước

      const interval = setInterval(() => {
        current += increment;
        if (current >= target) {
          current = target; // Đảm bảo không vượt số đích
          clearInterval(interval);
          resolve(); // Kết thúc countup
        }
        element.textContent = current; // Cập nhật số hiển thị
      }, intervalTime); // Tốc độ mỗi bước
    });
  }

  // Hàm fadeInUp + countup cho từng cụm
  async function fadeInAndCountUp(item, counterClass) {
    return new Promise((resolve) => {
      // Thêm lớp 'visible' để kích hoạt fadeInUp
      item.classList.add("visible");

      // Thực hiện countup sau khi fadeInUp
      const numberElement = item.querySelector(`.${counterClass}`);
      const target = parseInt(numberElement.textContent, 10);

      // Gọi countUp và chờ hoàn thành
      countUp(numberElement, target).then(() => {
        setTimeout(resolve, 300); // Delay thêm để hoàn thiện fadeInUp
      });
    });
  }

  // Xử lý hiệu ứng khi user scroll tới section
  async function handleScrollSequential() {
    const section = document.querySelector(".section-countup-numbers ");
    const items = document.querySelectorAll(".col.item");
    const rect = section.getBoundingClientRect();

    // Nếu section nằm trong viewport và chưa xử lý
    if (
      rect.top < window.innerHeight &&
      !section.classList.contains("processed")
    ) {
      section.classList.add("processed"); // Đánh dấu đã xử lý

      // Lặp qua từng cụm và xử lý tuần tự
      let counterIndex = 1;
      for (const item of items) {
        await fadeInAndCountUp(item, `counter-${counterIndex}`);
        counterIndex++;
      }
    }
  }

  // Lắng nghe sự kiện scroll
  window.addEventListener("scroll", handleScrollSequential);
});
