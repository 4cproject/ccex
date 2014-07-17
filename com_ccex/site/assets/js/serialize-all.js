(function ($) {
  $.fn.serializeAll = function () {
    var data = $(this).serializeArray();
          
    $(':disabled[name]', this).each(function () { 
        if($(this).is(':checkbox') && $(this).is(':checked')){
            data.push({ name: this.name, value: $(this).val() });
        }
    });
      
    return data;
  }
})(jQuery);
