var helpTour = {
    restart: helpTourRestart,
    start: helpTourStart,
    tour: helpTour()
};

function helpTour(){
    var tour = new Tour({
        name: "help_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: helpTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-help",
        placement: "bottom",
        title: "Need help? Start tour",
        content: "Once the tour has started you will guided through the interface and its features. You can view this tour anytime you wish. "
      }
    ]);
    tour.init();

    return tour;
}

function helpTourTemplate(i, step){
    return "<div class='popover tour'> \
      <div class='arrow'></div> \
      <div style='padding: 9px 14px;'> \
        <h5>" + step.title + "</h5> \
        <div>" + step.content + "</div> \
      </div> \
      <div class='popover-navigation'> \
        <button class='btn btn-sm btn-default' data-role='end'>Close</button> \
        <div class='clearfix'></div> \
      </div> \
    </div>"
}

function helpTourRestart(){
    helpTour.tour.restart();
}

function helpTourStart(){
    helpTour.tour.start();
}

/*$(document).ready(function($) {
    $(".btn-save-org").on('click', function() {
        organizationTour.tour.end();
    });
});
*/
