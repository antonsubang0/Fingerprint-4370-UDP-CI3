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
                            <h4 class="mb-0">Password</h4>
                            <small>Change Username and Password</small>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                        	<form action="setkunciabsen" method="post">
                        		<div class="form-group row mt-5 ml-3">
									<label for="fname" class="col-sm-2 control-label col-form-label">Username</label>
									<div class="col-sm-6">
										<input type="text" value="<?= $user["username"];?>" name="username" class="form-control" id="fname" placeholder="Username Here">
									</div>
								</div>
								<div class="form-group row ml-3">
									<label for="lname" class="col-sm-2 control-label col-form-label">Password</label>
									<div class="col-sm-6">
										<input type="password" name="password" class="form-control" id="lname" placeholder="Password Here">
									</div>
								</div>
								<div class="border-bottom mt-5 mb-5">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
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