$('.slider').slick({
  dots: false,
  infinite: true,
  speed: 300,
  pauseOnHover: false,
  autoplay: true,
  autoplaySpeed: 2500,
  slidesToShow: 1,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
$('.review-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  pauseOnHover: false,
  autoplay: true,
  autoplaySpeed: 2500,
  slidesToShow: 2,
  slidesToScroll: 2,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
document.getElementById("appointmentForm").addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent form from submitting

  if (this.checkValidity()) {
    var successModal = new bootstrap.Modal(document.getElementById("successModal"));
    successModal.show(); // Show modal only if form is valid
    this.reset(); // Reset the form fields
  } else {
    this.classList.add("was-validated"); // Show validation errors
  }
});