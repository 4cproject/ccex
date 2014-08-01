<div class="container">
    <div class="caption" style="margin-top: 30px">
        <h3>Activities comparison</h3>
    </div>
    <div id="global_activities_chart" class="col-md-12" style="width: 1140px; height: 400px;margin-top:20px;margin-bottom:20px;"></div>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
</div>
<br/>

<script type="text/javascript">
    $(function () {
        $('#global_activities_chart').highcharts({
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
                    'Pre-Ingest',
                    'Ingest',
                    'Archival storage',
                    'Access',
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
