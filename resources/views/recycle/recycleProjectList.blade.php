@extends('layouts.app')

@section('title', 'Recycle Bin')

@section('content')

  <main id="main" class="main">

      <div class="pagetitle">
        <h1>Project</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item">Recycle Bin</li>
            <li class="breadcrumb-item active">Project List</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
            <div class="col-lg-12">
    
              <div class="card">
                <div class="card-body">
                  
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      
                    <h6 class="m-0 font-weight-bold text-primary"><i class='bx bx-file-find'> Deleted Project LIST</i></h6>
                      
                    {{-- flash Message --}}
                      <div id="success_message" class="alert alert-success alert-dismissible fade" role="alert"></div>
                    {{-- flash Message --}}

                    

                  </div>

                  <!-- Table with stripped rows -->
                  <table class="table table-responsive" id="DeletedProjectListTable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Project Name</th>
                        <th scope="col">Deleted Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    
                  </table>
                  <!-- End Table with stripped rows -->
    
                </div>
              </div>
    
            </div>
          </div>
      </section>

  </main><!-- End #main -->

@endsection

@section('script')

<script>

  //Table Data
  $('#DeletedProjectListTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "order": [[ 0, "asc" ]],
        ajax:{
        url: "{{ route('recycleProjectList') }}",
        },
        columns:[
          { 
              data: 'DT_RowIndex', 
              name: 'DT_RowIndex' 
          },
          {
              data: 'project_name',
              name: 'project_name'
          },
          {
              data: 'deleted_at',
              name: 'deleted_at'
          },
          {
              data: 'action',
              name: 'action',
              orderable: false
          }
        ]
  });

  //restore Data
  function restoreData(id) {
    // alert(id);
    $.ajax({
        type: 'GET',
        url: "{{url('projectRestore')}}"+"/"+id,
        success: function (response) {
            // console.log(response);
            if (response.success) {
                    
              $("#success_message").text(response.success);
              $('#DeletedProjectListTable').DataTable().ajax.reload();
              // $('#DeleteModal').modal('hide');

              SuccessMsg();
              location.reload();
            }

        },error:function(){ 
            console.log(response);
        }
    });
  }

</script>

@endsection
restoreData