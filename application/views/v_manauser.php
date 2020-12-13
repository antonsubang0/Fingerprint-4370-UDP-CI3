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
                            <h4 class="mb-0">Management User</h4>
                            <small>List of User, Position, Register and Information</small>
                        </div>
                        <div class="col-md-2 col-3 text-right">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">Add</button>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">   
                        	<table id="cobacoba" class="align-middle table table-sm table-striped table-bordered" style="width:100%; font-size: 1em;">
		                    	<thead>
		                            <tr class="salah">
		                                <th>No</th>
										<th>ID</th>
										<th>Name</th>
										<th>Role</th>
										<th>Position</th>
		                            </tr>
		                        </thead>
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
					<h5 class="modal-title" id="exampleModalLabel">Add User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  		<span aria-hidden="true">&times;</span>
					</button>
			  	</div>
		  		<div class="modal-body">
			  		<div class="form-group">
						<label for="tuid">New UID</label>
						<input name="tuid" type="text" class="form-control" id="tuid" aria-describedby="emailHelp" required>
			  		</div>
			  		<div class="form-group">
						<label for="tuser">New User</label>
						<input name="tuser" type="text" class="form-control" id="tuser" aria-describedby="emailHelp" required>
			  		</div>
			  		<div class="form-group">
						<label for="tbagian">Position</label>
						<select id="tbagian" class="form-control" name="tdevisi">
							<?php foreach ($bagian as $a) :?>
							<option value="<?= $a->id; ?>"><?= $a->bnama; ?></option>
							<?php endforeach;?>
						</select>
			  		</div>
			  		<div class="form-group">
						<label for="trole">Role</label>
						<select id="trole" class="form-control" name="trole">
							<option value="0">User</option>
							<option value="14">Admin</option>
						</select>
			  		</div>
		  		</div>
		  		<div class="modal-footer">
					<button id="tambahuser" class="btn btn-primary">Add</button>
		  		</div>
			</div>
        </div>
    </div>

    <!-- modal ubahnama -->
    <div class="modal fade" id="ubahnama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
			  	<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Change / Action</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  		<span aria-hidden="true">&times;</span>
					</button>
			  	</div>
			  	<div class="modal-body">
		  			<div class="form-row">
				  		<div class="form-group col-md-6">
							<label for="nerw">UID</label>
							<input name="cuid" type="text" class="form-control" id="cuid" aria-describedby="emailHelp" disabled>
				  		</div>
				  		<div class="form-group col-md-6">
							<label for="nerw">Username</label>
							<input name="cuser" type="text" class="form-control" id="cuser" aria-describedby="emailHelp" required>
				  		</div>
			  		</div>
			  		<div class="form-row">
				  		<div class="form-group col-md-6">
							<label for="cdevisi">Position</label>
							<select id="cdevisi" class="form-control" name="cdevisi">
								<?php foreach ($bagian as $a) :?>
								<option value="<?= $a->id; ?>"><?= $a->bnama; ?></option>
								<?php endforeach;?>
							</select>
				  		</div>
				  		<div class="form-group col-md-6">
							<label for="crole">Role</label>
							<select id="crole" class="form-control" name="crole">
								<option value="0">User</option>
								<option value="14">Admin</option>
							</select>
				  		</div>
				  	</div>
				  	<div class="dropdown-divider"></div>
				  	<div class="form-row text-center">
				  		<div class="col-md-6">
				  			<button id="saveuser" class="btn btn-primary">Save</button>
				  		</div>
				  		<div class="col-md-6">
				  			<button id="deleteuser" class="btn btn-danger">Delete</button>
				  		</div>
				  	</div>
				  	<div class="dropdown-divider"></div>
				  	<div class="form-row">
				  		<div class="col-12 text-center">
				  			<label>Register User to Machine</label>
				  		</div>
				  	</div>
				  	<div class="form-row text-center">
			  			<?php foreach ($daftarmesin as $mesin) :?>
			  				<div class="form-group col-md-6">
                                <button class="btn btn-primary sendregisteruser" data-nomesin="<?= $mesin->id; ?>" <?= ($statusMachine[$mesin->ipmesin]>0) ? 'disabled' : ''; ?>><?= $mesin->namamesin; ?></button>
                            </div>
						<?php endforeach; ?>
				  	</div>
				  	<div class="dropdown-divider"></div>
			  		<div class="form-row">
				  		<div class="col-12 text-center">
				  			<label>Send Info User to Machine</label>
				  		</div>
				  	</div>
				  	<div class="form-row text-center">
			  			<?php foreach ($daftarmesin as $mesin) :?>
			  				<div class="form-group col-md-6">
                                <button class="btn btn-info sendinfouser" data-nomesin="<?= $mesin->id; ?>" <?= ($statusMachine[$mesin->ipmesin]>0) ? 'disabled' : ''; ?>><?= $mesin->namamesin; ?></button>
                            </div>
						<?php endforeach; ?>
				  	</div>
		  		</div>
			</div>
        </div>
    </div>