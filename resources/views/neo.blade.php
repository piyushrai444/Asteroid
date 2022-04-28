@extends('layouts.app')

@section('content')
<!------ Include the above in your HEAD tag ---------->
  
        <!--MDB Forms-->
        <div class="container mt-12">

            <div class="text-center darken-grey-text mb-8">
                <h1 class="font-bold mt-4 mb-3 h5">Asteroids</h1>
            </div>

            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center default-text py-3"><i class="fa fa-lock"></i> Neo - Feed:</h3>
                            <!--Body-->
                            <form action="{{route('findAsteroid')}}" method="post">
                              @csrf
                              <div class="form-group">
                                <label for="defaultForm-pass">Start Date</label>
                                <div class='input-group date' id='datetimepicker'>
                                  <input type='text' class="form-control" name="start_date" placeholder="YYYY-MM-DD"/>
                                  
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="defaultForm-pass">End Date</label>
                                <div class='input-group date' id='datetimepicker2'>
                                  <input type='text' class="form-control"  name="end_date" placeholder="YYYY-MM-DD"/>
                                  <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                </div>
                              </div>
                              
                              <div class="text-center">
                                  <button type="submit" class="btn btn-default waves-effect waves-light">Submit</button>
                              </div>
                            </form>
                          </div>
                    </div>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
        <!--MDB Forms-->
    
        <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>
  
    @section('script')
    <script type="text/javascript">
        $(function() {
           $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
           });

           $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
           });
        });
    </script> 
@endsection
@endsection