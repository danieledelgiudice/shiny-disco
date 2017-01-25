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

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // Widget input date
    $('.input-group.date').datepicker({
        format: 'dd/mm/yyyy',
        weekStart: 1,
        language: 'it',
        todayBtn: 'linked',
    });

    
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
    
    
    $('#history-back-btn').click(function() {
        window.history.back();
    });
    
    $('.alert.auto-slide').delay(5000).slideUp(350);
    
    $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
    });
    
    $('#genera-lettera-btn').click(function() {
        var url = $(this).data('url');
        var selected = $('#select-tipo-lettera option:selected').val();
        url = url.replace('*', selected);
        
        var logo_radio = $('input[type=radio][name=logo]:checked');
        if (logo_radio.length && logo_radio.val() === '1') {
            url += '?logo=1';
        }
        
        window.location = url;
    });
    
    $("#queryForm").off('submit').submit(function(e) {
        e.preventDefault();
        
        $('#queryBtn').prop('disabled', true);
        $('#queryBtn i').removeClass('fa-search');
        $('#queryBtn i').addClass('fa-spin fa-refresh');
        
        var queryData = $(this).serializeArray();
        console.log(queryData);
        
        $.ajax({
            type     : "POST",
            cache    : false,
            url      : $(this).attr('action'),
            data     : $.param(queryData),
            success  : function(data) {
                $("#queryResult").empty().append(data);
                
                $('#queryBtn i').removeClass('fa-spin fa-refresh');
                $('#queryBtn i').addClass('fa-search');
                $('#queryBtn').prop('disabled', false);
            }
        });
    });
    
    $('#newFieldQuerySelect').change(function() {
        var name = $(this).val();
        
        var selectize = $(this).selectize()[0].selectize;
        selectize.clear(true);
        

        if ($(this).closest('form').find(`input[name=${name}]`).length > 0 ||
            $(this).closest('form').find(`input[name=${name}\\[\\]]`).length > 0 ||
            $(this).closest('form').find(`select[name=${name}]`).length > 0)
            return;

        var display = queryFields[name].display;
        var type = queryFields[name].type;
        var newRow = '';
        
        if (type === 'string') {
            newRow = `
            <div class="form-group">
                <label for="${name}" class="col-md-3 control-label">${display}</label>
                <div class="col-md-7">
                    <input type="text" name="${name}" class="form-control"> 
                </div>
                <a class="btn btn-default deleteQueryRow"><i class="fa fa-fw fa-times"></i></a>
            </div>`;
        } else if (type === 'date') {
            newRow = `
            <div class="form-group">
                <label for="${name}" class="col-md-2 col-md-offset-1 control-label">${display}</label>
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default operatorBtn" type="button"><i class="fa fa-chevron-left"></i></button>
                            <input type="hidden" name="${name}[]" class="operatorInput" value="lt">
                        </span>
                        <input class="form-control date-control" name="${name}[]" type="text" value="" id="${name}">
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    </div>
                </div>
                <a class="btn btn-default deleteQueryRow"><i class="fa fa-fw fa-times"></i></a>
            </div>`;
        } else if (type === 'decimal') {
            newRow = `
            <div class="form-group">
                <label for="${name}" class="col-md-2 col-md-offset-1 control-label">${display}</label>
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default operatorBtn" type="button"><i class="fa fa-chevron-left"></i></button>
                            <input type="hidden" name="${name}[]" class="operatorInput" value="lt">
                        </span>
                        <input class="form-control" name="${name}[]" type="text" value="" id="${name}">
                        <span class="input-group-addon"><i class="fa fa-fw fa-eur"></i></span>
                    </div>
                </div>
                <a class="btn btn-default deleteQueryRow"><i class="fa fa-fw fa-times"></i></a>
            </div>`;
        } else if (type === 'enum') {
            var list = queryFields[name].list;
            var options = $.map(list, function(v, k) {
               return `<option value="${k}">${v}</option>`; 
            }).join('');
            newRow = `
            <div class="form-group">
                <label for="${name}" class="col-md-2 col-md-offset-1 control-label">${display}</label>
                <div class="col-md-7">
                    <select class="form-control" name="${name}">
                    <option></option>
                    ${options}
                    </select>
                </div>
                <a class="btn btn-default deleteQueryRow"><i class="fa fa-fw fa-times"></i></a>
            </div>`;
        } else if (type === 'rel') {
            var list = queryFields[name].list;
            var options = $.map(list, function(v, k) {
               return `<option value="${k}">${v}</option>`; 
            }).join('');
            newRow = `
            <div class="form-group">
                <label for="${name}" class="col-md-2 col-md-offset-1 control-label">${display}</label>
                <div class="col-md-7">
                    <select class="form-control" name="${name}">
                    <option></option>
                    ${options}
                    </select>
                </div>
                <a class="btn btn-default deleteQueryRow"><i class="fa fa-fw fa-times"></i></a>
            </div>`;
        }
        
        $(this).closest('.form-group').before(newRow);
        
        // Widget input date
        $('.input-group .date-control').datepicker({
            format: 'dd/mm/yyyy',
            weekStart: 1,
            language: 'it',
            todayBtn: 'linked',
        });
        
        $('.operatorBtn').click(function() {
            $(this).children('i').toggleClass('fa-chevron-left').toggleClass('fa-chevron-right');
            var opInput = $(this).siblings('.operatorInput');
            if (opInput.val() === 'lt')
                opInput.val('gt');
            else
                opInput.val('lt');
        });
    });
    
    $('.queryPanel .panel-body').on('click', 'a.deleteQueryRow', function() {
        var row = $(this).closest('.form-group');
        row.slideUp("fast", function() { $(this).remove(); } );
    });
    
    $('.queryPanel .panel-heading').click(function() {
        $(this).children('i').toggleClass('fa-caret-down').toggleClass('fa-caret-up');
        var body = $(this).siblings('.panel-body');
        body.slideToggle();
    });
        
    // // Filtri tabella quando clicchi
    // $('.table-filterable td[data-field]').click(function() {
    //     var field = $(this).data('field');
    //     var value = $(this).text();
        
    //     var params = parseQueryString();
    //     params[field] = value;
    //     var queryString = $.param(params);
        
    //     window.location.search = queryString;
    // });
    
    // $('.table-filterable td[data-field-select]').click(function() {
    //     var field_select = $(this).data('field-select');
    //     var value = $(this).data('field-id');
        
    //     var params = parseQueryString();
    //     params[field_select] = value;
    //     var queryString = $.param(params);
        
    //     window.location.search = queryString;
    // });
    
    // // Riempio campi input in base alla query della pagina
    // (function() {
    //     var params = parseQueryString();
    //     $('.table-filterable input[type=text]').each(function() {
    //         var name = $(this).attr('name');
    //         if (params[name])
    //             $(this).attr('value', params[name]);
    //     });
        
    //     $('.table-filterable select').each(function() {
    //         var name = $(this).attr('name');
    //         if (params[name]) {
    //             $(this).children(`[value=${params[name]}]`).attr('selected', 'selected');
    //         }
    //     });
    // })();
    
})();