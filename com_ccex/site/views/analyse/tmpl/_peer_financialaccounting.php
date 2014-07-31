<div class="container">
    <div class="caption" style="margin-top: 30px">
        <h3>Financial accounting comparison</h3>
    </div>
    <div id="peer_financial_accounting_chart" class="col-md-12" style="width: 1140px; height: 400px;margin-top:20px;margin-bottom:20px;"></div>
</div>

<script type="text/javascript">
  $(function () {
    $('#peer_financial_accounting_chart').highcharts({
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
        'Support / operations',
        'Preservation analyst',
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
