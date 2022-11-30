<x-dashboard-layout>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Charts</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <div id="container"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    @push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

     <script>
        $(document).ready(function () {
          function chart(){
          $.ajax({
                type: "GET",
                url: "{{route('charts.index')}}",
                success: function(data) {
              console.log(data);
              barChart(data)
                },

            });
          }     
          chart();
            // Create the chart
          function barChart(data){
            const obj = JSON.parse(data);

            Highcharts.chart('container', {
              chart: {
                type: 'column'
              },
              title: {
                align: 'left',
                text: 'Question Answer Report'
              },
           
              accessibility: {
                announceNewData: {
                  enabled: true
                }
              },
              xAxis: {
                type: 'category'
              },
              yAxis: {
                title: {
                  text: 'Total Users'
                }

              },
              legend: {
                enabled: false
              },
              plotOptions: {
                series: {
                  borderWidth: 0,
                  dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                  }
                }
              },

              tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
              },

              series: [
                {
                  name: "Question",
                  colorByPoint: true,
                  data:obj
                }
              ],
            
            });  
          }   
           
        });
     </script>
    @endpush
</x-dashboard-layout>