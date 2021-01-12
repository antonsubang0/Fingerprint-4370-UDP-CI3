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
                        <div class="col-md-9 col-8">
                            <h4 class="mb-0">Report</h4>
                            <small>Report of Attandance by List</small>
                        </div>
                        <div class="col-md-3 col-4 text-right">
                        	<button class="btn btn-primary mb-2" type="button" data-toggle="collapse" data-target="#collapsExample" aria-expanded="false" aria-controls="collapsExample">
							    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
								  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
								</svg>
							</button>
                            <button type="button" class="ml-2 mb-2 btn btn-primary" data-toggle="modal" data-target="#TambahAtt">Add</button>
                        </div>
                    </div>
                    <div class="row mb-3">
                    	<div class="col">
                    		<div class="collapse" id="collapsExample">
							  <div class="card card-body">
							    <form method="post" action="<?= base_url();?>report">
									<div class="col-md-12">
										<div class="form-group row">
											<label class="mt-2 col-12 col-md-2 col-lg-2 cus-label">Dari :</label>
											<div class="mt-2 col-md-4 col-lg-4 mb-3">
												<div class="input-group">
													<input type="text" id="datepicker" class="form-control" placeholder="dd-mm-yyyy" name="awal" value="<?php if(isset($_SESSION['awal'])){ echo $_SESSION['awal']; }?>" autocomplete="off" required>
												</div>
											</div>
											<label class="mt-2 col-12 col-md-2 col-lg-2 cus-label">Sampai :</label>
											<div class="mt-2 col-md-4 col-lg-4 mb-3">
												<div class="input-group">
													<input type="text" id="datepicker1" class="form-control" placeholder="dd-mm-yyyy" name="akhir" value="<?php if(isset($_SESSION['akhir'])){ echo $_SESSION['akhir']; }?>" autocomplete="off" required>
												</div>
											</div>
											<label class="col-12 col-md-2 col-lg-2 cus-label">Devisi :</label>
											<div class="col-md-4 col-lg-4 mb-3">
												<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="group">
													<?php foreach ($bagian as $a) :?>
														<option value="<?= $a->id; ?>" <?php if(isset($_SESSION['group']) && $_SESSION['group']==$a->id){ echo 'selected="selected"'; }?>><?= $a->bnama; ?></option>
													<?php endforeach;?>
												</select>
											</div>
											<label class="col-12 col-md-2 col-lg-2 cus-label">User :</label>
											<div class="col-md-4 col-lg-4 mb-3">
												<select multiple class="form-control" multiple="multiple" name="personal[]">
													<?php foreach ($user as $b) :?>
														<option value="<?= $b->uid; ?>" <?php if(isset($_SESSION['personal']) && in_array($b->uid, $_SESSION['personal'])){ echo 'selected="selected"'; }?>><?= $b->nama; ?></option>
													<?php endforeach;?>
												</select>
											</div>
											<div class="col-4 ml-3 form-group form-check">
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="show1" name="download" value="1" class="custom-control-input" checked>
													<label class="custom-control-label" for="show1">Show</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="download" name="download" value="2" class="custom-control-input">
													<label class="custom-control-label" for="download">Download</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="mt-3 mt-lg-0 col-12 ml-2 mb-3">
												<button type="submit" name="show" class="btn btn-primary nav-ajs-cs">Show / Download</button>
											</div>
										</div>
										<?php if($this->session->flashdata('status')): ?>
										<div class="text-center alert alert-success" role="alert">
											<?= $this->session->flashdata('status'); ?>
										</div>
										<?php endif; ?>
									</div>
								</form>
							  </div>
							</div>
                    	</div>	
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                            <table id="tabelreport" class="align-middle table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>UID</th>
										<th>ID</th>
										<th>Name</th>
										<th>Bagian</th>
										<th>Waktu</th>
										<th>In/Out</th>
										<th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php $i=1;?>
									<?php if ($tabel==!null):?>
									<?php foreach ($tabel as $row):?>
									<?php if($row->inout==1){
											$inout="Keluar";
										} else {
											$inout="Masuk";
									}?>
										<tr id="<?= $row->no; ?>" class="reportstyle">
											<td><?= $i++;?></td>
											<td><?= $row->uid;?></td>
											<td><?= $row->nama;?></td>
											<td><?= $row->bnama;?></td>
											<td class="<?php if($row->inout==1){ echo "text-danger";} elseif ($row->inout==0) { echo "text-success"; } else { echo "text-warning"; } ?>"><?= date("d-m-Y H:i:s", $row->time); ?></td>
											<td>
												<select id="changeStatus" class="form-control1 <?php if($row->inout==1){ echo "text-danger";} elseif ($row->inout==0) { echo "text-success"; } else { echo "text-warning"; } ?>" name="inout[]">
												<option class="text-danger" value="1" <?php if($row->inout==1){ echo "selected";} ?>>Keluar</option>
												<option class="text-success" value="0" <?php if($row->inout==0){ echo "selected";} ?>>Masuk</option>
												<option class="text-warning" value="5" <?php if($row->inout==5){ echo "selected";} ?>>Mengulang</option>
												</select>
											</td>
											<td><b><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash text-danger deleteabsensi' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
											</b></td>
										</tr>
									<?php endforeach;?>
									<?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>UID</th>
										<th>ID</th>
										<th>Name</th>
										<th>Bagian</th>
										<th>Waktu</th>
										<th>In/Out</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="d-none" id='lastnum'><?= $i; ?></div>      
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
    <div class="modal fade" id="TambahAtt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
		  		<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  			<span aria-hidden="true">&times;</span>
					</button>
		  		</div>
		  		<div class="modal-body">
		  			<div class="form-group">
						<label for="rbagian">Position</label>
						<select id="rbagian" class="form-control" name="bagian">
							<option value="">No Selected</option>
						<?php foreach ($add as $row):?>
							<option value="<?= $row->id;?>"><?= $row->bnama; ?></option>
						<?php endforeach;?>
						</select>
			  		</div>
			  		<div class="form-group">
						<label for="ruser">User</label>
						<select id="ruser" class="form-control" name="uid">
							<option value="">No User</option>
						</select>
			  		</div>
			  		<div class="form-group">
						<label for="rstatus">Status</label>
						<select id="rstatus" class="form-control" name="inout">
							<option value="0">Masuk</option>
							<option value="1">Keluar</option>
						</select>
			  		</div>
			  		<div class="form-group">
						<label for="datetimepicker">Time</label>
						<input name="time" type="text" class="form-control" id="datetimepicker" autocomplete="off" required>
						<!-- datetime-local -->
			  		</div>
		  		</div>
		  		<div class="modal-footer">
					<button class="addrecord btn btn-primary">Save</button>
		  		</div>
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
                    <button class="btn btn-danger yadeleteabsen">Yes</button>
                </div>
            </div>
        </div>
    </div>