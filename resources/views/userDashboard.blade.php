@extends('backend/layouts/app')
@section('content') 
 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                  
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">

                  <div class="col-md-4">

                    <form>
                      @csrf
                      <div class="form-group">
                        <label for="total-sales">Total Sales</label>
                        <input type="number" class="form-control" placeholder="Enter total sales">
                      </div>
                      <div class="form-group">
                        <label for="sale-date">Sale Date</label>
                        <input type="date" class="form-control" placeholder="Enter sale date">
                      </div>
                      <div class="form-group">
                          <button type="button" class="btn btn-primary" onclick="addSales()">Save</button>
                      </div>
                    </form>

                </div>

                <div class="col-md-4">
              
                </div>

                <br>
                <br>

                  <div class="col-md-12">
             
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="thead-light">
                        <tr>
                          <th>ID</th>
                          <th>Total Sales</th>
                          <th>Sale Date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($sales as $sale)
                        <tr>
                          <td>{{ $sale->id }}</td>
                          <td>{{ $sale->total_sales }}</td>
                          <td>{{ $sale->sale_date }}</td>
                          <td>
                            <button type="button" class="edit-btn btn btn-primary" id="{{ $sale->id }}">Edit</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-saleid="{{ $sale->id }}" onclick="return confirm('Are you sure you want to delete this sale?');">Delete</button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                    

                  </div>


                  <div class="col-md-8">

                  <script src="https://cdnjs.com/libraries/Chart.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

                  <div class="map_canvas">
                       <canvas id="myChart" width="auto" height="100"></canvas>
                  </div>



                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Sale</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-form" method="post" >
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" id="sale-id">
            <div class="form-group">
                <label for="total-sales">Total Sales</label>
                <input type="text" class="form-control" id="total-sales" name="totalSales">
            </div>
            <div class="form-group">
                <label for="sale-date">Sale Date</label>
                <input type="date" class="form-control" id="sale-date" name="saleDate">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-edit-btn">Save changes</button>
      </div>
    </div>
  </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>

$(document).on('click', '.edit-btn', function() {
  var saleId = $(this).attr('id');

    $.ajax({
        url: '/sales/' + saleId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#sale-id').val(data.id);
            $('#total-sales').val(data.total_sales);
            $('#sale-date').val(data.sale_date);
            $('#editModal').modal('show');
        }
    });
});


function addSales() {
  var totalSales = $("#total-sales").val();
  var saleDate = $("#sale-date").val();

  $.ajax({
    type: "POST",
    url: "/sales/create",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: { totalSales: totalSales, saleDate: saleDate },
    success: function(response) {
      alert("Data added successfully!");
      location.reload();
    },
    error: function(response) {
      alert("Error adding data.");
    }
  });
}
</script>

  
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: <?php echo json_encode($labels) ?>,
          datasets: [{
              label: '',
              data: <?php echo json_encode($prices); ?>,
              backgroundColor: [
                  'rgba(31, 58, 147, 1)',
                  'rgba(37, 116, 169, 1)',
                  'rgba(92, 151, 191, 1)',
                  'rgb(200, 247, 197)',
                  'rgb(77, 175, 124)',
                  'rgb(30, 130, 76)'
              ],
              borderColor: [
                  'rgba(31, 58, 147, 1)',
                  'rgba(37, 116, 169, 1)',
                  'rgba(92, 151, 191, 1)',
                  'rgb(200, 247, 197)',
                  'rgb(77, 175, 124)',
                  'rgb(30, 130, 76)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  max: 500,
                  min: 0,
                  ticks: {
                      stepSize: 10
                  }
              },
          },
          plugins: {
              title: {
                  display: false,
                  text: 'Custom Chart Title'
              },
              legend: {
                  display: false,
              }
          },
          barThickness: 20
      }
  });
  </script>

  
  @endsection

  