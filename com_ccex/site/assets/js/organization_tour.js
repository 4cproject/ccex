var organizationTour = {
    restart: orgTourRestart,
    start: orgTourStart,
    tour: orgTour()
};

function orgTour(){
    var tour = new Tour({
        name: "organization_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: orgTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-org-name",
        placement: "bottom",
        title: "Organisation name",
        content: "Please add here the name of your organisation, institution or employer.<br><br>Tip: You can do it while one this help tour!"
      },
      {
        element: ".tour-step.tour-step-org-description",
        placement: "bottom",
        title: "Description, purpose and mission",
        content: "You can provide additional information about your organization, like what it does and for what purpose and a short mission statement."
      },
      {
        element: ".tour-step.tour-step-org-type",
        placement: "bottom",
        title: "Organisation types",
        content: "Then you need to select your organization types so we can pair your organisation with others.<br><br>Please select 'other' if you don't have your organization type listed.",
        onNext: function (tour) {
            if($("#organisation_type_other_container").is(":visible")){
                tour.goTo(tour.getCurrentStep()+1);
            }else{
                tour.goTo(tour.getCurrentStep()+2);
            }
            return (new jQuery.Deferred()).promise();
        }
      },
      {
        element: ".tour-step.tour-step-org-type-other",
        placement: "bottom",
        title: "Other type",
        content: "Provide a short description of your organisation type, we will consider adding it to the list above."
      },
      {
        element: ".tour-step.tour-step-org-country",
        placement: "bottom",
        title: "Country",
        content: "Select the country where the organisation's headquarters are located.",
        onPrev: function (tour) {
            if($("#organisation_type_other_container").is(":visible")){
                tour.goTo(tour.getCurrentStep()-1);
            }else{
                tour.goTo(tour.getCurrentStep()-2);
            }
            return (new jQuery.Deferred()).promise();
        }
      },
      {
        element: ".tour-step.tour-step-org-currency",
        placement: "bottom",
        title: "Currency",
        content: "Indicate the currency in which you would prefer to provide costs. We will automatically convert the cost into Euros (€) to have a common comparison currency. This conversion is based on yearly convert rates.<br><br>Can't find your currency? Contact us and we will consider adding it."
      },
      {
        element: ".tour-step.tour-step-org-sharing",
        placement: "top",
        title: "Information sharing",
        content: "Please review your information sharing options."
      },
      {
        element: ".tour-step.tour-step-org-save",
        placement: "right",
        title: "Save your organisation",
        content: "Congratulations you have finished the help tour! Click save to submit your data and go to the next step.",
        next: -1
      }
    ]);

    tour.init();

    return tour;
}

function orgTourTemplate(i, step){
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

function orgTourRestart(){
    organizationTour.tour.restart();
}

function orgTourStart(){
    organizationTour.tour.start();
}

$(document).ready(function($) {
    $(".btn-save-org").on('click', function() {
        organizationTour.tour.end();
    });
});
