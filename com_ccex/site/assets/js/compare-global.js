$(document).ready(function() {
    $(".updateChartsOnChange").on('change', function(){
        var form = $("#globalComparisonForm");
        var info = form.serializeAll();
        var financialAccountingChart = $("#global_financial_accounting_chart").highcharts();
        var activitiesChart = $("#global_activities_chart").highcharts();

        if(!($("#separatedMode").is('checked') && $(".collectionCheck:checked").size() == 0) && 
           !($(this).hasClass("collectionSelect") && $(this).closest(".row").find(".collectionCheck:checked:not(:disabled)").size() == 0) &&
           !($(this).hasClass("organizationSelect") && $("#combinedMode").is(":not(:checked)"))
           ){
            financialAccountingChart.showLoading();
            activitiesChart.showLoading();
            $.ajax({
                url: 'index.php?option=com_ccex&controller=compareglobal&format=raw',
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
    });

    $("#separatedMode").on('change', function() {
        if(this.checked) {
            $(".collectionCheck:checked").removeAttr("disabled");
        }
    });

    $("#combinedMode").on('change', function() {
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
            $("#combinedMode").prop('checked', true);

           allChecks.each(function( index, element ) {
                if(index < 3){
                    $(this).prop('checked', true);
                }
            });

            allChecks.attr("disabled", true);
        }else if(checked.size()==3){
            notChecked.attr("disabled", true);
        }else{
            allChecks.removeAttr("disabled");
        }
    });

    $("#see-all-filters").on("click", function(){
        $("#other-filters").slideToggle();
        $("#see-all-filters").children("i").toggleClass("fa-angle-down").toggleClass("fa-angle-up");
    });

});


