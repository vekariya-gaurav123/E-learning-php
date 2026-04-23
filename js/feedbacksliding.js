$(function () {
  let index = 0;
  const $inner = $("#feedbackInner");
  const $cards = $("#feedbackInner .card");
  const total = $cards.length;
  const visible = 3;
  let autoSlide;

  function showSlide() {
    const offset = -(index * (100 / visible));
    $inner.css("transform", "translateX(" + offset + "%)");
  }

  function nextSlide() {
    index++;
    if (index > total - visible) index = 0;
    showSlide();
  }

  function prevSlide() {
    index--;
    if (index < 0) index = total - visible;
    showSlide();
  }

  function startAuto() {
    autoSlide = setInterval(nextSlide, 3000);
  }

  function stopAuto() {
    clearInterval(autoSlide);
  }

  $("#fbNext").click(function () {
    stopAuto();
    nextSlide();
    startAuto();
  });

  $("#fbPrev").click(function () {
    stopAuto();
    prevSlide();
    startAuto();
  });

  // Pause on hover and resume from first card
  $("#feedbackSlider").hover(
    function () {
      stopAuto();
    },
    function () {
      index = 0; // Reset to first card
      showSlide();
      startAuto();
    }
  );

  startAuto();
});
