$(document).ready(function() {
    $(".updateChartsOnChange").on('change', function(){
        var form = $("#collectionsSelectedForm");
        var info = form.serializeAll();
        var financialAccountingChart = $("#self_financial_accounting_chart").highcharts();
    
        $.ajax({
            url: 'index.php?option=com_ccex&controller=financialaccounting&format=raw',
            type: 'POST',
            data: info,
            dataType: 'JSON',
            success: function(data) {            
                if(data.success){
                    while(financialAccountingChart.series.length > 0){
                        financialAccountingChart.series[0].remove(false);
                    }
                    for(var i=0; i<data.series.length; i++){
                        financialAccountingChart.addSeries(data.series[i], false);
                    }
                    financialAccountingChart.redraw();
                }                 
            }
        });
    })
});
