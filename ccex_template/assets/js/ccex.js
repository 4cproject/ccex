function SliderUtils(chartElemId, chartWidth, chartHeight, totalFeedbackElemId, formatter) {
	this.chartElemId = chartElemId;
	this.chartWidth = chartWidth;
	this.chartHeight = chartHeight;
	this.totalFeedbackElemId = totalFeedbackElemId;
	this.formatter = formatter;

	this.sliderIds = new Array();
	this.sliderElems = new Array();
	this.sliderColors = new Array();
	this.sliderLabels = new Array();
	this.sliders = new Array();
	this.sliderFeedbackIds = new Array();
	this.total = 0;

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
			value : otherValue,
			color : "#eeeeee",
			label : 'Other',
			labelColor : 'white'
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
				if(instance.total <= 100) {
					chart.Doughnut(data, pieChartOptions);
					instance.updateLabels();
				}
			});
			this.sliders[i].on('slideStop', function(slideEvt) {
				var data = instance.getData();
				if(instance.total > 100) {
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
		if(this.totalFeedbackElemId !== undefined) {
			$(this.totalFeedbackElemId).html(this.formatter(this.total));
		}

		for (var i = 0; i < this.sliders.length; i++) {
			var sliderFeedbackId = this.sliderFeedbackIds[i];
			if(sliderFeedbackId !== undefined) {
				var sliderValue = this.sliders[i].slider('getValue');
				$(sliderFeedbackId).html(this.formatter(sliderValue));
			}
		}

	}

};


function humanFileSize(filesize, decimals) {
	var sizeStr;
    if (filesize >= 1125899906842624) {
      sizeStr = Humanize.formatNumber(filesize / 1125899906842624, decimals, "") + " Petabytes";
    } else if (filesize >= 1099511627776) {
      sizeStr = Humanize.formatNumber(filesize / 1099511627776, decimals, "") + " Terabytes";
    } else if (filesize >= 1073741824) {
      sizeStr = Humanize.formatNumber(filesize / 1073741824, decimals, "") + " Gigabytes";
    } else if (filesize >= 1048576) {
      sizeStr = Humanize.formatNumber(filesize / 1048576, decimals, "") + " Megabytes";
    } else if (filesize >= 1024) {
      sizeStr = Humanize.formatNumber(filesize / 1024, 0) + " Kilobytes";
    } else {
      sizeStr = Humanize.formatNumber(filesize, 0) + Humanize.pluralize(filesize, " Byte");
    }
    return sizeStr;
}