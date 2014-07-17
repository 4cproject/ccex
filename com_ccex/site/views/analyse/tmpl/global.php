<ol class="breadcrumb">
  <li><a href="costs.html">Compare costs</a></li>
  <li class="active">Analyse and compare costs</li>
</ol>
<h1>Analyse and compare costs</h1>
<p>See the summary of your submitted costs and compare them with other organisations'.</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li><a href="#">My costs</a></li>
  <li class="active"><a href="#">Global comparison</a></li>
  <li><a href="#">Peer comparison</a></li>
</ul>
<br/>

<p>Comparing your costs with a group of organisations shows how well you are performing against the average. You can filter the comparison to show only organisations which have similar characteristics to yours.</p>
<div class="row">
  <div class="form-inline col-md-6">
    <h4>My costs</h4>
    <label class="radio-inline">
    <input type="radio" name="groupCollectionRadios" id="groupCollectionRadiosAll" value="all" checked>
      All collections combined <small>(<?php echo count($this->collections); ?>)</small>
  </label>
  
  <select class="form-control input-xs" style="margin-left: 5px;">
    <option>All years</option>
    <option>2000</option>
    <option>2001</option>
    <option>2002</option>
    <option>2003</option>
    <option>2004</option>
    <option>2005</option>
    <option>2006</option>
    <option>2007</option>
    <option>2008</option>
    <option>2009</option>
  </select>

  <label class="radio-inline col-xs-12">
      <input type="radio" name="groupCollectionRadios" id="groupCollectionRadiosSep" value="sep" disabled="true">
      Separate and select collections:
  </label>
    <div class="row" style="margin-left: 20px;">
      <label class="checkbox-inline"><input type="checkbox" checked="true" disabled="true"> <span class="badge">#1</span> A Treatise on the Binomial Theorem</label>
    <select class="form-control input-xs" disabled="true">
      <option>All years</option>
      <option>2000</option>
      <option>2001</option>
      <option>2002</option>
      <option>2003</option>
      <option>2004</option>
      <option>2005</option>
      <option>2006</option>
      <option>2007</option>
      <option>2008</option>
      <option>2009</option>
    </select>
  </div>
  <div class="row" style="margin-left: 20px;">
      <label class="checkbox-inline"><input type="checkbox" checked="true" disabled="true"> <span class="badge">#2</span> Plans for World Domination</label>
    <select class="form-control input-xs" disabled="true">
      <option>All years</option>
      <option>2000</option>
      <option>2001</option>
      <option>2002</option>
      <option>2003</option>
      <option>2004</option>
      <option>2005</option>
      <option>2006</option>
      <option>2007</option>
      <option>2008</option>
      <option>2009</option>
    </select>
  </div>
</div>
<div class="col-md-6">
  <h4>Other organisations costs</h4>
  <div class="radio">
    <label data-toggle="modal" data-target="#filterMessageModal">
      <input type="radio" name="groupOthersRadios" id="groupOthersRadiosAll" value="all" checked>
        All organisations <small>(139)</small>
    </label>
  </div>
  <div class="radio">
    <label data-toggle="modal" data-target="#filterMessageModal">
      <input type="radio" name="groupOthersRadios" id="groupOthersRadiosOpt1" value="opt1">
        Only memory institutions <small>(34)</small>
    </label>
  </div>
  <div class="radio">
    <label data-toggle="modal" data-target="#filterMessageModal">
      <input type="radio" name="groupOthersRadios" id="groupOthersRadiosOpt2" value="opt2">
        Only universities <small>(22)</small>
    </label>
  </div>
  <div class="radio">
    <label data-toggle="modal" data-target="#filterMessageModal">
      <input type="radio" name="groupOthersRadios" id="groupOthersRadiosOpt2" value="opt3">
        Only collections with around 10 Terabytes <small>(35)</small>
    </label>
  </div>
  <div class="radio">
    <label data-toggle="modal" data-target="#filterMessageModal">
      <input type="radio" name="groupOthersRadios" id="groupOthersRadiosOpt3" value="opt4">
        Only collections with around 100 Terabytes <small>(10)</small>
    </label>
  </div>
  <div class="radio">
    <label data-toggle="modal" data-target="#filterMessageModal">
      <input type="radio" name="groupOthersRadios" id="groupOthersRadiosOpt4" value="opt5">
        Only collections with mainly word processing assets <small>(120)</small>
    </label>
  </div>
  <div class="radio">
    <label  style="color: #999" data-toggle="tooltip" data-placement="right" data-container="body" title="A filter cannot be displayed with size less than 5, to preserve anonimity for the intervinients.">
      <input type="radio" name="groupOthersRadios" id="groupOthersRadiosOpt1" value="opt6" disabled="true">
        Only collections with mainly video assets <small>(4)</small>
    </label>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="filterMessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Filtering information feature</h4>
        </div>
        <div class="modal-body">
          <p>By clicking this option the above charts will be updated to show only information for the selected group.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK, got it!</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container">
<div class="caption" style="margin-top: 30px">
  <h3>Financial accounting comparison</h3>
</div>
<div id="global_financial_accounting_chart" class="col-md-12" style="width: 1140px; height: 400px;"></div>
<script type="text/javascript">
$(function () {
  $('#global_financial_accounting_chart').highcharts({
        chart: {
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
          series: [{
            type: 'column',
              name: 'You (all collections at all years)',
              data: [21.4, 31.2, 13.5, 13.7, 21.6, 15.5, 15.4, 16.4, 41.6, 13.1],
              color: '#00b050',           
          }, {
            type: 'column',
              name: 'All organisations (139)',
              data: [23.4, 13.2, 33.5, 13.7, 32.6, 15.5, 35.4, 36.4, 44.6, 13.1],
              color: '#006fc0',
  
          }]
      });
});
</script>
</div>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-global.js') ?>"></script>
