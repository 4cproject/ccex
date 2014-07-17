<div class="container">
    <h3>Financial accounting</h3>
    <div id="self_financial_accounting_chart" class="col-md-12" style="width: 1140px; height: 400px;"></div>
    <div id="self_financial_accounting_master_chart" class="col-md-12" style="width: 1140px; height: 150px;"></div>
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
    var masterChart, detailChart;
    
    $(document).ready(function() {
    
        // create the master chart
        function createMaster() {
            masterChart = $('#self_financial_accounting_master_chart').highcharts({
                chart: {
                    reflow: false,
                    backgroundColor: null,
                    zoomType: 'x',
                    type: 'column',
                    style: {
                        fontFamily: 'Lato',
                    },
                    events: {
    
                        // listen to the selection event on the master chart to update the
                        // extremes of the detail chart
                        selection: function (event) {
                            var extremesObject = event.xAxis[0],
                                min = extremesObject.min,
                                max = extremesObject.max,
                                detailData = [],
                                xAxis = this.xAxis[0],
                                categories = {};

                            // reverse engineer the last part of the data
                            jQuery.each(this.series, function (i, series) {
                                var data = [];
                                jQuery.each(series.data, function (i, point) {
                                    if (point.x > min && point.x < max && ((point.category in categories) || (Object.keys(categories).length < 5))) {
                                        data.push({
                                            x: point.x,
                                            y: point.y,
                                            high: point.high,
                                            low: point.low
                                        });

                                        categories[point.category]++;
                                    }
                                });
                                detailData.push(data);
                            });

                            if(Object.keys(categories).length >= 5){
                                max = min+5;
                            }

                            // move the plot bands to reflect the new detail span
                            xAxis.removePlotBand('mask-before');
                            xAxis.addPlotBand({
                                id: 'mask-before',
                                from: -1,
                                to: min,
                                color: 'rgba(0, 0, 0, 0.2)'
                            });

                            xAxis.removePlotBand('mask-after');
                            xAxis.addPlotBand({
                                id: 'mask-after',
                                from: max,
                                to: 100,
                                color: 'rgba(0, 0, 0, 0.2)'
                            });

                            jQuery.each(detailChart.series, function (i, series) {
                                series.setData(detailData[i], false);
                            });

                            if(detailChart.xAxis[0].categories != xAxis.categories){
                                detailChart.xAxis[0].setCategories(xAxis.categories);
                            }

                            detailChart.redraw();

                            return false;
                        }
                    }
                },
                title: {
                    text: null
                },
                xAxis: {
                    plotBands: [{
                        id: 'mask-before',
                        from: -1,
                        to: <?php echo ($this->beginOfFirstInterval["begin_of_first_interval"] - $this->beginOfFirstInterval["begin_year"] -0.5); ?>,
                        color: 'rgba(0, 0, 0, 0.2)'
                    }],
                    title: {
                        text: null
                    },
                    categories: <?php echo $this->financialAccountingMasterCategoriesJSON; ?>
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    },
                    stackLabels: {
                        enabled: false
                    }
                },
                tooltip: {
                    formatter: function() {
                        return false;
                    }
                },
                legend: {
                    symbolWidth: 15,
                    symbolHeight: 15,
                    symbolRadius: 10,
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        pointPadding: 0.2,
                        borderWidth: 2
                    }
                },
                series: <?php echo $this->financialAccountingMasterSeriesJSON; ?>,
                exporting: {
                    enabled: false
                }
            }, function(masterChart) {
                createDetail(masterChart)
            })
            .highcharts(); // return chart instance
        }
    
        // create the detail chart
        function createDetail(masterChart) {
    
            // prepare the detail chart
            var detailData = [], detailStart = -1;
    
            jQuery.each(masterChart.series, function (i, series) {
                var data = [];
                jQuery.each(series.data, function (i, point) {
                    if (point.x >= detailStart) {
                        if (point.yBottom === null) {
                            data.push([point.x, point.y]);
                        } else {
                            data.push({
                                x: point.x,
                                low: point.low,
                                high: point.high
                            });
                        }
                    }
                });
                detailData.push({
                    type: series.type,
                    name: series.name,
                    zIndex: series.zIndex,
                    data: data
                });

            });
    
            // create a detail chart referenced by a global variable
            detailChart = $('#self_financial_accounting_chart').highcharts({
                chart: {
                    reflow: false,
                    style: {
                        position: 'absolute',
                        fontFamily: 'Lato',
                    },
                    type: 'column'
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: null
                },
                xAxis: {
                    categories: <?php echo $this->financialAccountingCategoriesJSON; ?>
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Relative cost (€/GB·Y)'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<div style="width:200px"><div style="float: left;">{series.options.stack}</div><div style="float: right; font-size:12px; margin-bottom: 5px;">Year {point.key}</div><table style="font-size:12px; white-space: nowrap; margin-top: 10px; width:100%;">',
                    pointFormat: '<tr><td style="padding:0"><span style="color: {series.color}">&#9679;</span>  {series.name}: </td>' +
                        '<td style="padding:0 0 0 5px; text-align: right;">{point.y:.1f} €/GB&sdot;Y</td></tr>',
                    footerFormat: '</table></div>',
                    useHTML: true
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        pointPadding: 0.2,
                        borderWidth: 2
                    }
                },
                series: <?php echo $this->financialAccountingSeriesJSON; ?>
            }).highcharts(); // return chart
        }
    
        // create master and in its callback, create the detail chart
        createMaster();
    });
    
});
</script>
