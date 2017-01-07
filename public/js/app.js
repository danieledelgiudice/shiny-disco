/* global $ */

var parseQueryString = function() {
    var match, urlParams,
        pl     = /\+/g,  // Regex for replacing addition symbol with a space
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
        query  = window.location.search.substring(1);

    urlParams = {};
    while (match = search.exec(query))
       urlParams[decode(match[1])] = decode(match[2]);
    return urlParams;
};

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
        
        var params = parseQueryString();
        params[field] = value;
        var queryString = $.param(params);
        
        window.location.search = queryString;
    });
    
    (function() {
        var params = parseQueryString();
        $('.table-filterable input[type=text]').each(function() {
            console.log($(this));
            var name = $(this).attr('name');
            if (params[name])
                $(this).attr('value', params[name]);
        });
    })();
    
})();