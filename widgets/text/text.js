$(document).ready(function() {

    // Small delay so things load properly
    setTimeout(function () {
        summernoteLoadText();
    }, 200);

});

function summernoteLoadText() {
    //pageName = $(".summernote").parent().find('input[name=pageName]').val();

    pageNames.forEach(function(item, index) {
        pageName = item;
        $(".widget-container[id=1][class*=page-" + pageName + "]").find(".summernote").load('widgets/text/' + pageName + "/" + (1) + ".txt");
        $(".widget-container[id=2][class*=page-" + pageName + "]").find(".summernote").load('widgets/text/' + pageName + "/" + (2) + ".txt");
        $(".widget-container[id=3][class*=page-" + pageName + "]").find(".summernote").load('widgets/text/' + pageName + "/" + (3) + ".txt");
        $(".widget-container[id=4][class*=page-" + pageName + "]").find(".summernote").load('widgets/text/' + pageName + "/" + (4) + ".txt");
    });


}