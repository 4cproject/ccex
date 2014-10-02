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
                if($(".feedback-currency-symbol").size() > 0){
                    if(this.symbolFormatter(this.total) == "%"){
                        $(this.totalFeedbackElemId).children(".feedback-currency-symbol").html("");
                        $(this.totalFeedbackElemId).children(".feedback-percentage-symbol").html(this.symbolFormatter(this.total));
                    }else{
                        $(this.totalFeedbackElemId).children(".feedback-percentage-symbol").html("");
                        $(this.totalFeedbackElemId).children(".feedback-currency-symbol").html(this.symbolFormatter(this.total));
                    }
                }else if($(".feedback-format-symbol").size() > 0){
                    $(this.totalFeedbackElemId).children(".feedback-format-symbol").html(this.symbolFormatter(this.total));
                }
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

                    if($(".feedback-currency-symbol").size() > 0){
                        if(this.symbolFormatter(this.total) == "%"){
                            $(sliderFeedbackId).children(".feedback-currency-symbol").html("");
                            $(sliderFeedbackId).children(".feedback-percentage-symbol").html(this.symbolFormatter(sliderValue));
                        }else{
                            $(sliderFeedbackId).children(".feedback-percentage-symbol").html("");
                            $(sliderFeedbackId).children(".feedback-currency-symbol").html(this.symbolFormatter(sliderValue));
                        }
                    }else if($(".feedback-format-symbol").size() > 0){
                        $(sliderFeedbackId).children(".feedback-format-symbol").html(this.symbolFormatter(sliderValue));
                    }
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

                    if (isNaN(newValue) || newValue == "") {
                        newValue = 0;
                    } else {
                        newValue = parseFloat(newValue);
                    }
                    var percentValue = newValue;

                    if(category == "financial-accounting" || 
                       category == "activities"){
                            var cost = $("#cost_value").val();

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
                    }else{
                        var volume = $("#interval_data_volume_number").val();
                        var utils = sliderUtils;

                        if (isNaN(volume) || volume <= 0) {
                            percentValue = newValue;
                        } else {
                            volume = parseFloat(volume);

                            percentValue = (newValue / volume) * 100;
                        }
                    }

                    if (percentValue > 100) {
                        percentValue = 100;
                    }

                    percentValue = +(percentValue.toFixed(2));

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
                    formatNumber(value, 2);
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
    var volume;
    var format;

    if (filesize >= 1125899906842624) {
        volume = formatNumber(filesize / 1125899906842624, decimals);
        format = "PB";
    } else if (filesize >= 1099511627776) {
        volume = formatNumber(filesize / 1099511627776, decimals);
        format = "TB";
    } else if (filesize >= 1073741824) {
        volume = formatNumber(filesize / 1073741824, decimals);
        format = "GB";
    } else if (filesize >= 1048576) {
        volume = formatNumber(filesize / 1048576, decimals);
        format = "MB";
    } else if (filesize >= 1024) {
        volume = formatNumber(filesize / 1024, decimals);
        format = "KB";
    } else {
        volume = formatNumber(filesize, decimals);
        format = Humanize.pluralize(filesize, "B");
    }

    return {volume: volume, format: format};
}

function significantFigures(n, sig) {
    if(n==0){ return 0; }
    var mult = Math.pow(10, sig - Math.floor(Math.log(n) / Math.LN10) - 1);
    return Math.round(n * mult) / mult;
}

function formatNumber(n, sig) {
    return significantFigures(n, sig).toLocaleString();
}

jQuery(function() {
    var isVisible = false;
    var clickedAway = false;

    $('.popup-marker').each(function() {
        $(this).popover({
            template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"><div class="data-content"></div></div></div>',
            html: true,
            trigger: 'manual'
        }).on('click', function(e) {
            $(this).popover('show');
            isVisible = true;
            e.preventDefault();
        });
    });

    $(document).on('click', function(e) {
      if(isVisible & clickedAway)
      {
         $('.popup-marker').each(function() {
              $(this).popover('hide');
         });
        isVisible = clickedAway = false;
      }
      else
      {
        clickedAway = true;
      }
    });
});
