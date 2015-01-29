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
    var template = "<div class='popover tour'> \
      <div class='arrow'></div> \
      <div style='padding: 9px 14px;'> \
        <button type='button' class='close' data-role='end' aria-label='End tour'><span aria-hidden='true'>&times;</span></button> \
        <h5>" + step.title + "</h5> \
        <div>" + step.content + "</div> \
      </div> \
      <div class='popover-navigation'> \
        <button class='btn btn-sm btn-default' data-role='prev'><i class='fa fa-angle-left'></i> Previous</button> ";
    
    if(step.next == -1){
        template += "<button class='btn btn-sm btn-success pull-right' data-role='end'>End tour</button>";
    }else{
        template += "<button class='btn btn-sm btn-success pull-right' data-role='next'>Next step <i class='fa fa-angle-right'></i></button>";
    }

    template += "</div> \
    </div>";

    return template;
}

function helpTourRestart(){
    helpTour.tour.restart();
}

function helpTourStart(){
    helpTour.tour.start();
}

$(document).ready(function($) {
    $(".tour-step.tour-step-help").on('click', function() {
        helpTour.tour.end();
    });
});

