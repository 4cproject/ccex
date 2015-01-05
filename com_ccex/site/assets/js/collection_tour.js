var newCollectionTour = {
    restart: restartNewCollectionTour,
    start: startNewCollectionTour,
    tour: newCollTour()
};

function newCollTour(){
    var tour = new Tour({
        name: "new_collection_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: collTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-coll-scope",
        placement: "bottom",
        title: "Scope",
        content: "You may not want to give cost information about the whole organisation, but just for a single department, project or even cost data set. Please describe the scope here."
      },
      {
        element: ".tour-step.tour-step-coll-name-description",
        placement: "bottom",
        title: "Name and description",
        content: "Please enter a name for the cost data set. Optionally you can share/provide additional informations about your cost data set."
      },
      {
        element: ".tour-step.tour-step-coll-interval",
        placement: "bottom",
        title: "Year span",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },   
      {
        element: ".tour-step.tour-step-coll-year",
        placement: "bottom",
        title: "Begin year and duration",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },   
      {
        element: ".tour-step.tour-step-coll-staff",
        placement: "bottom",
        title: "Curation staff",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },      
      {
        element: ".tour-step.tour-step-coll-data-volume",
        placement: "bottom",
        title: "Data volume",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },      
      {
        element: ".tour-step.tour-step-coll-number-of-copies",
        placement: "bottom",
        title: "Number of copies",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },        
      {
        element: ".tour-step.tour-step-coll-unformatted-text-info",
        placement: "bottom",
        title: "Asset information",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-slider",
        placement: "bottom",
        title: "Map with slider",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-value",
        placement: "bottom",
        title: "Map manually",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-cost-units",
        placement: "top",
        title: "Cost units",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-add-cost-unit",
        placement: "left",
        title: "Add new cost unit",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-save",
        placement: "top",
        title: "Save cost data set",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      }
    ]);
    tour.init();

    return tour;
}

var partialCollectionTour = {
    restart: restartPartialCollectionTour,
    start: startPartialCollectionTour,
    tour: parcialEditCollTour()
};

function parcialEditCollTour(){
    var tour = new Tour({
        name: "parcial_edit_collection_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: collTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-coll-cost-view",
        placement: "bottom",
        title: "Cost unit",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-cost-edit",
        placement: "bottom",
        title: "Edit cost unit",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-add-cost-unit",
        placement: "left",
        title: "Add new cost unit",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-save",
        placement: "top",
        title: "Save cost data set",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      }
    ]);
    tour.init();

    return tour;
}

var editCollectionTour = {
    restart: restartPartialCollectionTour,
    start: startPartialCollectionTour,
    tour: editCollTour()
};

function editCollTour(){
    var tour = new Tour({
        name: "parcial_edit_collection_tour",
        backdrop: true,
        backdropPadding: 10,
        orphan: true,
        template: collTourTemplate
    });

    tour.addSteps([
      {
        element: ".tour-step.tour-step-coll-scope",
        placement: "bottom",
        title: "Scope",
        content: "You may not want to give cost information about the whole organisation, but just for a single department, project or even cost data set. Please describe the scope here."
      },
      {
        element: ".tour-step.tour-step-coll-name-description",
        placement: "bottom",
        title: "Name and description",
        content: "Please enter a name for the cost data set. Optionally you can share/provide additional informations about your cost data set."
      },
      {
        element: ".tour-step.tour-step-coll-interval",
        placement: "bottom",
        title: "Year span",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },   
      {
        element: ".tour-step.tour-step-coll-year",
        placement: "bottom",
        title: "Begin year and duration",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },   
      {
        element: ".tour-step.tour-step-coll-staff",
        placement: "bottom",
        title: "Curation staff",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },      
      {
        element: ".tour-step.tour-step-coll-data-volume",
        placement: "bottom",
        title: "Data volume",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },      
      {
        element: ".tour-step.tour-step-coll-number-of-copies",
        placement: "bottom",
        title: "Number of copies",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },        
      {
        element: ".tour-step.tour-step-coll-unformatted-text-info",
        placement: "bottom",
        title: "Asset information",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-slider",
        placement: "bottom",
        title: "Map with slider",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-value",
        placement: "bottom",
        title: "Map manually",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-cost-units",
        placement: "top",
        title: "Cost units",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-cost-view",
        placement: "bottom",
        title: "Cost unit",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-add-cost-unit",
        placement: "left",
        title: "Add new cost unit",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      },
      {
        element: ".tour-step.tour-step-coll-save",
        placement: "top",
        title: "Save cost data set",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
      }
    ]);
    tour.init();

    return tour;
}

function restartNewCollectionTour(){
    newCollectionTour.tour.restart();
}

function startNewCollectionTour(){
    newCollectionTour.tour.start();
}

function restartPartialCollectionTour(){
    partialCollectionTour.tour.restart();
}

function startPartialCollectionTour(){
    partialCollectionTour.tour.start();
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



/*$(document).ready(function($) {
    $(".btn-save-org").on('click', function() {
        organizationTour.tour.end();
    });
});
*/
