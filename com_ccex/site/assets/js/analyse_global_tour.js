var analyseGlobalTour = {
    restart: restartAnalyseGlobalTour,
    start: startAnalyseGlobalTour,
    tour: globalTour()
};

function globalTour(){
    var tour = new Tour({
        name: "analyse_global_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: globalTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-global-tabs",
        placement: "bottom",
        title: "Analyse and compare costs",
        content: "The tab 'My costs' gives a visual summary of your cost data. The other tabs compare your costs with the average costs in the tool ('Global') and with a single organisation ('Peer')."
      },
      {
        element: ".tour-step.tour-step-global-select-set",
        placement: "bottom",
        title: "Select cost data sets",
        content: "If you have several cost data sets, you can select which to include here. "
      },   
      {
        element: ".tour-step.tour-step-global-manage-costs",
        placement: "right",
        title: "Manage cost data sets",
        content: "Click here if you want to edit your costs."
      },   
      {
        element: ".tour-step.tour-step-global-edit-organization",
        placement: "right",
        title: "Edit organisation",
        content: "Characteristics of your organisation may affect the comparison. Click here if you want to edit your organisation profile."
      },   
      {
        element: ".tour-step.tour-step-global-filters",
        placement: "bottom",
        title: "Filter organisations or data sets",
        content: "Your costs are compared to an average of costs submitted by other organisations. You can filter on certain characteristics, provided there are at least five organisations with these characteristics."
      },  
      {
        element: ".tour-step.tour-step-global-activities",
        placement: "top",
        title: "Activities",
        content: "This graph takes an average total spend for all years and either compares an aggregated figure for all your data sets or selected data sets, with other cost data sets shared with the CCEx.<br><br>The comparison is done in terms of activity categories: pre-ingest, ingest, archival storage and access."
      },   
      {
        element: ".tour-step.tour-step-global-purchases",
        placement: "top",
        title: "Purchases and staff",
        content: "This graph takes an average total spend for all years and either compares an aggregated figure for all your data sets or selected data sets, with other cost data sets shared with the CCEx.<br><br>The comparison is done in terms of purchase categories: hardware, software and external 3rd party services; staff categories: producer, IT-developer, operations, preservation specialist and manager; and also into overhead."
      },   
      {
        element: ".tour-step.tour-step-global-go-peer",
        placement: "left",
        title: "Peer comparison",
        content: "Compare your costs with a single organisation."
      },
      {
        element: ".tour-step.tour-step-global-go-self",
        placement: "right",
        title: "My costs",
        content: "See a visual summary of your cost data."
      }
    ]);
    tour.init();

    return tour;
}


function restartAnalyseGlobalTour(){
    analyseGlobalTour.tour.restart();
}

function startAnalyseGlobalTour(){
    analyseGlobalTour.tour.start();
}

function globalTourTemplate(i, step){
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

$(document).ready(function($) {
    $(".tour-step-global-tabs li").on('click', function() {
        analyseGlobalTour.tour.end();
    });

    $(".btn-go").on('click', function() {
        analyseGlobalTour.tour.end();
    });
});
