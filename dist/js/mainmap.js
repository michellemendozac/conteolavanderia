(function ($) {
    "use strict";

    var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');

    $('.scrollertodo').slimScroll({
        height: '475px', 
        color: '#8f8f8f' 
    }); 

})(jQuery);
