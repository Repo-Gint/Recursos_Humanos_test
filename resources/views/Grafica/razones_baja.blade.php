@extends('layouts.app')
@section('title', 'Graficas')
@section('Pag', 'Razones Bajas')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Razones Bajas</h3>
                {!! Form::open(['id' => 'Form', 'method' => 'POST']) !!}
                <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-1"></div>
                        {!!  Form::label('F. inicio', 'F. inicio: ', ['class' => 'col-lg-1 col-xs-3 col-form-label']) !!}
                         <div class="col-lg-3">
                            {!!  Form::date('F_inicio', null, ['class' => 'form-control', 'id' => 'F_inicio']) !!}
                        </div>
                        {!!  Form::label('F. fin', 'F. fin: ', ['class' => 'col-lg-1 col-xs-3 col-form-label']) !!}
                         <div class="col-lg-3">
                            {!!  Form::date('F_fin', null, ['class' => 'form-control', 'id' => 'F_fin']) !!}
                        </div>
                        {!!  Form::button('Actualizar', ['class' => 'btn btn-success', 'id' => 'Actualizar']); !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div id="grafico"></div>
            <div style="text-align: center;">
                <button class="btn btn-default" onclick="exportCharts();">
                    <i class="fa fa-file-pdf-o"></i> Descargar PDF 
                </button>
            </div>
            
            <br>
            <br>
        </div>
    </div>
</div>
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/amcharts/amcharts.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/amcharts/serial.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/amcharts/pie.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/amcharts/plugins/responsive/responsive.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('plugins/amcharts/plugins/export/export.js') }}"></script>
<link  type="text/css" href="{{ asset('plugins/amcharts/plugins/export/export.css') }}" rel="stylesheet">

<script>
$('#grafico').load('{{ route('graficos.razones_baja_1') }}');
    $(document).ready( function() { 
        $("#Actualizar").click( function() {   
        if(validar()){  
            var url = '{{ route('graficos.razones_baja_1', ['inicio', 'fin']) }}';
            url = url.replace('inicio', $('#F_inicio').val());
            url = url.replace('fin', $('#F_fin').val());
            $('#grafico').load(url);
        }
    });    
});
function validar(){
    if($('#F_inicio').val() == ''){
        alert('Debe de seleccionar una fecha de inicio');
        $('#F_inicio').focus();
        return false;
    }else{
        if($('#F_fin').val() == ''){
            alert('Debe de seleccionar una fecha de fin');
            $('#F_fin').focus();
            return false;
        }else{
            if($('#F_inicio').val() > $('#F_fin').val()){
                alert('La fecha de inicio no debe de ser mayor a la fecha fin');
                $('#F_fin').focus();
                return false;
            }
        }      
    }
    return true;
}

function exportCharts() {
  // So that we know export was started
  console.log("Starting export...");

  // Define IDs of the charts we want to include in the report
  var ids = ["chartBar"];

  // Collect actual chart objects out of the AmCharts.charts array
  var charts = {},
    charts_remaining = ids.length;
  for (var i = 0; i < ids.length; i++) {
    for (var x = 0; x < AmCharts.charts.length; x++) {
      if (AmCharts.charts[x].div.id == ids[i])
        charts[ids[i]] = AmCharts.charts[x];
    }
  }

  // Trigger export of each chart
  for (var x in charts) {
    if (charts.hasOwnProperty(x)) {
      var chart = charts[x];
      chart["export"].capture({}, function() {
        this.toJPG({}, function(data) {

          // Save chart data into chart object itself
          this.setup.chart.exportedImage = data;

          // Reduce the remaining counter
          charts_remaining--;

          // Check if we got all of the charts
          if (charts_remaining == 0) {
            // Yup, we got all of them
            // Let's proceed to putting PDF together
            generatePDF();
          }

        });
      });
    }
  }

  function generatePDF() {

    // Log
    console.log("Generating PDF...");

    // Initiliaze a PDF layout
    var layout = {
      "content": [],
      "header":[
        {
            table: {
                widths: [170, '*', 170],
                body: [
                    [{
                        margin: 10,
                        border: [false, false, false, false],
                    image: 'data:image/png;base64,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',
                        width: 150,
                        height:70
                    },
                    {
                        text:[
                            {
                                text: "Gráfica de Razones de Baja\n \n",
                                fontSize: 24,
                                bold: true,
                                Arial: true,
                                alignment: 'center',
                                color: '#003297'                            
                            },
                            {
                                text: "Responsable: Human Resources",
                                fontSize: 15,
                                bold: true,
                                Arial: true,
                                alignment: 'center',
                                color: 'gray'
                            },
                        ],
                        margin: 15,  
                        border: [false, false, false, false]
                    }, 
                    {
                        border: [false, false, false, false],
                        text: ''
                    }]
                ]
            }
        }],
              "footer": {
            table:{
              widths: [170, '*', 170],
              body: [
                  [
                    {
                      text: [
                          {
                            text: "Elaboró: \n",
                            fontSize: 14,
                            bold: true,
                            Arial: true,
                            alignment: 'center',
                            color: '#003297'                            
                          },
                          {
                            text: "Head Human Resources \n",
                            fontSize: 12,
                            bold: true,
                            Arial: true,
                            alignment: 'center',
                            color: 'gray'                            
                          },
                      ],
                       margin: 15,  
                       border: [false, false, false, false]
                    },
                    {
                      text: [
                          {
                            text: "Revisó: \n",
                            fontSize: 14,
                            bold: true,
                            Arial: true,
                            alignment: 'center',
                            color: '#003297'                            
                          },
                          {
                            text: "VP Finance & Administration \n",
                            fontSize: 12,
                            bold: true,
                            Arial: true,
                            alignment: 'center',
                            color: 'gray'                            
                          },
                      ],
                      margin: 15,  
                      border: [false, false, false, false]
                    },
                    {
                      text: [
                          {
                            text: "Autorizó: \n",
                            fontSize: 14,
                            bold: true,
                            Arial: true,
                            alignment: 'center',
                            color: '#003297'                            
                          },
                          {
                            text: "Managing Director \n",
                            fontSize: 12,
                            bold: true,
                            Arial: true,
                            alignment: 'center',
                            color: 'gray'                            
                          },
                      ],
                      margin: 15,  
                      border: [false, false, false, false]
                    },
                  ]
              ]
            }
        }

    };

    // Add bigger chart
    layout.content.push({
      "image": charts["chartBar"].exportedImage,
      "width": 810,
      "height":310
    });

    // Trigger the generation and download of the PDF
    // We will use the first chart as a base to execute Export on
    chart["export"].toPDF(layout, function(data) {
      this.download(data, "application/pdf", "gim_razones_bajas.pdf");
    });

  }
}
</script>
@endsection