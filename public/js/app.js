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
    
    $('.showPrestazioneMedicaDestroyModal').click(function() {
        var id_prestazioneMedica = $(this).data('prestazionemedica');
        $('#prestazioneMedicaDestroyConfirm').data('prestazionemedica', id_prestazioneMedica);
    });
    
    $('#prestazioneMedicaDestroyConfirm').click(function() {
        var prestazioneMedica = $(this).data('prestazionemedica');
        console.log(prestazioneMedica);
        var formSelector = `#prestazioneMedica${prestazioneMedica}DestroyForm`;
        $(formSelector).submit();
    });
    
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
        
        var options = $('.opzioni-lettere:not(.hide)');
        if (options.length > 0)
            url += '?';
        
        var logo_radio = options.find('input[type=radio][name=logo]:checked');
        if (logo_radio.length > 0 && logo_radio.val() === '1') {
            url += '&logo=1';
        }
        
        var num_inputs = options.find('input[type=number]');
        for (var i = 0; i < num_inputs.length; i++) {
            var $input = $(num_inputs[i]);
            var name = $input.attr('name');
            var value = $input.val();
            url += `&${name}=${value}`;
        }
        
        
        window.open(url, '_blank');
    });
    
        
    $('#select-tipo-lettera').selectize({
        sortField: 'text',
        render: {
            item: function (data, escape) {
                return '<div class="item" data-value="' + escape(data.value) + '" data-requires="' + escape(data.requires) + '">' + escape(data.text) + '</div>';
            }
        },
        onItemAdd: function(v, e) {
            var requires = e.data('requires');
            $('.opzioni-lettere').each(function() {
                var optionid = $(this).data('optionid');
                if (requires === optionid)
                    $(this).removeClass('hide');
                else
                    $(this).addClass('hide');
            });
        }
    });
    
    
    $("#queryForm").off('submit').submit(function(e) {
        e.preventDefault();
        
        $('#queryBtn').prop('disabled', true);
        $('#queryBtn i').removeClass('fa-search');
        $('#queryBtn i').addClass('fa-spin fa-refresh');
        
        var queryData = $(this).serializeArray();

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
        

        if ($(this).closest('form').find(`input[name="${name}"]`).length > 0 ||
            $(this).closest('form').find(`input[name="${name}\\[\\]"]`).length > 0 ||
            $(this).closest('form').find(`select[name="${name}"]`).length > 0)
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
    
    $('input[type=radio][name=inConvenzione]').change(function() {
        if ($(this).val() == "1")
            $('#group-inConvenzione').slideDown();
        else
            $('#group-inConvenzione').slideUp();
    });
    
    
    $('#toggleCanGenerateLettersBtn').click(function() {
        $('#toggleCanGenerateLettersForm').submit();
    });
    
    $(document).on('click', '.promemoriaUpdateBtn', function() {
        $modal = $('#promemoriaUpdateModal');
        var id = $(this).data('promemoria');
        var p = promemoria[id];
        $modal.find('input[name=chi]').val(p.chi);
        $modal.find('input[name=cosa]').val(p.cosa);
        
        var date = new Date(p.quando);
        var dd = date.getDate();
        var mm = date.getMonth()+1;
        var yyyy = date.getFullYear();
        
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        
        var date_h = dd+'/'+mm+'/'+yyyy;
        
        $modal.find('input[name=quando]').val(date_h);
        $('#promemoriaUpdateConfirm').data('promemoria', id);
    });
    
    $('#promemoriaUpdateConfirm').click(function() {
        var id = $(this).data('promemoria');
        var formSelector = `#promemoria${id}UpdateForm`;
        
        console.log()
        
        var $form = $(formSelector);
        
        var chi = $('#promemoriaUpdateModal').find('input[name=chi]').val();
        var quando = $('#promemoriaUpdateModal').find('input[name=quando]').val();
        var cosa = $('#promemoriaUpdateModal').find('input[name=cosa]').val();
        
        $form.find('input[name=chi]').val(chi);
        $form.find('input[name=quando]').val(quando);
        $form.find('input[name=cosa]').val(cosa);
        
        var $row = $form.closest('tr');
        
        $.ajax({
            type     : "POST",
            cache    : false,
            url      : $form.attr('action'),
            data     : $form.serializeArray(),
            success  : function(data) {
                $row.find('p[data-fieldName=chi]').text(data.chi);
                $row.find('p[data-fieldName=quando]').text(data.quando);
                $row.find('p[data-fieldName=cosa]').text(data.cosa);
                // cols[0].text(data.chi);
                // cols[1].text(data.quando);
                // cols[2].text(data.cosa);
            }
        });
        
        $('#promemoriaUpdateModal').modal('hide');
    })
    
})();