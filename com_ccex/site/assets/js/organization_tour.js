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
        title: "Create your organization",
        content: "On this tour will be presented all the necessary steps to fill out the following profile information for your organisation to help identify your cost determinants and enable a comparison of costs against similar organisations."
      },
      {
        element: ".tour-step.tour-step-org-name",
        placement: "bottom",
        title: "Organisation name",
        content: "Start by adding here the name of your organisation, institution or employer."
      },
      {
        element: ".tour-step.tour-step-org-description",
        placement: "bottom",
        title: "Description, purpose and mission",
        content: "Optionally you can share/provide additional informations about your organization, by example: Is your organisation for example a National Library, an archive or a data centre? What is your organization's Mission?"
      },
      {
        element: ".tour-step.tour-step-org-type",
        placement: "bottom",
        title: "Organisation types",
        content: "Then, you need to select your organization types.<br><br>Please select 'other' if you don't have your organization type listed.",
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
        content: "Please describe here your organisation type."
      },
      {
        element: ".tour-step.tour-step-org-country",
        placement: "bottom",
        title: "Country",
        content: "Now you need to select in which country where the organisation's headquarters are located.",
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
        content: "In this step you need to indicate the currency in which you would prefer to provide costs."
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
        content: "Congratulations you have finished the tour! Click save to submit the fulfilled informations and to be able to define your organisation's cost data sets.",
        next: -1
      }
    ]);

    tour.init();

    return tour;
}

function orgTourTemplate(i, step){
    return "<div class='popover tour'> \
      <div class='arrow'></div> \
      <div style='padding: 9px 14px;'> \
        <h5>" + step.title + "</h5> \
        <div>" + step.content + "</div> \
      </div> \
      <div class='popover-navigation'> \
        <button class='btn btn-sm btn-default' data-role='prev'>« Prev</button> \
        <button class='btn btn-sm btn-primary' data-role='next'>Next »</button> \
        <button class='btn btn-sm btn-default' data-role='end'>End tour</button> \
      </div> \
    </div>"
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
