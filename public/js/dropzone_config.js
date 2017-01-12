/* global Dropzone */
(function() {
    Dropzone.options.myDropzone = {
      paramName: "documento", // The name that will be used to transfer the file
      maxFilesize: 10, // MB
      
      dictDefaultMessage: 'Clicca qua o trascina i documenti da caricare',
      dictFallbackMessage: 'Il tuo browser non supporta l\'upload tramite drag\'n\'drop',
      dictFallbackText: 'Per favore utilizza il form sottostante',
      dictInvalidFileType: 'Il tipo di file selezionato non è supportato',
      dictFileTooBig: 'Il file è troppo grande ({{filesize}}). La dimensione massima concessa é {{maxFilesize}}',
      dictResponseError: 'Si è verificato un errore durante il caricamento di questo file ({{statusCode}})',
      
      accept: function(file, done) {
        if (/.*?2\.\w{3,4}/i.test(file.name)) {
          done("Il file non ha un nome nel formato valido");
        }
        else { done(); }
      }
    };
})();