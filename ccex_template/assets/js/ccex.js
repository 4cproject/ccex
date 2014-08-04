function SliderUtils(chartElemId, chartWidth, chartHeight, totalFeedbackElemId, valueFormatter, symbolFormatter, editable) {
    this.chartElemId = chartElemId;
    this.chartWidth = chartWidth;
    this.chartHeight = chartHeight;
    this.totalFeedbackElemId = totalFeedbackElemId;

    this.simpleFormatter = typeof symbolFormatter !== 'undefined' ? false : true;

    if (this.simpleFormatter) {
        this.formatter = valueFormatter;
    } else {
        this.valueFormatter = valueFormatter;
        this.symbolFormatter = symbolFormatter;
    }

    this.sliderIds = new Array();
    this.sliderElems = new Array();
    this.sliderColors = new Array();
    this.sliderLabels = new Array();
    this.sliders = new Array();
    this.sliderFeedbackIds = new Array();
    this.total = 0;
    this.editable = typeof editable !== 'undefined' ? editable : false;

    if (window === this) {
        return new SliderUtils(chartElemId);
    }

    return this;
};

SliderUtils.prototype = {
    addSlider: function(sliderId, color, label, sliderFeedbackId) {
        this.sliderIds.push(sliderId);
        this.sliderElems.push($(sliderId));
        this.sliderColors.push(color);
        this.sliderLabels.push(label);
        this.sliderFeedbackIds.push(sliderFeedbackId);
    },
    getData: function() {
        this.total = 0;
        var pieData = new Array();

        for (var i = 0; i < this.sliders.length; i++) {
            var sliderValue = this.sliders[i].slider('getValue');
            this.total += sliderValue;

            pieData.push({
                value: sliderValue,
                color: this.sliderColors[i],
                label: this.sliderLabels[i]
            });
        };

        var otherValue = this.total > 100 ? 0 : 100 - this.total;
        pieData.push({
            value: otherValue,
            color: "#eeeeee",
            label: 'Other',
            labelColor: 'white'
        });

        return pieData;
    },
    init: function() {
        // Initialize sliders
        for (var i = this.sliderElems.length - 1; i >= 0; i--) {
            this.sliders[i] = this.sliderElems[i].slider({
                formater: function(value) {
                    return value + '%';
                }
            });

            var sliderHandle = $(this.sliderIds[i] + " .slider-handle");
            sliderHandle.css("background", this.sliderColors[i]);
        };

        // Initialize chart
        var ctxChart = $(this.chartElemId).get(0).getContext("2d");

        var pieChartOptions = {
            animation: false
        };

        var chart = new Chart(ctxChart);
        var pieChart = chart.Doughnut(this.getData(), pieChartOptions);

        var instance = this;

        // Bind sliders to chart update
        for (var i = this.sliders.length - 1; i >= 0; i--) {
            this.sliders[i].on('slide', function(slideEvt) {
                var data = instance.getData();
                if (instance.total <= 100) {
                    chart.Doughnut(data, pieChartOptions);
                    instance.updateLabels();
                }
            });
            this.sliders[i].on('slideStop', function(slideEvt) {
                var data = instance.getData();
                if (instance.total > 100) {
                    var correctedValue = slideEvt.value - (instance.total - 100);
                    $(this).slider('setValue', correctedValue);
                    data = instance.getData();
                }

                ctxChart.canvas.width = instance.chartWidth;
                ctxChart.canvas.height = instance.chartHeight;
                chart = new Chart(ctxChart);
                pieChart = chart.Doughnut(data, pieChartOptions);
            });
        };
    },
    updateLabels: function() {
        if (this.totalFeedbackElemId !== undefined) {
            if (this.simpleFormatter) {
                $(this.totalFeedbackElemId).html(this.formatter(this.total));
            } else {
                $(this.totalFeedbackElemId).children(".feedback-value").html(this.valueFormatter(this.total));
                $(this.totalFeedbackElemId).children(".feedback-symbol").html(this.symbolFormatter(this.total));
            }
        }

        for (var i = 0; i < this.sliders.length; i++) {
            var sliderFeedbackId = this.sliderFeedbackIds[i];
            if (sliderFeedbackId !== undefined) {
                var sliderValue = this.sliders[i].slider('getValue');

                if (this.simpleFormatter) {
                    $(sliderFeedbackId).html(this.formatter(sliderValue));
                } else {
                    $(sliderFeedbackId).children(".feedback-value").html(this.valueFormatter(sliderValue));
                    $(sliderFeedbackId).children(".feedback-symbol").html(this.symbolFormatter(sliderValue));
                }
            }
        }

        if (this.editable) {
            this.editable.editable({
                type: 'text',
                defaultValue: '',
                emptytext: 0,
                value: '',
                success: function(response, newValue) {
                    var category = $(this).parent().data('category');
                    var selector = "#" + $(this).parent().prev().attr('id');
                    var cost = $("#cost_value").val();

                    if (isNaN(newValue) || newValue == "") {
                        newValue = 0;
                    } else {
                        newValue = parseFloat(newValue);
                    }
                    var percentValue = newValue;

                    if (category == 'financial-accounting') {
                        var utils = faSliderUtils;
                    } else {
                        var utils = activitiesSliderUtils;
                    }

                    if (isNaN(cost) || cost <= 0) {
                        percentValue = newValue;
                    } else {
                        cost = parseFloat(cost);
                        percentValue = (newValue / cost) * 100;
                    }

                    if (percentValue > 100) {
                        percentValue = 100;
                    }

                    var slider = utils.getSlider(selector);
                    slider.slider('setValue', percentValue);

                    if (utils.total > 100) {
                        percentValue = percentValue - (utils.total - 100);
                        slider.slider('setValue', percentValue);
                    }

                    return {
                        newValue: ''
                    };
                },
                display: function(value) {
                    Humanize.formatNumber(value, 0);
                },
                validate: function(value) {
                    var regex = /^[0-9]*(\.[0-9]+)?$/;
                    if (isNaN(value) || !regex.test(value)) {
                        return 'Invalid value';
                    }
                }
            });
        }
    },
    getSlider: function(selector) {
        var result;

        this.sliders.forEach(function(slider) {
            if (slider.selector == selector) {
                result = slider;
            }
        });

        return result;
    }
};


function humanFileSize(filesize, decimals) {
    var sizeStr;
    if (filesize >= 1125899906842624) {
        sizeStr = Humanize.formatNumber(filesize / 1125899906842624, decimals, "") + " PB";
    } else if (filesize >= 1099511627776) {
        sizeStr = Humanize.formatNumber(filesize / 1099511627776, decimals, "") + " TB";
    } else if (filesize >= 1073741824) {
        sizeStr = Humanize.formatNumber(filesize / 1073741824, decimals, "") + " GB";
    } else if (filesize >= 1048576) {
        sizeStr = Humanize.formatNumber(filesize / 1048576, decimals, "") + " MB";
    } else if (filesize >= 1024) {
        sizeStr = Humanize.formatNumber(filesize / 1024, 0) + " KB";
    } else {
        sizeStr = Humanize.formatNumber(filesize, 0) + Humanize.pluralize(filesize, " B");
    }
    return sizeStr;
}
