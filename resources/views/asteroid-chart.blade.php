@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" >
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">Asteroids</div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">Fastest Astroid</div>
                <div class="panel-body">
                    <canvas id="canvas1" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">Closest Astroid</div>
                <div class="panel-body">
                    <canvas id="canvas2" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">Average Size</div>
                <div class="panel-body">
                    <canvas id="canvas3" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var dates = <?php echo $dates; ?>;
    var asteroids_count = <?php echo $asteroids_count; ?>;
    var fastest_astroid = <?php echo $fastest_astroid; ?>;
    var closest_astroid = <?php echo $closest_astroid; ?>;
    var average_size = <?php echo $average_size; ?>;

    var Asteroids_count = {
        labels: dates,
        datasets: [{
            label: 'Asteroids' ,
            backgroundColor: "rgba(200, 167, 125, 1)",
            data: asteroids_count,
            },
        ]
    };
    var fastest_astroid_bar = {
        labels: dates,
        datasets: [{
            label: 'Fastest Astroid' ,
            backgroundColor: "rgba(6, 100, 125, 1)",
            data: fastest_astroid,
            },
        ]
    };
    var closest_astroid_bar = {
        labels: dates,
        datasets: [{
            label: 'Closest Astroid' ,
            backgroundColor: "rgba(6, 167, 198, 1)",
            data: closest_astroid,
            },
        ]
    };

    var average_size_bar = {
        labels: dates,
        datasets: [{
            label: 'Average Size' ,
            backgroundColor: "rgba(6, 167, 125, 1)",
            data: average_size,
            },
        ]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: Asteroids_count,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Asteroids'
                }
                
            }
        });

        var ctx1 = document.getElementById("canvas1").getContext("2d");
        window.myBar = new Chart(ctx1, {
            type: 'bar',
            data: fastest_astroid_bar,
            options: {
                scales: {
                    yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Kilometer/ Hour'
                    }
                    }]
                },
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Fastest Astroid'
                }
                
            }
        });

        var ctx2 = document.getElementById("canvas2").getContext("2d");
        window.myBar = new Chart(ctx2, {
            type: 'bar',
            data: closest_astroid_bar,
            options: {
                scales: {
                    yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Kilometers'
                    }
                    }]
                },  
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Closest Astroid'
                }
                
            }
        });

        var ctx3 = document.getElementById("canvas3").getContext("2d");
        window.myBar = new Chart(ctx3, {
            type: 'bar',
            data: average_size_bar,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Average Size'
                }
                
            }
        });
    };
    
</script>
@endsection