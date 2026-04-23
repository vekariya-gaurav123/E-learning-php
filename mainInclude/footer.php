<!-- start student registration -->
<!-- Modal -->
<div class="modal fade" id="stuRegModalCenter" tabindex="-1" aria-labelledby="stuRegModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stuRegModalCenterLabel">Student Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="stuRegCloseIcon">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- start student registration form -->
                <form id="stuRegForm">
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <label for="stuname" class="pl-2 font-weight-bold">Name</label>
                        <small id="statusMsg1"></small>
                        <input type="text" class="form-control" placeholder="Name" name="stuname"
                            id="stuname">
                    </div>
                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <label for="stuemail" class="pl-2 font-weight-bold">Email</label>
                        <small id="statusMsg2"></small>
                        <input type="email" class="form-control" placeholder="Email" name="stuemail"
                            id="stuemail">
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-key"></i>
                        <label for="stupass" class="pl-2 font-weight-bold">Password</label>
                        <small id="statusMsg3"></small>
                        <input type="password" class="form-control" placeholder="Password" name="stupass"
                            id="stupass">
                    </div>
                </form>

                <!-- login link -->
                <p class="mt-3 text-center">
                    <small style="font-size:15px;">
                        Already have an account?
                        <a href="#" id="openLoginFromSignup" class="text-success font-weight-bold">Login</a>
                    </small>
                </p>
                <!-- end student registration form -->
            </div>
            <div class="modal-footer">
                <span id="successMsg"></span>
                <button type="button" class="btn btn-success" onclick="addstu()" id="signup">Sign Up</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="stuRegCloseBtn">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end student registration -->

<!-- start student login -->
<!-- Modal -->
<div class="modal fade" id="stuLoginModalCenter" tabindex="-1" aria-labelledby="stuLoginModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stuLoginModalCenterLabel">Student Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="stuLoginCloseIcon">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- start student login form -->
                <form id="stuLoginForm">
                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <label for="stuLogemail" class="pl-2 font-weight-bold">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="stuLogemail"
                            id="stuLogemail">
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-key"></i>
                        <label for="stuLogpass" class="pl-2 font-weight-bold">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="stuLogpass"
                            id="stuLogpass">
                    </div>
                </form>

                <!-- sign up link -->
                <p class="mt-3 text-center">
                    <small style="font-size:15px;">
                        Don't have an account?
                        <a href="#" id="openSignupFromLogin" class="text-success font-weight-bold">Sign Up</a>
                    </small>
                </p>

                <!-- admin-login link -->
                <p class="mt-3 text-center">
                    <small style="font-size:15px;">
                        Are you Admin?
                        <a href="#" id="openAdminLoginFromLogin" class="text-success font-weight-bold">Admin Login</a>
                    </small>
                </p>
                <!-- end student login form -->
            </div>
            <div class="modal-footer">
                <span id="statusLogMsg"></span>
                <button type="button" class="btn btn-success" id="stuLoginBtn" onclick="checkStuLogin()">Login</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="stuLoginCloseBtn">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end student login -->

<!-- start admin login -->
<!-- Modal -->
<div class="modal fade" id="adminLoginModalCenter" tabindex="-1" aria-labelledby="adminLoginModalCenterLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminLoginModalCenterLabel">Admin Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="adminLoginCloseIcon">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- start admin login form -->
                <form id="adminLoginForm">
                    <div class="form-group">
                        <i class="fas fa-envelope"></i>
                        <label for="adminLogemail" class="pl-2 font-weight-bold">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="adminLogemail"
                            id="adminLogemail">
                    </div>
                    <div class="form-group">
                        <i class="fa-solid fa-key"></i>
                        <label for="adminLogpass" class="pl-2 font-weight-bold">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="adminLogpass"
                            id="adminLogpass">
                    </div>
                </form>

                <!-- studen-login link -->
                <p class="mt-3 text-center">
                    <small style="font-size:15px;">
                        You are Student?
                        <a href="#" id="openLoginFromAdminLogin" class="text-success font-weight-bold">Student Login</a>
                    </small>
                </p>
                <!-- ens admin login form -->
            </div>
            <div class="modal-footer">
                <span id="statusAdminLogMsg"></span>
                <button type="button" class="btn btn-success" id="adminLoginBtn"
                    onclick="checkAdminLogin()">Login</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="adminLoginCloseBtn">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end admin login -->

<!-- sinup and login scripts - 1 -->
<script>
    $(document).on('click', '#openSignupFromLogin', function (e) {
        e.preventDefault();
        $('#stuLoginModalCenter').modal('hide'); // close admin login modal
        $('#stuRegModalCenter').modal('show');   // open student signup modal
    });
</script>

<!-- sinup and login scripts - 2 -->
<script>
    $(document).on('click', '#openLoginFromSignup', function (e) {
        e.preventDefault();
        $('#stuRegModalCenter').modal('hide');   // close signup modal
        $('#stuLoginModalCenter').modal('show'); // open login modal
    });
</script>

<!-- login form redirect on admin login -->
<script>
    $(document).on('click', '#openAdminLoginFromLogin', function (e) {
        e.preventDefault();
        $('#stuLoginModalCenter').modal('hide');     // close student login modal
        $('#adminLoginModalCenter').modal('show');   // open admin login modal
    });
</script>

<!-- adminlogin redirect login page -->
<script>
    $(document).on('click', '#openLoginFromAdminLogin', function (e) {
        e.preventDefault();
        $('#adminLoginModalCenter').modal('hide');   // close admin login modal
        $('#stuLoginModalCenter').modal('show');     // open student login modal
    });
</script>

<!-- Page-specific JS -->
<?php
if (isset($extra_js) && is_array($extra_js)) {
    foreach ($extra_js as $js) {
        echo '<script src="' . $js . '"></script>' . "\n";
    }
}
?>

<!-- auto reaload on forward backward using browser arrow -->
<script>
  $(window).on("pageshow", function (event) {
    if (event.originalEvent.persisted) {
      // Reload only if page was cached
      window.location.reload(true);
    }
  });
</script>

<!-- jquery and bootstrap scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- font awesome js -->
<script src="js/all.min.js"></script>

<!-- student ajax call js -->
<script type="text/javascript" src="js/ajaxrequest.js"></script>

<!-- student ajax call js -->
<script type="text/javascript" src="js/adminajaxrequest.js"></script>

</body>

</html>