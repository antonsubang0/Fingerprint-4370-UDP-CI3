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
                            <h4 class="mb-0">Retore</h4>
                            <small>Restore Fingerprint to Machines</small>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                            <table id="tabelrestore" class="table table-sm table-striped table-bordered align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
										<th>Machine</th>
										<th>Restore</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
								<tfoot>
								</tfoot>
                            </table>      
                        </div>
                    </div>
                    <div id="numlast" class="d-none"><?= $i; ?></div>
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
    <div class="modal fade" id="modalrestore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ask</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you want restore to this machine ?</p>
                    <small class="text-danger">Note : This will delete all user and write from computer to machine.</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="yesrestoremachine" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>