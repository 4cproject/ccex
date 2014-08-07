<div class="container">
    <div class="caption" style="margin-top: 30px">
        <h3>Financial accounting comparison</h3>
    </div>
    <div id="global_financial_accounting_chart" class="col-md-12" style="width: 1140px; height: 400px;margin-top:20px;margin-bottom:20px;"></div>
    
    <p>
      This graph takes an average total spend for all years and either compares an aggregated figure for all your data sets or selected data sets, with other cost data sets shared with the CCEx. Hover on each bar or use the key to identify your relative cost per gigabyte for the total period of each cost data set, in terms of a financial accounting breakdown. The figure at the head of the bar for each year also shows your relative cost per gigabyte for the total period of each cost data set.
      <br/>
      <a target="_blank" href="<?php echo JRoute::_('/ccex/index.php/62-analyse-and-compare-costs#global_financial_accounting'); ?>">Learn more about how these results are calculated.</a>
      <br/>
      You can export your data by clicking the icon in the top right hand corner of this graph.
    </p>
</div>

<script type="text/javascript">
  $(function () {
    $('#global_financial_accounting_chart').highcharts({
      chart: {
        type: 'column',
        style: {
          fontFamily: 'Lato',
        }
      },
      credits: {
        enabled: false
      },
      title: {
        text: '',
      },
      xAxis: {
        categories: [
        'Hardware',
        'Software',
        'External',
        'Producer',
        'IT-developer',
        'Operations',
        'Preservation specialist',
        'Manager',
        'Overhead',
        'Other',
        ]
      },
      yAxis: {
        min: 0,
        title: {
          text: 'Relative cost (€/GB·Y)'
        },
      },
      plotOptions: {
        column: {
          dataLabels: {
            enabled: true,
            style: {
              fontWeight: 'bold',
              color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            },
            formatter: function() {
              var value=0;
              if(this.y == 0){value = "0";}else if(this.y < 0.01){value = this.y.toPrecision(2);}else{value = this.y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');}
          
              return value;
            }
          }
        }
      },
      tooltip: {
        formatter: function(){
            var value=0;
            if(this.y == 0){value = "0";}else if(this.y < 0.01){value = this.y.toPrecision(2);}else{value = this.y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');}

            var tooltip = '<span style="color: ' + this.series.color + '">&#9679;</span> ' + this.series.name + ': <b>' + value + ' €/GB&sdot;Y</b>'; 

            return tooltip;
        },       
        useHTML: true
     },
     legend: {
      verticalAlign: 'top',
      symbolWidth: 15,
      symbolHeight: 15,
      symbolRadius: 10,
    },
    series: <?php echo $this->series; ?>
  });
});
</script>
