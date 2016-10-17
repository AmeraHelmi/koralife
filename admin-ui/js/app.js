jQuery(document).ready(function($) {
  //cancel enter
  $('.addForm').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
  
  $('#tags').inputTags({
      autocomplete: {
          values: [],
          only: false
      },
      create: function() {
          console.log('Tag added !');
      }
  });

  $('#tags2').inputTags({
      autocomplete: {
          values: [],
          only: false
      },
      create: function() {
          console.log('Tag added !');
      }
  });
});
