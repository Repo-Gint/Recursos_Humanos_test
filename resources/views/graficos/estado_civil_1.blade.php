<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@php 
    $estados = estado_civil($inicio, $fin);
	@endphp
	<center>
      <div id="estado_civil" style="width: 100%; height: 500px; background-color: #FFFFFF;" ></div>
  </center>
<script>
  AmCharts.makeChart("estado_civil",
        {
          "type": "pie",
          "angle": 45,
          "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          "depth3D": 15,
          "innerRadius": "40%",
          "titleField": "category",
          "valueField": "column-1",
          "colors": [
            "#0D52D1",
            "#2A0CD0",
            "#8A0CCF",
            "#CD0D74",
            "#754DEB",
            "#DDDDDD"
          ],
          
          "allLabels": [],
          "balloon": {},
          "legend": {
            "enabled": true,
            "align": "center",
            "markerType": "circle"
          },
          "titles": [],
          "dataProvider": [
            {!! $estados !!}
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