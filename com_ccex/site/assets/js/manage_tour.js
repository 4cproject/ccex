var emptyManageTour = {
    restart: restartEmptyManageTour,
    start: startEmptyManageTour,
    tour: emptyManTour()
};

function emptyManTour(){
    var tour = new Tour({
        name: "empty_manage_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: manTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-man-add-cost",
        placement: "right",
        title: "Add new cost data set",
        content: "To compare costs an organisation needs at least one cost data set."
      }
    ]);
    tour.init();

    return tour;
}

var notEmptyManageTour = {
    restart: restartNotEmptyManageTour,
    start: startNotEmptyManageTour,
    tour: notEmptyManTour()
};

function notEmptyManTour(){
    var tour = new Tour({
        name: "not_empty_manage_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: manTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-man-collection",
        placement: "top",
        title: "Cost data set",
        content: "This page shows your cost data set(s) and the cost units."
      },
      {
        element: ".tour-step.tour-step-man-collection-final",
        placement: "left",
        title: "Finalise cost data set",
        content: "Switch to Final when you’re ready, to compare your cost data set with others. You can return to Draft mode anytime you want update your costs."
      },
      {
        element: ".tour-step.tour-step-man-collection-edit",
        placement: "left",
        title: "Edit cost data set",
        content: "Click here to edit your cost data set."
      },
      {
        element: ".tour-step.tour-step-man-analyse",
        placement: "left",
        title: "Analyse and compare costs",
        content: "See the summary of your submitted costs and compare them with other organisation. Only “Final” cost data sets can be analysed."
      }
    ]);
    tour.init();

    return tour;
}

function manTourTemplate(i, step){
    return "<div class='popover tour'> \
      <div class='arrow'></div> \
      <div style='padding: 9px 14px;'> \
        <button type='button' class='close' data-role='end' aria-label='End tour'><span aria-hidden='true'>&times;</span></button> \
        <h5>" + step.title + "</h5> \
        <div>" + step.content + "</div> \
      </div> \
      <div class='popover-navigation'> \
        <button class='btn btn-sm btn-default' data-role='prev'><i class='fa fa-angle-left'></i> Previous</button> \
        <button class='btn btn-sm btn-success pull-right' data-role='next'>Next step <i class='fa fa-angle-right'></i></button> \
      </div> \
    </div>";
}

function restartNotEmptyManageTour(){
    notEmptyManageTour.tour.restart();
}

function startNotEmptyManageTour(){
    notEmptyManageTour.tour.start();
}

function restartEmptyManageTour(){
    emptyManageTour.tour.restart();
}

function startEmptyManageTour(){
    emptyManageTour.tour.start();
}

$(document).ready(function($) {
    $(".btn-add-coll").on('click', function() {
        emptyManageTour.tour.end();
    });

    $(".btn-analyse").on('click', function() {
        notEmptyManageTour.tour.end();
    });
});
