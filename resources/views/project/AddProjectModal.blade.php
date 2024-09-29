<!-- Vertically centered Modal -->
  <div class="modal fade" id="AddProjectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title"><i class='bx bxs-file-plus text-success'></i> Add Project</h5>
          <button type="button" onclick="onCloseModal('AddProjectForm')"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <span id="form_result"></span>
        <hr>

        <div class="modal-body">
            <!-- Vertical Form -->
            <form id="AddProjectForm" enctype="multipart/form-data laravel" file="false" class="row g-3 needs-validation" novalidate>
              @csrf

                <div class="col-12">
                  <label for="project_name" class="form-label">Project Name</label>
                  <input type="text" class="form-control" name="project_name" id="project_name" required>
                </div>

                <div class="col-12">
                  <label for="project_description" class="form-label">Project Description</label>
                  <textarea class="form-control summerNote" name="project_description" id="project_description" required cols="10" rows="5"></textarea>
                </div>

                <div class="col-12">
                  <label for="project_assisgnTostaff" class="form-label">Assign Project to Staff</label>
                  <select class="form-control" id="project_assisgnTostaff" name="project_assisgnTostaff" required>
                    <option value="">Select Staff</option>
                    <option value="fahim">fahim</option>
                    <option value="nahid">nahid</option>
                    <option value="mahadi">mahadi</option>
                    <option value="mr x">mr x</option>                       
                  </select>
                </div>

                <div class="col-12">
                  <label for="File Upload" class="form-label">File Upload</label>
                  <input type="file" class="form-control" name="fileUpload" id="fileUpload" required>
                </div>

                <div class="text-center">
                  {{-- <button type="submit" class="btn btn-outline-success btn-sm">Add</button> --}}
                  <button type="button" onclick="addData()" class="btn btn-outline-success btn-sm">Add</button>
                  <button type="reset" onclick="onCloseModal('AddEventForm')" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            <!-- Vertical Form -->
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->

  
  