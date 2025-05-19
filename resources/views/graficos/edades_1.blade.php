<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php  
    $edades = edades_sexo($inicio, $fin);
	?>
	<center>
      <div id="chartEdades" style="width: 100%; height: 300px; background-color: #FFFFFF;" ></div>
  </center>
<script>
  AmCharts.makeChart("chartEdades",
        {
          "type": "serial",
          "categoryField": "category",
          "angle": 0,
          "depth3D": 0,
          "colors": [
            "#0077E3",
            "#F348DE"
          ],
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start"
          },
          "trendLines": [],
          "graphs": [
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "Hombres",
              "type": "column",
              "valueField": "hombres"
            },
            {
              "balloonText": "[[title]] of [[category]]:[[value]]",
              "fillAlphas": 1,
              "id": "AmGraph-2",
              "title": "Mujeres",
              "type": "column",
              "valueField": "mujeres"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": "Empleados"
            }
          ],
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "useGraphSettings": true
          },
          "dataProvider": [
            {!! $edades !!}
          ],
          "export":{
            "enabled": true,
            "menu": []
          }
        }
      );
  /*AmCharts.makeChart("chartEdades",
        {
          "type": "serial",
          "categoryField": "category",
          "angle": 10,
          "depth3D": 20,
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start"
          },
          "colors": [
            "#FF4000"
          ],
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
            {!! $edades !!}
          ],
          "export":{
            "enabled": true,
            "menu": []
          }
        }
      );*/
</script>
</body>
</html>