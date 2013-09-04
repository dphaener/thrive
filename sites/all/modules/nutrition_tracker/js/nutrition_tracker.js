jQuery(function($) {
  $.mask.definitions['h'] = "[a-zA-Z0-9 ]";
  $.mask.definitions['s'] = "[/a-zA-Z0-9 ]";
  $.mask.definitions['n'] = "[.0-9]";
  $(".item_name").mask("?hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh",{placeholder:" "});
  $(".serving_size").mask("?ssssssssssssssssssss",{placeholder:" "});
  $(".number_input").mask("?nnnn",{placeholder:" "});
});
