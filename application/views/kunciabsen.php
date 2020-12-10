
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card pl-3">
                            <div class="card-body">
							<form action="setkunciabsen" method="post">
								<h4 class="card-title mt-5">Password</h4>
								<?php if($this->session->flashdata('status')): ?>
										<div class="text-center alert alert-success" role="alert">
								<?= $this->session->flashdata('status'); ?>
										</div>
								<?php endif;?>
								<div class="form-group row mt-5">
									<label for="fname" class="col-sm-2 control-label col-form-label">Username</label>
									<div class="col-sm-6">
										<input type="text" value="<?= $user["username"];?>" name="username" class="form-control" id="fname" placeholder="Username Here">
									</div>
								</div>
								<div class="form-group row">
									<label for="lname" class="col-sm-2 control-label col-form-label">Password</label>
									<div class="col-sm-6">
										<input type="password" name="password" class="form-control" id="lname" placeholder="Password Here">
									</div>
								</div>
								<div class="border-top mt-5 mb-5">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
							</form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->