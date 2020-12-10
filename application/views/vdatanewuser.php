
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
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TambahUser">Tambah User</button>
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
												<th>Send Register</th>
												<th>Send Info</th>
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
											<td>
												<?php foreach ($daftarmesin as $a) :?>
												<a href="registrasi/<?=$a->id;?>/<?=$row->uid;?>" class="mt-2 btn btn-info"><?=$a->namamesin;?></a>
												<?php endforeach;?>
											</td>
											<td>
												<?php foreach ($daftarmesin as $a) :?>
												<a href="informasi/<?=$a->id;?>/<?=$row->uid;?>" class="mt-2 btn btn-primary"><?=$a->namamesin;?></a>
												<?php endforeach;?>
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
						<div class="modal fade" id="TambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <form method="post" action="<?= base_url();?>home/tambahuser">
								  <div class="modal-body">
									  <div class="form-group">
										<label for="nerw">New UID</label>
										<input name="tuid" type="text" class="form-control" id="nerw" aria-describedby="emailHelp">
									  </div>
									  <div class="form-group">
										<label for="nerw">New User</label>
										<input name="tuser" type="text" class="form-control" id="nerw" aria-describedby="emailHelp">
									  </div>
									  <div class="form-group">
										<label for="nerw">Devisi</label>
										<select id="inputState" class="form-control" name="tdevisi">
												<?php foreach ($bagian as $a) :?>
												<option value="<?= $a->id; ?>"><?= $a->bnama; ?></option>
												<?php endforeach;?>
										</select>
									  </div>
									  <div class="form-group">
										<label for="nerw">Role</label>
										<select id="inputState" class="form-control" name="trole">
												<option value="0">User</option>
												<option value="14">Admin</option>
										</select>
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
