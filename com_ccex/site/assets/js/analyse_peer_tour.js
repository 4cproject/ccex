var analysePeerTour = {
    restart: restartAnalysePeerTour,
    start: startAnalysePeerTour,
    tour: peerTour()
};

function peerTour(){
    var tour = new Tour({
        name: "analyse_peer_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: peerTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-peer-tabs",
        placement: "bottom",
        title: "Analyse and compare costs",
        content: "The tab 'My costs' gives a visual summary of your cost data. The other tabs compare your costs with the average costs in the tool ('Global') and with a single organisation ('Peer')."
      },
      {
        element: ".tour-step.tour-step-peer-select-set",
        placement: "bottom",
        title: "Select cost data sets",
        content: "If you have several cost data sets, you can select which to include here. "
      },   
      {
        element: ".tour-step.tour-step-peer-manage-costs",
        placement: "right",
        title: "Manage cost data sets",
        content: "Click here if you want to edit your costs."
      },   
      {
        element: ".tour-step.tour-step-peer-edit-organization",
        placement: "right",
        title: "Edit organisation",
        content: "Characteristics of your organisation may affect the comparison. Click here if you want to edit your organisation profile."
      },   
      {
        element: ".tour-step.tour-step-peer-compare-other",
        placement: "right",
        title: "Compare with other peers",
        content: "The tool automatically selects the organisation that is most similar to you. Here you can make other choices.",
        onNext: function (tour) {
            if($("#request-contact-btn").length){
                tour.goTo(tour.getCurrentStep()+1);
            }else{
                tour.goTo(tour.getCurrentStep()+2);
            }
            return (new jQuery.Deferred()).promise();
        }
      },   
      {
        element: ".tour-step.tour-step-peer-contact",
        placement: "right",
        title: "Request contact",
        content: "Use this button to contact the peer organisation and start discussing costs."
      },   
      {
        element: ".tour-step.tour-step-peer-activities",
        placement: "top",
        title: "Activities",
        content: "This graph takes an average total spend for all years and either compares an aggregated figure for all your data sets or selected data sets, with cost data sets shared by the organisation most similar to yours.<br><br>The comparison is done in terms of activity categories: pre-ingest, ingest, archival storage and access.",
        onPrev: function (tour) {
            if($("#request-contact-btn").length){
                tour.goTo(tour.getCurrentStep()-1);
            }else{
                tour.goTo(tour.getCurrentStep()-2);
            }
            return (new jQuery.Deferred()).promise();
        }
      },   
      {
        element: ".tour-step.tour-step-peer-purchases",
        placement: "top",
        title: "Purchases and staff",
        content: "This graph takes an average total spend for all years and either compares an aggregated figure for all your data sets or selected data sets, with cost data sets shared by the organisation most similar to yours.<br><br>The comparison is done in terms of purchase categories: hardware, software and external 3rd party services; staff categories: producer, IT-developer, operations, preservation specialist and manager; and also into overhead."
      },
      {
        element: ".tour-step.tour-step-peer-go-understand",
        placement: "left",
        title: "Understand Costs",
        content: "Understand how to assess your curation costs and how to make use of cost models to help you invest."
      },   
      {
        element: ".tour-step.tour-step-peer-go-global",
        placement: "right",
        title: "Global comparison",
        content: "Compare your costs with the average costs in the tool."
      }
    ]);
    tour.init();

    return tour;
}


function restartAnalysePeerTour(){
    analysePeerTour.tour.restart();
}

function startAnalysePeerTour(){
    analysePeerTour.tour.start();
}

function peerTourTemplate(i, step){
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

$(document).ready(function() {
    $(".tour-step-peer-tabs li").on('click', function() {
        analysePeerTour.tour.end();
    });

    $(".btn-go").on('click', function() {
        analysePeerTour.tour.end();
    });
});
