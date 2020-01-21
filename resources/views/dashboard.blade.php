@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="container-fluid">
                <div class="row my-2">
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3>{!!$children_stats[0]->Under_5!!}</h3>
              
                              <p> Children  (0-4) years</p>
                             
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>{!!$children_stats[0]->Under_9!!}</h3>
              
                              <p>Children  (5-8) years</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>{!!$children_stats[0]->Under_13!!}</h3>
              
                              <p>Children  (9-12) years</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>{!!$children_stats[0]->Teens!!}</h3>
              
                              <p>Teens  (13-18) years</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                            <!-- Class Statistics -->
                            <div class="card card-success">
                              <div class="card-header">
                                <h3 class="card-title">Class Statistics</h3>
                
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                              </div>
                              <div class="card-body">
                                <table class="table table-bordered">
                                  <thead>                  
                                    <tr>
                                      <th style="width: 10px">#</th>
                                      <th>Class</th>
                                      <th>Girls</th>
                                      <th>Boys</th>
                                      <th style="width: 40px">Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1.</td>
                                      <td>Class One</td>
                                      <td>{{$class_one_girls[0]->class_one_girls}}</td>
                                      <td>{{$class_one_boys[0]->class_one_boys}}</td>
                                      <td><span class="badge bg-primary">{!! 
                                            (int)$class_one_girls[0]->class_one_girls
                                            +(int)$class_one_boys[0]->class_one_boys
                                         !!}</span></td>
                                    </tr>
                                    <tr>
                                      <td>2.</td>
                                      <td>Class Two</td>
                                      <td>{{$class_two_girls[0]->class_two_girls}}</td>
                                      <td>{{$class_two_boys[0]->class_two_boys}}</td>
                                      <td><span class="badge bg-primary">{!! 
                                            (int)$class_two_girls[0]->class_two_girls
                                            +(int)$class_two_boys[0]->class_two_boys
                                         !!}</span></td>
                                    </tr>
                                    <tr>
                                      <td>3.</td>
                                      <td>Teens</td>
                                      <td>{{$teens_girls[0]->teens_girls}}</td>
                                      <td>{{$teens_boys[0]->teens_boys}}</td>
                                      <td><span class="badge bg-primary">{!! 
                                            (int)$teens_girls[0]->teens_girls
                                            +(int)$teens_boys[0]->teens_boys
                                         !!}</span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                          <!-- PIE CHART -->
                          <div class="card card-danger">
                            <div class="card-header">
                              <h3 class="card-title">Pie Chart</h3>
              
                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                              </div>
                            </div>
                            <div class="card-body">
                              <canvas id="pieChart" style="height:230px; min-height:230px"></canvas>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                       
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                        </div>
                      </div>

                 </div>
            
            </div>
        </div>
    </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/chart.js/Chart.min.js">
  </script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
  
    //--------------
    //- AREA CHART -
    //--------------
/*    $.get("getcharts", function(data, status){
           $.each(data, function() {
            $.each(this, function(k, v) {
              console.log(k +'= '+ v);
            });
          });
    })
**/
    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July',
      'August', 'September','October', 'November','December'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }
  
  
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutData        = {
      labels: [
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
          'Opera', 
          'Navigator', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
  
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
  
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0
  
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }
  
    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })
  
  })
  </script>


@endsection
