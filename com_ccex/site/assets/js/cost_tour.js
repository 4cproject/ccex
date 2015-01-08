var newCostUnitTour = {
    restart: restartNewCostUnitTour,
    start: startNewCostUnitTour,
    tour: newCostTour()
};

function newCostTour(){
    var tour = new Tour({
        name: "new_cost_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: costTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-cost-name-description",
        placement: "bottom",
        title: "Name and description",
        content: "Please enter a name for the cost unit. Optionally you can share/provide additional informations about your cost unit."
      },
      {
        element: ".tour-step.tour-step-cost-cost",
        placement: "bottom",
        title: "Cost",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },   
      {
        element: ".tour-step.tour-step-cost-activities-mapping",
        placement: "top",
        title: "Activities mapping",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      }, 
      {
        element: ".tour-step.tour-step-cost-purchases-staff-mapping",
        placement: "top",
        title: "Purchases and staff mapping",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },     
      {
        element: ".tour-step.tour-step-cost-save",
        placement: "right",
        title: "Save cost unit",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      }
    ]);
    tour.init();

    return tour;
}


function restartNewCostUnitTour(){
    newCostUnitTour.tour.restart();
}

function startNewCostUnitTour(){
    newCostUnitTour.tour.start();
}

function costTourTemplate(i, step){
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

$(document).ready(function($) {
    $(".btn-save-cost").on('click', function() {
        newCostUnitTour.tour.end();
    });
});

