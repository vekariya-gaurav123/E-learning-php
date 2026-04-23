<!-- auto reaload on forward backward using browser arrow -->
<script>
  $(window).on("pageshow", function (event) {
    if (event.originalEvent.persisted) {
      // Reload only if page was cached
      window.location.reload(true);
    }
  });
</script>

<!-- jQuery and Bootstrap JS -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<!-- Font Awesome JS (only if needed for SVG/JS icons) -->
<script type="text/javascript" src="../js/all.min.js"></script>

<!-- Admin Ajax call JavaScript -->
<script type="text/javascript" src="../js/adminajaxrequest.js"></script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>
