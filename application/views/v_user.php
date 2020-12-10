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
                            <h4 class="mb-0">Data User</h4>
                            <small>Data User on <?= $mesin; ?></small>
                        </div>
                        <div class="col-md-2 col-3 text-right">
                            <a class="btn btn-primary" href="<?= base_url();?>home/downloaduser/<?= $idmesin; ?>">Download</a>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                            <table id="tabel1" class="table table-sm table-striped table-bordered align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>UID</th>
										<th>ID</th>
										<th>Name</th>
										<th>Role</th>
										<th>Bagian</th>
										<th>Password</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								while(list($uid, $userdata) = each($user)):
									if ($userdata[4] == 14)
										$role = 'ADMIN';
									elseif ($userdata[4] == 0)
										$role = 'USER';
									else
										$role = 'Unknown';
								?>
								<tr>
									<td><?php echo $uid ?></td>
									<td><?php echo $userdata[0] ?></td>
									<td><?php echo $userdata[1] ?></td>
									<td><?php echo $role ?></td>
									<?php if ($bagian[$base[$userdata[0]]['bagian']]==NULL): ?>
									<td>Unknown</td>
									<?php else: ?>
									<td><?= $bagian[$base[$userdata[0]]['bagian']] ?></td>
									<?php endif; ?>
									<td><?php echo $userdata[3] ?>&nbsp;</td>
								</tr>
								<?php
								endwhile; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>UID</th>
										<th>ID</th>
										<th>Name</th>
										<th>Role</th>
										<th>Password</th>
                                    </tr>
                                </tfoot>
                            </table>     
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
					<h5 class="modal-title" id="exampleModalLabel">Add Machine</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  		<span aria-hidden="true">&times;</span>
					</button>
			  	</div>
			  	<form method="post" action="<?= base_url();?>setting/addmachine">
			  	<div class="modal-body">
				  	<div class="form-group">
						<label for="nerw">Name Machine</label>
						<input name="nama" type="text" class="form-control" id="nerw" aria-describedby="emailHelp">
				  	</div>
				  	<div class="form-group">
						<label for="nerq">IP Machine</label>
						<input name="ip" type="text" class="form-control" id="nerq" aria-describedby="emai">
				  	</div>
			  	</div>
			  	<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
			  	</div>
			  	</form>
			</div>
        </div>
    </div>