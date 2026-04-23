<!-- auto reaload on forward backward using browser arrow -->
<script>
  $(window).on("pageshow", function (event) {
    if (event.originalEvent.persisted) {
      // Reload only if page was cached
      window.location.reload(true);
    }
  });
</script>

<!-- Jquery and Boostrap JavaScript -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<!-- Font Awesome JS -->
<script type="text/javascript" src="../js/all.min.js"></script>

<!-- Ajax Call JavaScript -->
<!-- <script type="text/javascript" src="..js/ajaxrequest.
js"></script> -->

<!-- Custom JavaScript -->
<script type="text/javascript" src="../js/custom.js"></script>
</body>

</html>