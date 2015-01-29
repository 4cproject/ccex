var analyseSelfTour = {
    restart: restartAnalyseSelfTour,
    start: startAnalyseSelfTour,
    tour: selfTour()
};

function selfTour(){
    var tour = new Tour({
        name: "analyse_self_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: selfTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-self-tabs",
        placement: "bottom",
        title: "Analyse and compare costs",
        content: "The tab 'My costs' gives a visual summary of your cost data. The other tabs compare your costs with the average costs in the tool ('Global') and with a single organisation ('Peer')."
      },
      {
        element: ".tour-step.tour-step-self-select-set",
        placement: "bottom",
        title: "Select cost data sets",
        content: "If you have several cost data sets, you can select which to include here. "
      },   
      {
        element: ".tour-step.tour-step-self-manage-costs",
        placement: "right",
        title: "Manage cost data sets",
        content: "Click here if you want to edit your costs."
      },   
      {
        element: ".tour-step.tour-step-self-activities",
        placement: "top",
        title: "Activities",
        content: "This graph provides an overview of your aggregated costs from the data sets you selected in terms of activity categories: pre-ingest, ingest, archival storage and access."
      },   
      {
        element: ".tour-step.tour-step-self-purchases",
        placement: "top",
        title: "Purchases and staff",
        content: "This graph provides an overview of your aggregated costs from the data sets you selected in terms of purchase categories: hardware, software and external 3rd party services; staff categories: producer, IT-developer, operations, preservation specialist and manager; and also into overhead."
      },   
      {
        element: ".tour-step.tour-step-self-go-global",
        placement: "left",
        title: "Global comparison",
        content: "Compare your costs with the average costs in the tool."
      }
    ]);
    tour.init();

    return tour;
}


function restartAnalyseSelfTour(){
    analyseSelfTour.tour.restart();
}

function startAnalyseSelfTour(){
    analyseSelfTour.tour.start();
}

function selfTourTemplate(i, step){
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

$(document).ready(function() {
    $(".tour-step-self-tabs li").on('click', function() {
        analyseSelfTour.tour.end();
    });

    $(".btn-go").on('click', function() {
        analyseSelfTour.tour.end();
    });
});
