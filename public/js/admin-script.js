$(document).ready(function () {

    // tiny mce wysiwyg editor on textareas
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

    // better multiselect for categories
    $('#category-multiselect').multiSelect();

    // sticky toolbar in post editor
    var $stickyEl = $('#admin-toolbar');
    if ($stickyEl.length > 0) {
        elTop = $stickyEl.offset().top + 50;
        var $window = $(window);
        $window.scroll(function () {
            $stickyEl.toggleClass('sticky', $window.scrollTop() > elTop);
        });
    }

    // close editor after submitting
    $('#close-after-submit').click(function () {
        $('input[name=close]').val('1');
        $('form').submit();
    });

    // datepickers
    $('.datepicker').datepicker({
        showWeek: false,
        firstDay: 1
    });

});
