$(document).ready(function() {
    $("#separatedMode").on('change', function() {
        var checked = $(".collectionCheck:checked");
        var notChecked = $(".collectionCheck:not(:checked)");
        var allChecks =  $(".collectionCheck");
        
        if(this.checked) {
            if(checked.size() > 3){
                checked.removeAttr("disabled");
            }else{
                allChecks.removeAttr("disabled");
            }
        }
    });

    $("#combinedModeAll, #combinedModeFinal").on('change', function() {
        if(this.checked) {
            $(".collectionCheck").attr("disabled", true);
        }
    });

    $(".collectionCheck").on('change', function() {
        var checked = $(".collectionCheck:checked");
        var notChecked = $(".collectionCheck:not(:checked)");
        var allChecks =  $(".collectionCheck");

        if(checked.size()==0){
            $("#separatedMode").removeAttr("checked");

           allChecks.each(function( index, element ) {
                if(index < 3){
                    $(this).prop('checked', true);
                }
            });

            allChecks.attr("disabled", true);
            $("#combinedModeAll").prop('checked', true).change();
        }else{ 
            if(checked.size()==3){
                notChecked.attr("disabled", true);
            }else{
                allChecks.removeAttr("disabled");
            }
            
            updateFilterAndChart($(this));
        }
    });

    $(".generalCheck").on('change', function() {
        updateFilterAndChart($(this));
    });
});

function updateFilterAndChart(element){
    if(!(element.hasClass("collectionSelect") && element.closest("label").find(".collectionCheck:checked:not(:disabled)").size() == 0) &&
       !(element.hasClass("organizationSelectAll") && $("#combinedModeAll").is(":not(:checked)")) &&
       !(element.hasClass("organizationSelectFinal") && $("#combinedModeFinal").is(":not(:checked)"))){
        updateChartsOnChange(element);
        updateSelectedFilter(element);
    }
}

function updateSelectedFilter(element){
    if(element.closest("#my-costs-filters").size() > 0){
        var updateType = element.data("update");
        var tagsInput = $("#my-costs-filters .tagsinput");
        var selectedFilter = tagsInput.find(".selected-filter");
        var title;

        tagsInput.find(".singular-filter").remove();

        if(updateType == "general"){
            var label = element.closest("label");
            var select = label.find("select");
            title = label.find(".filter-title").text();

            selectedFilter.show();

            if(select.val() != "all"){
                title += " at " + select.val()
            }

            selectedFilter.text(title);

        }else if(updateType == "singular"){
            selectedFilter.hide();

            $("#my-costs-filters").find(".collectionCheck").each(function(index, element){
                if($(element).prop("checked")){
                    var label = $(element).closest("label");
                    var select = label.find("select");
                    title = label.find(".filter-title").text();

                    if(select.val() != "all"){
                        title += " at " + select.val()
                    }

                    tagsInput.append('<span class="tag singular-filter">' + title + '</span>');
                }
            });
        }
    }else{
        var title = element.next().text();
        $("#other-organisations-filters .selected-filter").text(title);
    }
}

function updateChartsOnChange(element){
        var form = $("#peerComparisonForm");
        var info = form.serializeAll();
        var financialAccountingChart = $("#peer_financial_accounting_chart").highcharts();
        var activitiesChart = $("#peer_activities_chart").highcharts();

        financialAccountingChart.showLoading();
        activitiesChart.showLoading();
        $.ajax({
            url: 'index.php?option=com_ccex&controller=comparepeer&format=raw',
            type: 'POST',
            data: info,
            dataType: 'JSON',
            success: function(data) {            
                if(data.success){                      
                    while(financialAccountingChart.series.length > 0){
                        financialAccountingChart.series[0].remove(false);
                    }

                    for(var i=0; i<data.series.financial_accounting.length; i++){
                        financialAccountingChart.addSeries(data.series.financial_accounting[i], false);
                    }

                    while(activitiesChart.series.length > 0){
                        activitiesChart.series[0].remove(false);
                    }

                    for(var i=0; i<data.series.activities.length; i++){
                        activitiesChart.addSeries(data.series.activities[i], false);
                    }

                    financialAccountingChart.redraw();
                    activitiesChart.redraw();
                }                 
            },
            complete: function(){
                financialAccountingChart.hideLoading();
                activitiesChart.hideLoading();
            }
        });
}
