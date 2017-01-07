/* global $ */

(function() {

    // Widget input date
    $('.input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        weekStart: 1,
        language: 'it',
        todayBtn: 'linked',
    });
    
    // Filtri tabella
    $('.table-filterable td[data-field]').click(function() {
        var field = $(this).data('field');
        var value = $(this).text();
        
        var url = window.location.href;
        var mod = ((url.indexOf('?') > -1) ? '&' : '?');
        url = `${url}${mod}${field}=${value}`;
        
        window.location = url;
    });
    
})();
