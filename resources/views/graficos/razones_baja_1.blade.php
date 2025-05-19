<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php  
    $bajas = razon_baja($inicio, $fin);
	?>
	<center>
      <div id="chartBar" style="width: 100%; height: 300px; background-color: #FFFFFF;" ></div>
  </center>
<script>
AmCharts.makeChart("chartBar",
        {
          "type": "serial",
          "categoryField": "category",
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start"
          },
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "",
              "labelText": "[[value]]",
              "title": "",
              "type": "column",
              "valueField": "column-1",
              "visibleInLegend": false
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": ""
            }
          ],
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "useGraphSettings": true
          },

          "dataProvider": [
            {!! $bajas !!}
          ],
          "export":{
            "enabled": true,
            "menu": []
          }
        }
      );
</script>
</body>
</html>