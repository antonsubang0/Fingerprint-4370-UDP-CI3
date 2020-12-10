
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
									<div class="col-12 col-lg-6">
										<h5 class="card-title mt-2">Management Devisi</h5>
									</div>
									<div class="col-12 col-lg-6 text-lg-right">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TambahDevisi">Tambah Devisi</button>
									</div>
								</div>
								<?php if($this->session->flashdata('status')): ?>
								<div class="text-center alert alert-success" role="alert">
									<?= $this->session->flashdata('status'); ?>
								</div>
								<?php endif; ?>
								<form method="post" action="<?= base_url();?>home/dbagian">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>Bagian</th>
												<th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php
										$i=1;
										
										foreach ($result as $row) :
										?>
										<tr>
											<td><?= $i++ ?></td>
											<td><?= $row->bnama; ?></td>
											<td><input type="checkbox" name="dbagian[]" value="<?= $row->id; ?>"></td>
										</tr>
										<?php endforeach;?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><button class="btn btn-primary" type="submit">Delete</button></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
								</form>
                            </div>
							<div class="modal fade" id="TambahDevisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Tambah Devisi</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <form method="post" action="<?= base_url();?>home/tbagian">
								  <div class="modal-body">
									  <div class="form-group">
										<label for="nerw">New Devisi</label>
										<input name="tbagian" type="text" class="form-control" id="nerw" aria-describedby="emailHelp">
									  </div>
								  </div>
								  <div class="modal-footer">
									<button type="submit" class="btn btn-primary">Save</button>
								  </div>
								  </form>
								</div>
							  </div>
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
