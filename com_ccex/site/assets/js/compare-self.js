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
                $(this).prop('checked', true);
            });

            allChecks.attr("disabled", true);
            $("#combinedModeAll").prop('checked', true).change();
        }else{ 
            allChecks.removeAttr("disabled");
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
            selectedFilter.text(title);

        }else if(updateType == "singular"){
            selectedFilter.hide();

            $("#my-costs-filters").find(".collectionCheck").each(function(index, element){
                if($(element).prop("checked")){
                    var label = $(element).closest("label");
                    var select = label.find("select");
                    title = label.find(".filter-title").text();
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
        var form = $("#selfComparisonForm");
        var info = form.serializeAll();
        var financialAccountingMasterChart = $("#self_financial_accounting_master_chart").highcharts();
        var financialAccountingChart = $("#self_financial_accounting_chart").highcharts();
        var activitiesMasterChart = $("#self_activities_master_chart").highcharts();
        var activitiesChart = $("#self_activities_chart").highcharts();
        var masterCharts = $("#self_financial_accounting_master_chart, #self_activities_master_chart");
        var maxYears = 5;

        if($("#configuration_max_years").size() > 0){
            maxYears = parseInt($("#configuration_max_years").val());
        }

        financialAccountingChart.showLoading();
        financialAccountingMasterChart.showLoading(" ");  
        activitiesChart.showLoading();
        activitiesMasterChart.showLoading(" ");  
        $.ajax({
            url: 'index.php?option=com_ccex&controller=compareself&format=raw',
            type: 'POST',
            data: info,
            dataType: 'JSON',
            success: function(data) {            
                if(data.success){                      
                    if(data.masterCategories.length > maxYears){
                        masterCharts.show(); 

                        financialAccountingMasterChart.xAxis[0].removePlotBand("mask-before");
                        financialAccountingMasterChart.xAxis[0].removePlotBand("mask-after");  
                        activitiesMasterChart.xAxis[0].removePlotBand("mask-before");
                        activitiesMasterChart.xAxis[0].removePlotBand("mask-after");            

                        while(financialAccountingMasterChart.series.length > 0){
                            financialAccountingMasterChart.series[0].remove(false);
                        }

                        for(var i=0; i<data.masterSeries.financial_accounting.length; i++){
                            financialAccountingMasterChart.addSeries(data.masterSeries.financial_accounting[i], false);
                        }

                        financialAccountingMasterChart.xAxis[0].addPlotBand({
                             id: 'mask-before',
                             from: -1,
                             to:  data.masterCategories.length-5.5,
                             color: 'rgba(0, 0, 0, 0.12)'
                        });

                        financialAccountingMasterChart.xAxis[0].setCategories(data.masterCategories);

                        while(activitiesMasterChart.series.length > 0){
                            activitiesMasterChart.series[0].remove(false);
                        }

                        for(var i=0; i<data.masterSeries.activities.length; i++){
                            activitiesMasterChart.addSeries(data.masterSeries.activities[i], false);
                        }

                        activitiesMasterChart.xAxis[0].addPlotBand({
                             id: 'mask-before',
                             from: -1,
                             to:  data.masterCategories.length-5.5,
                             color: 'rgba(0, 0, 0, 0.12)'
                        });

                        activitiesMasterChart.xAxis[0].setCategories(data.masterCategories);

                        financialAccountingChart.redraw();
                        financialAccountingMasterChart.redraw();
                    }else{
                        masterCharts.hide();  
                    }

                    while(financialAccountingChart.series.length > 0){
                        financialAccountingChart.series[0].remove(false);
                    }

                    for(var i=0; i<data.series.financial_accounting.length; i++){
                        financialAccountingChart.addSeries(data.series.financial_accounting[i], false);
                    }

                    financialAccountingChart.xAxis[0].setCategories(data.categories);

                    while(activitiesChart.series.length > 0){
                        activitiesChart.series[0].remove(false);
                    }

                    for(var i=0; i<data.series.activities.length; i++){
                        activitiesChart.addSeries(data.series.activities[i], false);
                    }

                    activitiesChart.xAxis[0].setCategories(data.categories);

                    activitiesChart.redraw();
                    activitiesMasterChart.redraw();
                }                 
            },
            complete: function(){
                financialAccountingChart.hideLoading();
                financialAccountingMasterChart.hideLoading();   
                activitiesChart.hideLoading();
                activitiesMasterChart.hideLoading();   
            }
        });
}
