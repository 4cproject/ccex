(function ($) {
  $.fn.serializeAll = function () {
    var data = $(this).serializeArray();
          
    $(':disabled[name]', this).each(function () { 
        data.push({ name: this.name, value: $(this).val() });
    });
      
    return data;
  }
})(jQuery);
