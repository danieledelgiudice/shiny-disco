/* global $ */

(function() {
    
    $('#backButton').click(() => {
    window.history.back();
    });
    
    $(".link-row").click(function() {
        window.location = $(this).data("href");
    });
    
    $(".link-row").hover(function() {
        $(this).addClass('info');
    }, function() {
        $(this).removeClass('info');
    });
    
    $('.input-group.date').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        language: "it",
        todayBtn: "linked",
        autoclose: true
    });
    
})();
