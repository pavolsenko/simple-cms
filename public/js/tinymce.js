$(document).ready(function () {
    tinymce.init({
        selector: "textarea.editable",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        forced_root_block : "div"
    });


    $('#category-multiselect').multiSelect();

// Cache selectors outside callback for performance.
    var $window = $(window),
        $stickyEl = $('#admin-toolbar'),
        elTop = $stickyEl.offset().top + 50;

    $window.scroll(function() {
        $stickyEl.toggleClass('sticky', $window.scrollTop() > elTop);
    });
});
