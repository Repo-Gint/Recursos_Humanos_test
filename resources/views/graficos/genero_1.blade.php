<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php  
		$mujeres = total_genero('Mujer', $inicio, $fin);
    $hombres = total_genero('Hombre', $inicio, $fin);
	?>
	<center>
      <div id="chartdivPie" style="width: 100%; height: 500px; background-color: #FFFFFF;" ></div>
  </center>
<script>
  AmCharts.makeChart("chartdivPie",
    {
      "type": "pie",
      "angle": 34.2,
      "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
      "depth3D": 23,
      "innerRadius": 0,
      "labelRadius": 0,
      "colors": [
        "#0077E3",
        "#F348DE"
      ],
      "titleField": "category",
      "valueField": "column-1",
      "theme": "default",
      "allLabels": [],
      "balloon": {},
      "legend": {
        "enabled": true,
        "align": "center",
        "markerType": "circle"
      },
      "titles": [],
      "dataProvider": [
        {
          "category": "Hombres",
          "column-1": {{ $hombres }}
        },
        {
          "category": "Mujeres",
          "column-1": {{ $mujeres }}
        }
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