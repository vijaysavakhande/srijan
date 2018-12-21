(function ($, Handlebars){
  'use strict';
  $(document).ready(function () {
    // dynamically add dictionay words
    $('#number_tests').on('blur', function (e) {
      e.preventDefault();      
      var number_tests = $(this).val();
      var html = '';
      var html_source = $('#fieldset_html').html();
      var template = Handlebars.compile(html_source);
      for (var i = 1; i <= number_tests; i++) {
        html += template({ index:i});
      }
      $('.query_wrapper').empty().html(html);
    });    
  });
})(jQuery, Handlebars);