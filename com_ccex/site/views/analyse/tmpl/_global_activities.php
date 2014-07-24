<div class="container">
    <div class="col-md-8">
        <div class="caption" style="margin-top: 30px">
            <h3>Activities comparison</h3>
        </div>
        <div id="global_activities_chart" class="col-md-12" style="width: 750px; height: 400px;margin-top:20px;margin-bottom:20px;"></div>
    </div>
    <div class="col-md-4">
        <br/>
        <p style="margin-top: 40px;">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat.
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. 
        </p>
    </div>
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
                    'Production',
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
                        }
                    }
                }
            },
            tooltip: {
                 pointFormat: '<span style="color: {series.color}">&#9679;</span> {series.name}: <b>{point.y:.1f} €/GB&sdot;Y</b>',
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
