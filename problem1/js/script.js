(function($){
  'use strict';
  $(document).ready(function () {
    // dynamically add dictionay words
    $('#dictionay_count').on('blur',function (e) {
      e.preventDefault();
      var dictionay_count = $(this).val();      
      var dictionay_words = '';
      for (var i = 1; i <= dictionay_count; i++) {
        dictionay_words += '<div class="form-group"><label for="dictn_word' + i + '">' + i + ' Word</label> <input type="text" name="dictn_word[]" id="dictn_word' + i +'" maxlength="" class="form-control"></div>';
      }
      $('#dictionay_words').empty().html(dictionay_words);
    });
    // Charactor restictions dictionary words
    $('#char_count').on('blur',function (e) {
      e.preventDefault();
      var char_count = $(this).val();
      $('input[name="dictn_word[]"]').attr('maxlength', char_count);
    });
    $('#number_query').on('blur',function (e) {
      e.preventDefault();
      var query_count = $(this).val();
      console.log(query_count);
      var char_counts = $('#char_count').val();
      var query_options = '';
      for (var k = 1; k <= query_count; k++) {
        query_options += '<div class="form-group"><label for="query_option' + k + '">' + k + ' Query</label> <input type="text" name="query_option[]" id="query_option' + k + '" maxlength="' + char_counts+'" class="form-control"></div>';
      }
      $('#queries').empty().html(query_options);
    });
  });
})(jQuery);