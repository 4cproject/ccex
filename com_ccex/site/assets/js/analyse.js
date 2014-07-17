$(document).ready(function() {
    $(".updateChartsOnChange").on('change', function(){
        var form = $("#collectionsSelectedForm");
        var info = form.serializeAll();
        var financialAccountingMasterChart = $("#self_financial_accounting_master_chart").highcharts();
        var financialAccountingChart = $("#self_financial_accounting_chart").highcharts();
    
        if(!($("#separatedMode").is('checked') && $(".collectionCheck:checked").size() == 0)){
            $.ajax({
                url: 'index.php?option=com_ccex&controller=financialaccounting&format=raw',
                type: 'POST',
                data: info,
                dataType: 'JSON',
                success: function(data) {            
                    if(data.success){
                        while(financialAccountingMasterChart.series.length > 0){
                            financialAccountingMasterChart.series[0].remove(false);
                        }

                        financialAccountingMasterChart.xAxis[0].removePlotBand("mask-before");
                        financialAccountingMasterChart.xAxis[0].removePlotBand("mask-after");

                        for(var i=0; i<data.masterSeries.length; i++){
                            financialAccountingMasterChart.addSeries(data.masterSeries[i], false);
                        }

                        financialAccountingMasterChart.xAxis[0].addPlotBand({
                             id: 'mask-before',
                             from: -1,
                             to:  data.masterCategories.length-5.5,
                             color: 'rgba(0, 0, 0, 0.2)'
                        });

                        financialAccountingChart.xAxis[0].setCategories(data.categories);

                        while(financialAccountingChart.series.length > 0){
                            financialAccountingChart.series[0].remove(false);
                        }

                        for(var i=0; i<data.series.length; i++){
                            financialAccountingChart.addSeries(data.series[i], false);
                        }

                        financialAccountingChart.redraw();
                        financialAccountingMasterChart.redraw();
                    }                 
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
            $(".collectionCheck").attr("disabled", true);
        }
    });

    $(".collectionCheck").on('change', function() {
        var checkedInputs = $(".collectionCheck:checked");

        if(checkedInputs.size()==0){
            $("#separatedMode").removeAttr("checked");
            $("#combinedMode").prop('checked', true);

            $(".collectionCheck").each(function( index, element ) {
                if(index < 3){
                    $(this).prop('checked', true);
                }
            });
            $(".collectionCheck").attr("disabled", true);
        }
    });

});


