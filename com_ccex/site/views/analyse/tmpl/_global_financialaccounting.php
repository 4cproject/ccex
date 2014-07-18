<div class="container">
    <div class="caption" style="margin-top: 30px">
        <h3>Financial accounting comparison</h3>
    </div>
    <div id="global_financial_accounting_chart" class="col-md-12" style="width: 1140px; height: 400px;"></div>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
            }
          }
        }
      },
      tooltip: {
       pointFormat: '<span style="color: {series.color}">&#9679;</span> {series.name}: <b>{point.y:.1f} €/GB&sdot;Y</b>',
       useHTML: true
     },
     legend: {
      symbolWidth: 15,
      symbolHeight: 15,
      symbolRadius: 10,
    },
    series: <?php echo $this->series; ?>
  });
});
</script>
