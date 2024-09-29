<!-- Vertically centered Modal -->
  <div class="modal fade" id="DeleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class='bx bxs-trash text-danger'></i> Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Click <kbd class="bg-danger">"Delete"</kbd> button below if you are <strong>Sure</strong> to <strong class="text-danger">Delete</strong> this <br> <strong id="data" class="text-primary"></strong> Data from <strong id="listName"></strong>. 
          
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> --}}
          <input type="hidden" id="data_id" value="">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button onclick="deleteTableData($('#data_id').val())" class="btn btn-sm btn-outline-danger float-right" type="button">Delete</button>
        </div>
      </div>
    </div>
  </div><!-- End Vertically centered Modal-->