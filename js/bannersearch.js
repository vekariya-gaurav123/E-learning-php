$(document).ready(function () {

  // Function to toggle clear icon
  function toggleClear() {
    if ($("#search").val().length > 0) {
      $("#clear-search").show();
    } else {
      $("#clear-search").hide();
    }
  }

  // Initial check (in case input has pre-filled text)
  toggleClear();

  // When typing in search input
  $("#search").on("input", function () {
    toggleClear();
  });

  // Clear button click
  $("#clear-search").on("click", function () {
    $("#search").val("").focus();
    toggleClear();
  });

  // Search button click → redirect to courses.php
  $("#search-btn").on("click", function () {
    var query = $("#search").val().trim();
    if (query.length > 0) {
       // clear input BEFORE redirect
      $("#search").val("");
      toggleClear();
      
      window.location.href = "courses.php?search=" + encodeURIComponent(query);
    }
  });

  // Press Enter to trigger search button
  $("#search").on("keypress", function(e) {
    if (e.which == 13) {
      $("#search-btn").click();
    }
  });

});
