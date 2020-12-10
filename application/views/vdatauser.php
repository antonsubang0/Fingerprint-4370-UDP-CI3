
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
										<h5 class="card-title mt-2">Management User</h5>
									</div>
									<div class="col-12 col-lg-6 text-lg-right">
									</div>
								</div>
								<?php if($this->session->flashdata('status')): ?>
								<div class="text-center alert alert-success" role="alert">
									<?= $this->session->flashdata('status'); ?>
								</div>
								<?php endif; ?>
								<form method="post" action="<?= base_url();?>home/ubahbagian">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>ID</th>
												<th>Name</th>
												<th>Role</th>
												<th>Bagian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php $i=1; ?>
										<?php
										foreach ($result as $row) :
										if ($row->role == 14) {
												$role = 'ADMIN';
										} elseif ($row->role == 0) {
												$role = 'USER';
										} else {
												$role = 'Unknown';
										}
										?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= $row->uid; ?></td>
											<td><?= $row->nama; ?></td>
											<td><?= $role; ?></td>
											<td>
												<select id="inputState" class="form-control" name="pbagian[]">
												<option value="<?= $row->uid; ?>,<?= $row->bagian; ?>" selected><?= $row->bnama; ?></option>
												<?php foreach ($bagian as $a) :?>
												<option value="<?= $row->uid; ?>,<?= $a->id; ?>"><?= $a->bnama; ?></option>
												<?php endforeach;?>
												</select>
											</td>
										</tr>
										<?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><button class="btn btn-primary" type="submit">Simpan</button></th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
