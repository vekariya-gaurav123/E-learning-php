$(document).ready(function () {
    // Clear error message when typing
    $("#stuname").on("input", function () {
        $("#statusMsg1").html("");
    });

    $("#stuemail").on("input", function () {
        $("#statusMsg2").html("");
    });

    $("#stupass").on("input", function () {
        $("#statusMsg3").html("");
    });

    // ✅ AJAX call for Already EXISTING EMAIL verification
    $("#stuemail").on("blur", function () {
        var reg = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/;
        var stuemail = $("#stuemail").val().trim();

        if (stuemail !== "" && reg.test(stuemail)) {
            $.ajax({
                url: "Student/addstudent.php",
                method: "POST",
                data: {
                    checkemail: "checkmail",
                    stuemail: stuemail,
                },
                success: function (data) {
                    data = parseInt($.trim(data)); // 🔥 trim spaces/newlines
                    if (data != 0) {
                        $("#statusMsg2").html(
                            '<small style="color:red;">Email ID Already used !</small>'
                        );
                        $("#signup").attr("disabled", true);
                    } else {
                        $("#statusMsg2").html(
                            '<small style="color:green;">Available !</small>'
                        );
                        $("#signup").attr("disabled", false);
                    }
                },
            });
        }
    });
});

// Function to add student
function addstu() {
    var reg = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/;
    var stuname = $("#stuname").val();
    var stuemail = $("#stuemail").val();
    var stupass = $("#stupass").val();

    // Checking form fields on submission
    if (stuname.trim() == "") {
        $("#statusMsg1").html(
            '<small style="color: red;">Please Enter Your Name !</small>'
        );
        $("#stuname").focus();
        return false;
    } else if (stuemail.trim() == "") {
        $("#statusMsg2").html(
            '<small style="color: red;">Please Enter Your Email !</small>'
        );
        $("#stuemail").focus();
        return false;
    } else if (stuemail.trim() != "" && !reg.test(stuemail)) {
        $("#statusMsg2").html(
            '<small style="color: red;">Please Enter Valid Email e.g. example@mail.com</small>'
        );
        $("#stuemail").focus();
        return false;
    } else if (stupass.trim() == "") {
        $("#statusMsg3").html(
            '<small style="color: red;">Please Enter Your Password !</small>'
        );
        $("#stupass").focus();
        return false;
    } else {
        $.ajax({
            url: "Student/addstudent.php",
            method: "POST",
            dataType: "json",
            data: {
                stusignup: "stusignup",
                stuname: stuname,
                stuemail: stuemail,
                stupass: stupass,
            },
            success: function (data) {
                if (data == 1) {
                    $("#successMsg").html(
                        "<span class='alert alert-success'>Registration successful!</span>"
                    );

                    setTimeout(() => {
                        $("#stuRegModalCenter").modal("hide");
                        clearStuRegField();
                        location.reload();
                    }, 1500);
                } else if (data == "Failed") {
                    $("#successMsg").html(
                        "<span class='alert alert-danger'>Registration failed! Please try again.</span>"
                    );
                }
            },
        });
    }
}

// Empty all fields
function clearStuRegField() {
    $("#stuRegForm").trigger("reset");
    $("#statusMsg1").html("");
    $("#statusMsg2").html("");
    $("#statusMsg3").html("");
}

// Empty all fields on closing student register modal
$('#stuRegModalCenter').on('hidden.bs.modal', function () {
    clearStuRegField();
    $("#successMsg").html("");
});

// Function to check student login
function checkStuLogin() {
    var stuLogEmail = $('#stuLogemail').val();
    var stuLogPass = $('#stuLogpass').val();

    $.ajax({
        url: "Student/addstudent.php",
        method: "POST",
        data: {
            checkLogemail: "checklogemail",
            stuLogEmail: stuLogEmail,
            stuLogPass: stuLogPass,
        },
        success: function (data) {
            data = $.trim(data); // 🔥 clean spaces/newlines
            if (data == "0") {
                $("#statusLogMsg").html(
                    '<span class="alert alert-danger">Invalid Email ID or Password !</span>'
                );
            } else if (data == "1") {
                $("#statusLogMsg").html(
                    '<span class="alert alert-success">Login successful!</span>'
                );
                setTimeout(() => {
                    $("#stuLoginModalCenter").modal("hide");
                    location.reload();
                }, 1500);
            }
        },
    });
}

// Empty all login fields
function clearStuLoginField() {
    $("#stuLoginForm").trigger("reset");
    $("#statusLogMsg").html("");
}

// Empty all fields on closing student login modal
$('#stuLoginModalCenter').on('hidden.bs.modal', function () {
    clearStuLoginField();
});


// For Student Signup - Press Enter
$('#stuRegForm').on('keypress', function (e) {
    if (e.which === 13) {
        e.preventDefault();
        $('#signup').click();
    }
});

// For Student Login - Press Enter
$('#stuLoginForm').on('keypress', function (e) {
    if (e.which === 13) {
        e.preventDefault();
        $('#stuLoginBtn').click();
    }
});


