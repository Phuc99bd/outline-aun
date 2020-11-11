<div class="modal fade " id="bd-outline-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create outline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 mb-3">
                <div class="form-group"> 
                        <h5 for="validationCustom01">Tên đề cương</h5>
                                            <input type="text" class="form-control input-outline" id="validationCustom01" placeholder="Title" value="" required="" autofocus>
                                         

                </div>
                <div class="form-group"> 

                <h5 for="validationCustom01">Môn học</h5>
                                            <select class="form-control-sm form-control input-outline-list">
                                                      
                                            </select>
                </div>
                <div class="form-group"> 

                <h5 for="validationCustom01">Chọn loại đề cương</h5>
                                            <select class="form-control-sm form-control practice-outline">
                                                     <option value="0"> Lý thuyết </option> 
                                                     <option value="1"> Thực hành </option> 
                                            </select>
                </div>
                </div>
                
                                            
                                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-out-modal" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-outline-create" data-id={{ $user->id }}>Save changes</button>
            </div>
        </div>
    </div>
</div>