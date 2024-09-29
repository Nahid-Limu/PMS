<!-- Vertically centered Modal -->
  <div class="modal fade" id="EditProjectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class='bx bxs-edit text-success'></i> Edit Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Vertical Form -->
            <form id="EditProjectForm" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                <input type="hidden" id="edit_data_id" name="id">

                <div class="col-12">
                  <label for="project_name" class="form-label">Project Name</label>
                  <input type="text" class="form-control" name="project_name" id="edit_project_name" required>
                </div>

                <div class="col-12">
                  <label for="project_description" class="form-label">Project Description</label>
                  <textarea class="form-control summerNote" name="project_description" id="edit_project_description" required cols="10" rows="5"></textarea>
                </div>

                <div class="col-12">
                  <label for="project_assisgnTostaff" class="form-label">Assign Project to Staff</label>
                  <select class="form-control" id="edit_project_assisgnTostaff" name="project_assisgnTostaff" required>
                    <option >Select Staff</option>
                    <option value="fahim">fahim</option>
                    <option value="nahid">nahid</option>
                    <option value="mahadi">mahadi</option>
                    <option value="mr x">mr x</option>                       
                  </select>
                </div>

                <div class="col-12">
                  <label for="project_assisgnTostaff" class="form-label">Status</label>
                  <select class="form-control" id="edit_project_status" name="status" required>
    
                    <option value="1">Active</option>
                    <option value="2">InActive</option>
                    <option value="3">Hold</option>          
                  </select>
                </div>


                <div class="text-center">
                  <button type="button" onclick="updateData()" class="btn btn-outline-success btn-sm">Update</button>
                  <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            <!-- Vertical Form -->
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->