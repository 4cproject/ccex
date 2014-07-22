$(document).ready(function() {
    $(".updateChartsOnChange").on('change', function(){
        var form = $("#selfComparisonForm");
        var info = form.serializeAll();
        var financialAccountingMasterChart = $("#self_financial_accounting_master_chart").highcharts();
        var financialAccountingChart = $("#self_financial_accounting_chart").highcharts();
        var activitiesMasterChart = $("#self_activities_master_chart").highcharts();
        var activitiesChart = $("#self_activities_chart").highcharts();
        var masterCharts = $("#self_financial_accounting_master_chart, #self_activities_master_chart");

        if(!($("#separatedMode").is('checked') && $(".collectionCheck:checked").size() == 0)){
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

                        if(data.masterCategories.length > 5){
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
    });

    $("#separatedMode").on('change', function() {
        if(this.checked) {
            $(".collectionCheck").removeAttr("disabled");
        }
    });

    $("#combinedMode").on('change', function() {
        if(this.checked) {
            $(".collectionCheck").prop("disabled", true);
        }
    });

    $(".collectionCheck").on('change', function() {
        var checked = $(".collectionCheck:checked");
        var allChecks =  $(".collectionCheck");

        if(checked.size()==0){
            $("#separatedMode").removeAttr("checked");
            $("#combinedMode").prop('checked', true);

            allChecks.prop('checked', true);
            allChecks.prop("disabled", true);
        }else{
            allChecks.removeAttr("disabled");
        }
    });
});


