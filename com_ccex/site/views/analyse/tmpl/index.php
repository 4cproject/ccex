            <ol class="breadcrumb">
              <li><a href="costs.html">Compare costs</a></li>
              <li class="active">Analyse and compare costs</li>
            </ol>
            <h1>Analyse and compare costs</h1>
            <p>See the summary of your submitted costs and compare them with other organisations'.</p>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#self" data-toggle="tab">My costs</a></li>
              <li><a href="#global" data-toggle="tab">Global comparison</a></li>
              <li><a href="#peer" data-toggle="tab">Peer comparison</a></li>
            </ul>
            <br/>
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane fade in active" id="self">
                <p>Analyse how your collections perform throughout time and compare with each other can be a valuable insight.</p>
                
                <form id ="collectionsSelectedForm">
                    <div class="radio">
                      <label>
                        <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="combinedMode" value="combined" checked>
                        All collections combined <small>(<?php echo count($this->collections); ?>)</small>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="separatedMode" value="separated">
                        Separate and select collections:
                        <div class="radio" id="collectionsRadios">
                        <?php $i = 1 ?>
                        <?php foreach ($this->collections as $collection) { ?>
                            <div class="checkbox">
                                <label>
                                    <input class="updateChartsOnChange collectionCheck" type="checkbox" name="collectionsSelected[]" disabled value="<?php echo $collection->collection_id ?>" <?php if($i<=3){echo "checked";} ?>>
                                    <span class="badge">
                                        #<?php echo $i; ?>
                                    </span> 
                                    <?php echo $collection->name; ?>
                                </label>
                            </div>
                        <?php $i++; ?>
                        <?php } ?>
                        </div>
                      </label>
                    </div>
                </form>

                <div class="container">
                    <h3>Financial accounting</h3>
                    <div id="self_financial_accounting_chart" class="col-md-12" style="width: 1140px; height: 400px;"></div>
                    <div id="self_financial_accounting_master_chart" class="col-md-12" style="width: 1140px; height: 150px;"></div>
                    <p>On average, your organisation spends <b>most of their budget on staff</b>, around 55%, followed by 23% on procurements and 12% on overhead. You have not mapped 12% of your costs to any financial accounting categories so they have been grouped into "Other" costs. Procurements budget is spent mainly in <b>hardware</b> and <b>external or 3<sup>rd</sup> party services</b>, totaling 95% of the procurement costs and around 22% of total costs. The staff costs are mainly composed by <b>producer</b> and <b>support/operation</b> roles, totaling 90% of the staff costs and 49.5% of total costs.</p>
                </div>
              </div>
            </div>
            <br/>
        </div>
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
                    // type: 'datetime',
                    // showLastTickLabel: true,
                    // maxZoom: 14 * 24 * 3600000, // fourteen days
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

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/analyse.js') ?>"></script>
