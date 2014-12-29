var collectionTour = {
    restart: collTourRestart,
    start: collTourStart,
    tour: collTour()
};

function collTour(){
    var tour = new Tour({
        name: "collection_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: collTourTemplate
    });

    tour.addSteps([
      {
        title: "Add cost data set",
        content: "You now start a two-step process. On this page you enter information about your costs. On the next page, you enter the costs themselves.<br><br>On this tour will be presented all the necessary steps to add a new cost data set to your organisation."
      },
      {
        element: ".tour-step.tour-step-coll-scope",
        placement: "bottom",
        title: "Scope",
        content: "You may not want to give cost information about the whole organisation, but just for a single department, project or even cost data set. Please describe the scope here."
      },
      {
        element: ".tour-step.tour-step-coll-name",
        placement: "bottom",
        title: "Name",
        content: "Please enter a name for the cost data set"
      },
      {
        element: ".tour-step.tour-step-coll-description",
        placement: "bottom",
        title: "Description",
        content: "Optionally you can share/provide additional informations about your cost data set."
      },
    ]);
    tour.init();

    return tour;
}

function collTourTemplate(i, step){
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

function collTourRestart(){
    collectionTour.tour.restart();
}

function collTourStart(){
    collectionTour.tour.start();
}

/*$(document).ready(function($) {
    $(".btn-save-org").on('click', function() {
        organizationTour.tour.end();
    });
});
*/
