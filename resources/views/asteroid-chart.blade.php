@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
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

    // var asteroids_data = [
    //     {
    //         astroids_count : 20,
    //         fastest_astroids : 2266355,
    //         speed: 33773
    //     },
    //     {
    //         astroids_count : 20,
    //         fastest_astroids : 2266355,
    //         speed: 33773
    //     },
    //     {
    //         astroids_count : 20,
    //         fastest_astroids : 2266355,
    //         speed: 33773
    //     }, 
    // ];

    var Asteroids = {
        labels: dates,
        datasets: [{
            label: 'Asteroids' ,
            backgroundColor: "rgba(6, 167, 125, 1)",
            data: asteroids_count,
            },
        ]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: Asteroids,
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
                    text: 'Neo Feed'
                }
                
            }
        });
    };
</script>
@endsection