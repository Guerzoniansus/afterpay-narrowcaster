var pageName = "";

// Selected widget container index (1, 2, 3 or 4)
var selectedContainer = 0;

function loadWidgets() {
    $("#widget-containers-container").load("../contenthandler.php", {action: "loadWidgets", pageName: pageName, edit: true})
}

function hideOverlay() {
    $(".overlay").hide();
}

function stuffToDoLikeSavingBeforeThePageGetsReloaded() {
    summernoteSaveAll();
}

/**
 * HEY, YOU! YOU THERE! ========== HEY LISTEN ====================
 * If you do addWidget("empty") it's the same thing as deleting a widget, NO NEED FOR EXTRA COMPLICATED CODE
 * @param widgetName
 */
function addWidget(widgetName) {

    $.post("../pagehandler.php", {
        action: "addWidget",
        pageName: pageName,
        widgetName, widgetName,
        widgetIndex: selectedContainer
    }, function() {
        stuffToDoLikeSavingBeforeThePageGetsReloaded();

        location.reload();
    });
    //TODO: Error checking? Maybe later
}

$(document).ready(function() {

    // Page name gets inserted into hidden input through PHP and GET parameter in the url
    // If page exists:
    if ($("#pageNameHiddenInput").val()) {
        pageName = $("#pageNameHiddenInput").val();
        loadWidgets();
    }


    hideOverlay();

    $(document).on('click', '.add-widget-plus-button', function() {
        selectedContainer = $(this).attr("id");
        $("#overlay-widget-select").show();
    });

    $(document).on('click', '.widget-img', function() {
        var widgetName = $(this).attr("id");
        hideOverlay();
        addWidget(widgetName);
    });

    /**
     * Hide setting overlay menus when clicking outside of it
     */
    $(document).mouseup(function(e)
    {
        var container = $("#widget-select");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            hideOverlay();
        }
    });

});