/* global $*/

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
    
    $('.table-filterable td[data-field-select]').click(function() {
        var field_select = $(this).data('field-select');
        var value = $(this).data('field-id');
        
        var params = parseQueryString();
        params[field_select] = value;
        var queryString = $.param(params);
        
        window.location.search = queryString;
    });
    
    (function() {
        var params = parseQueryString();
        $('.table-filterable input[type=text]').each(function() {
            var name = $(this).attr('name');
            if (params[name])
                $(this).attr('value', params[name]);
        });
        
        $('.table-filterable select').each(function() {
            var name = $(this).attr('name');
            if (params[name]) {
                $(this).children(`[value=${params[name]}]`).attr('selected', 'selected');
            }
        });
    })();
    
    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    });
    
    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {
    
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
    
            if( input.length ) {
                input.val(log);
            }
        });
    });
    
    $('input[type=radio][name=tipologia]').change(function() {
        if ($(this).val() == 0)
            $('#label_data_azione').text('Consegnato il');
        else
            $('#label_data_azione').text('Restituito il');
    });
    
    $('#elenco-errori li').each(function() {
        var fieldName = $(this).text();
        $(`label[for=${fieldName}]`).addClass('text-danger');
    });
    
    $('#clienteDestroyConfirm').click(function() {
        $('#clienteDestroyForm').submit(); 
    });
    
    $('#toggleImportanteBtn').click(function() {
        $('#toggleImportanteForm').submit(); 
    });
    
    $('#praticaDestroyConfirm').click(function() {
        $('#praticaDestroyForm').submit(); 
    });
    
    
    $('.showDocumentoDestroyModal').click(function() {
        var id_documento = $(this).data('documento');
        $('#documentoDestroyConfirm').data('documento', id_documento);
    });
    
    $('#documentoDestroyConfirm').click(function() {
        var documento = $(this).data('documento');
        console.log(documento);
        var formSelector = `#documento${documento}DestroyForm`;
        $(formSelector).submit();
    });
    
    
    $('.showAssegnoDestroyModal').click(function() {
        var id_assegno = $(this).data('assegno');
        $('#assegnoDestroyConfirm').data('assegno', id_assegno);
    });
    
    $('#assegnoDestroyConfirm').click(function() {
        var assegno = $(this).data('assegno');
        var formSelector = `#assegno${assegno}DestroyForm`;
        $(formSelector).submit();
    });
    
    
    $('.showCompagniaDestroyModal').click(function() {
        var id_compagnia = $(this).data('compagnia');
        $('#compagniaDestroyConfirm').data('compagnia', id_compagnia);
    });
    
    $('#compagniaDestroyConfirm').click(function() {
        var compagnia = $(this).data('compagnia');
        var formSelector = `#compagnia${compagnia}DestroyForm`;
        $(formSelector).submit();
    });
    
    $('[data-toggle="tooltip"]').tooltip();
    
    $('select:not([data-selecttype])').selectize({
        sortField: 'text',
    });
    
    $('#professione_id, #autorita_id').selectize({
        sortField: 'text',
        create: true,
        createOnBlur: true,
        persist: false,
        render: {
            option_create: function(data, escape) {
              return '<div class="create">Aggiungi <strong>' + escape(data.input) + '</strong>&hellip;</div>';
            }
        }
    });
    
    $('select[data-selecttype="assicurazioni"]').selectize({
        sortField: 'text',
        searchField: ['text', 'indirizzo'],
        render: {
            option: function(item, escape) {
                var label = item.text;
                var caption = item.indirizzo;
                return '<div>' +
                    '<strong>' + escape(label) + '</strong><br>' +
                    (caption ? '<small class="caption">' + escape(caption) + '</small>' : '') +
                '</div>';
            },
            item: function(item, escape) {
                var label = item.text;
                var caption = item.indirizzo;
                return '<div>' +
                    '<strong>' + escape(label) + '</strong><br>' +
                    (caption ? '<small class="caption">' + escape(caption) + '</small>' : '') +
                '</div>';
            },
        }
    });
    
})();