function checkAdminLogin() {
    var adminLogEmail = $("#adminLogemail").val();
    var adminLogPass = $("#adminLogpass").val();
    $.ajax({
        url: "Admin/admin.php",
        method: "POST",
        data: {
            checkLogemail: "checklogemail",
            adminLogEmail: adminLogEmail,
            adminLogPass: adminLogPass,
        },
        success: function (data) {
            //console.log(data);
            if (data == 0) {
                $("#statusAdminLogMsg").html(
                    '<span class ="alert alert-danger">Invalid Email ID or Password !</span>'
                );
            } else if (data == 1) {
                $("#statusAdminLogMsg").html(
                    '<span class ="alert alert-success">Success Loading ... !</span>'
                );
                setTimeout(() => {
                    $("#adminLoginModalCenter").modal("hide");
                    window.location.href = "admin/adminDashboard.php";
                }, 1000);
            }
        }
    });

}
// Empty all login fields
function clearAdminLoginField() {
    $("#adminLoginForm").trigger("reset");
    $("#statusAdminLogMsg").html("");
}

// Empty all fields on closing student login modal
$('#adminLoginModalCenter').on('hidden.bs.modal', function () {
    clearAdminLoginField();
});

$(document).ready(function () {
    // For Admin Login - Press Enter
    $('#adminLoginForm').on('keydown', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#adminLoginBtn').click();
        }
    });
});