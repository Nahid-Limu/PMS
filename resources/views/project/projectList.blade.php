@extends('layouts.app')

@section('title', 'Project')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Project</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item">Project</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    
                  <h6 class="m-0 font-weight-bold text-primary"><i class='bx bx-file-blank'> Project LIST</i></h6>
                    
                  {{-- flash Message --}}
                    <div id="success_message" class="alert alert-success alert-dismissible fade" role="alert"></div>
                  {{-- flash Message --}}

                  <div class="dropdown no-arrow">
                    <button type="button" class="btn btn-sm btn-outline-success " data-bs-toggle="modal"  data-bs-target="#AddProjectModal"><i class='bx bxs-file-plus'></i> Create New Project</button>
                  </div>

                </div>

                <!-- Table with stripped rows -->
                <table class="table table-responsive" id="ProjectListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Project Name</th>
                      <th scope="col">Project Description</th>
                      <th scope="col">Assisgn To Staff</th>
                      <th scope="col">Files</th>
                      <th scope="col">status</th>
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

       @include('project.AddProjectModal') 
       @include('project.editProjecModal') 

       @include('include.admin.deleteModal') 

</main><!-- End #main -->

@endsection

@section('script')
<script>

  //Table Data
  $('#ProjectListTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        "order": [[ 0, "asc" ]],
        ajax:{
        url: "{{ route('projectList') }}",
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
              data: 'project_description',
              name: 'project_description'
          },
          {
              data: 'project_assisgnTostaff',
              name: 'project_assisgnTostaff'
          },
          {
              data: 'project_fileUpload',
              name: 'project_fileUpload'
          },
          {
              data: 'status',
              name: 'status'
          },
          {
              data: 'action',
              name: 'action',
              orderable: false
          }
        ]
  });


  //Add Table Data
  function addData() {

    var form = $('#AddProjectForm')[0];
    var formdata = new FormData(form);
    $.ajax({
            url:"{{ route('projectAdd') }}",
            method:"POST",
            data:formdata,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
              // console.log(response);

              // validation
              var html = '';
              if(response.errors)
              {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < response.errors.length; count++)
                {
                html += '<p>' + response.errors[count] + '</p>';
                }
                html += '</div>';
                
              }
              $('#form_result').html(html);

              //success
              if (response.success) {
                
                $("#success_message").text(response.success);
                $('#ProjectListTable').DataTable().ajax.reload();
                $('#AddProjectModal').modal('hide');
                $("#AddProjectForm").trigger("reset");
                // alert(response.success);
                SuccessMsg();

                location.reload();
              }

            },
            error: function(response) {
                // console.log(response);
            }
    })

  }

  //Edit Table Data
  function editData(id) {
    // alert(id);
    $("#EditProjectModal").trigger("reset");
    $.ajax({
        type: 'GET',
        url: "{{url('projectEdit')}}"+"/"+id,
        // dataType: "html",
        success: function (response) {
            // console.log(response);
            if (response) {
              
              $('#edit_data_id').val(response.id);
              $('#edit_project_name').val(response.project_name);
              $('#edit_project_description').summernote('code', response.project_description);
              $('#edit_project_assisgnTostaff option[value="'+response.project_assisgnTostaff+'"]').attr("selected", "selected");
              $('#edit_project_status option[value="'+response.status+'"]').attr("selected", "selected");
              // $("#imageView").attr("src", "assets/img/events/"+ response.image);
              
            }

        },error:function(){ 
            console.log(response);
        }
    });
  }


  //Update Table Data
  function updateData(params) {
    // alert();
    var form = $('#EditProjectForm')[0];
    var formdata = new FormData(form);

    $.ajax({
            url:"{{ route('projectUpdate') }}",
            method:"POST",
            data:formdata,
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
              // console.log(response);
              if (response.success) {
                
                $("#success_message").text(response.success);
                $('#ProjectListTable').DataTable().ajax.reload();
                $('#EditProjectModal').modal('hide');
                
                SuccessMsg();

                location.reload();
              }
            },
            error: function(response) {
                // console.log(response);
            }
    })
  }

  //Delete Table Data
  function deleteTableData(id) {
    // alert(id);
    $.ajax({
        type: 'GET',
        url: "{{url('projectDelete')}}"+"/"+id,
        success: function (response) {
            // console.log(response);
            if (response.success) {
                    
              $("#success_message").text(response.success);
              $('#ProjectListTable').DataTable().ajax.reload();
              $('#DeleteModal').modal('hide');

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
