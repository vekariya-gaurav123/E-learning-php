$(document).ready(function () {
    function loadCourses() {
        const query     = $("#search").val();
        const categories = $("input[name='category[]']:checked").map(function(){return this.value;}).get();
        const price      = $("input[name='price']:checked").val();
        const duration   = $("input[name='duration']:checked").val();

        $.ajax({
            url: "search_course.php",
            method: "POST",
            data: { query, categories, price, duration },
            success: function (data) {
                $("#course-list").html(data);
            }
        });
    }

    // Show/Hide clear icon
    function toggleClear() {
        $("#search").val().length > 0 ? $("#clear-search").show() : $("#clear-search").hide();
    }

    // Check input on load
    toggleClear();

    // When typing
    $("#search").on("input", function () {
        toggleClear();
        loadCourses();
    });

    // Clear search icon click
    $("#clear-search").on("click", function () {
        $("#search").val("");
        $(this).hide();
        loadCourses();
    });

    // Apply filters
    $("#apply-filters").on("click", function () {
        loadCourses();
    });

    // Clear filters
    $("#clear-filters").on("click", function () {
        $("input[type='checkbox']").prop("checked", false);
        $("input[name='price'][value='']").prop("checked", true);
        $("input[name='duration'][value='']").prop("checked", true);
        // $("#search").val(""); // No need to clear search input here
        // $("#clear-search").hide(); // Hide clear icon
        loadCourses();
    });

    // ✅ Initial load (including pre-filled search from ?search=...)
    toggleClear();
    loadCourses();
});
