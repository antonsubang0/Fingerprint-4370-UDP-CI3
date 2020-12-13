        <div class="col-md-9 col-10 pt-2 px-2 bg-light">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                    	<div class="col-12 position-absolute d-flex justify-content-center">
                    	<?php if($this->session->flashdata('status')): ?>
                            <div class="alert alert-info homenotif-cs notif-time shadow-sm" role="alert">
							<?= $this->session->flashdata('status'); ?>
							</div>
						<?php endif; ?>
						</div>
                        <div class="col-md-10 col-9">
                            <h4 class="mb-0">Management Position</h4>
                            <small>List of Position</small>
                        </div>
                        <div class="col-md-2 col-3 text-right">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">Add</button>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                        	<form method="post" action="<?= base_url();?>home/dbagian">
	                            <table id="tabeldevisi" class="table table-sm table-striped table-bordered align-middle" style="width:100%">
	                                <thead>
                                        <tr>
                                            <th>No</th>
											<th>Position</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
	                            </table>
                            </form>      
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-1 mt-3 border-danger bg-white pt-3 pb-3 border-top shadow rounded-lg-top">
                <div class="col text-center">
                    <h6 class="mb-0">Powered by Antonius</h6>
                    <small>@ 2016-2022</small>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
			  	<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Position</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  	<span aria-hidden="true">&times;</span>
					</button>
			  	</div>
			  	<form method="post" action="<?= base_url();?>home/tbagian">
			  		<div class="modal-body">
				  		<div class="form-group">
							<label for="tbagian">New Position</label>
							<input name="tbagian" type="text" class="form-control" id="tbagian" aria-describedby="emailHelp" required>
				  		</div>
			  		</div>
			  		<div class="modal-footer">
						<button id="tambahdevisi" type="submit" class="btn btn-primary">Save</button>
			  		</div>
			  	</form>
			</div>
        </div>
    </div>
    <div class="modal fade" id="modaldelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ask</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you want delete ?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary cancel">Cancel</button>
                    <button class="btn btn-danger yadeletedevisi">Yes</button>
                </div>
            </div>
        </div>
    </div>