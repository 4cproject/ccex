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
        content: "Here you will see the year and the duration that you enter on the tab. When e.g. the amount of staff changes after this year span, you can add another span by clicking the + sign."
      },   
      {
        element: ".tour-step.tour-step-coll-year",
        placement: "bottom",
        title: "Begin year and duration",
        content: "The tool calculates the costs per year. Here you indicate how many years the cost data sets involves. The default is one year."
      },   
      {
        element: ".tour-step.tour-step-coll-staff",
        placement: "bottom",
        title: "Curation staff",
        content: "How many staff is involved? Please normalise this to Full Time Equivalents (FTE)."
      },      
      {
        element: ".tour-step.tour-step-coll-data-volume",
        placement: "bottom",
        title: "Data volume",
        content: "The tool calculates the costs per Gigabyte of stored data. For this you have to indicate the data volume in GB, TB or PB."
      },      
      {
        element: ".tour-step.tour-step-coll-number-of-copies",
        placement: "bottom",
        title: "Number of copies",
        content: "Indicate the number of copies you have for each digital asset within the scope. The original does not count as a copy, only backup copies or replicas. If your organisation has a different number of copies policy dependending on the value of the assets, please provide the number closer to the average within the scope."
      },        
      {
        element: ".tour-step.tour-step-coll-unformatted-text-info",
        placement: "bottom",
        title: "Asset information",
        content: "Select here the type(s) of digital objects and indicate their proportion in the scope. Use the 'i' icons for more detailed information."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-slider",
        placement: "bottom",
        title: "Map with slider",
        content: "You can use the slider to indicate the share of each asset type."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-value",
        placement: "bottom",
        title: "Map manually",
        content: "Alternatively, you can click and enter the exact value for each asset type. The total cannot exceed the data volume on top of the page."
      },
      {
        element: ".tour-step.tour-step-coll-cost-units",
        placement: "top",
        title: "Cost units",
        content: "Your cost data set probably consists of a few cost units, such as various steps in a curation process. Enter them here and see their share in the total costs."
      },
      {
        element: ".tour-step.tour-step-coll-add-cost-unit",
        placement: "left",
        title: "Add new cost unit",
        content: "Click here to add a cost unit."
      },
      {
        element: ".tour-step.tour-step-coll-save",
        placement: "top",
        title: "Save cost data set",
        content: "When you want to add another cost unit within the current scope, click the right-hand button. 'Save and close' takes you to the overview of your cost data sets."
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
        element: ".tour-step.tour-step-coll-cost-edit",
        placement: "bottom",
        title: "Edit cost unit",
        content: "Click here to edit your cost unit."
      },
      {
        element: ".tour-step.tour-step-coll-add-cost-unit",
        placement: "left",
        title: "Add new cost unit",
        content: "Click here to add a cost unit."
      },
      {
        element: ".tour-step.tour-step-coll-save",
        placement: "top",
        title: "Save cost data set",
        content: "When you want to add another cost unit within the current scope, click the right-hand button. 'Save and close' takes you to the overview of your cost data sets."
      }
    ]);
    tour.init();

    return tour;
}

var editCollectionTour = {
    restart: restartEditCollectionTour,
    start: startEditCollectionTour,
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
        content: "Here you will see the year and the duration that you enter on the tab. When e.g. the amount of staff changes after this year span, you can add another span by clicking the + sign."
      },   
      {
        element: ".tour-step.tour-step-coll-year",
        placement: "bottom",
        title: "Begin year and duration",
        content: "The tool calculates the costs per year. Here you indicate how many years the cost data sets involves. The default is one year."
      },   
      {
        element: ".tour-step.tour-step-coll-staff",
        placement: "bottom",
        title: "Curation staff",
        content: "How many staff is involved? Please normalise this to Full Time Equivalents (FTE)."
      },      
      {
        element: ".tour-step.tour-step-coll-data-volume",
        placement: "bottom",
        title: "Data volume",
        content: "The tool calculates the costs per Gigabyte of stored data. For this you have to indicate the data volume in GB, TB or PB."
      },      
      {
        element: ".tour-step.tour-step-coll-number-of-copies",
        placement: "bottom",
        title: "Number of copies",
        content: "Indicate the number of copies you have for each digital asset within the scope. The original does not count as a copy, only backup copies or replicas. If your organisation has a different number of copies policy dependending on the value of the assets, please provide the number closer to the average within the scope."
      },        
      {
        element: ".tour-step.tour-step-coll-unformatted-text-info",
        placement: "bottom",
        title: "Asset information",
        content: "Select here the type(s) of digital objects and indicate their proportion in the scope. Use the 'i' icons for more detailed information."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-slider",
        placement: "bottom",
        title: "Map with slider",
        content: "You can use the slider to indicate the share of each asset type."
      },
      {
        element: ".tour-step.tour-step-coll-unformatted-text-value",
        placement: "bottom",
        title: "Map manually",
        content: "Alternatively, you can click and enter the exact value for each asset type. The total cannot exceed the data volume on top of the page."
      },
      {
        element: ".tour-step.tour-step-coll-cost-units",
        placement: "top",
        title: "Cost units",
        content: "Your cost data set probably consists of a few cost units, such as various steps in a curation process. Enter them here and see their share in the total costs."
      },
      {
        element: ".tour-step.tour-step-coll-cost-edit",
        placement: "bottom",
        title: "Edit cost unit",
        content: "Click here to edit your cost unit."
      },
      {
        element: ".tour-step.tour-step-coll-add-cost-unit",
        placement: "left",
        title: "Add new cost unit",
        content: "Click here to add a cost unit."
      },
      {
        element: ".tour-step.tour-step-coll-save",
        placement: "top",
        title: "Save cost data set",
        content: "When you want to add another cost unit within the current scope, click the right-hand button. 'Save and close' takes you to the overview of your cost data sets."
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

function restartEditCollectionTour(){
    editCollectionTour.tour.restart();
}

function startEditCollectionTour(){
    editCollectionTour.tour.start();
}

function collTourTemplate(i, step){
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



/*$(document).ready(function($) {
    $(".btn-save-org").on('click', function() {
        organizationTour.tour.end();
    });
});
*/
