
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
										<h5 class="card-title mt-2">Data Absen</h5>
									</div>
								</div>
								<form method="post" action="<?= base_url();?>report">
									<div class="col-md-11">
										<div class="form-group row">
											<label class="mt-2 col-12 col-md-2 col-lg-1 cus-label">Dari :</label>
											<div class="mt-2 col-md-4 col-lg-5 mb-3">
												<div class="input-group">
													<input type="date" class="form-control" placeholder="mm/dd/yyyy" name="awal" value="<?php if(isset($_POST['awal'])){ echo $_POST['awal']; }?>">
												</div>
											</div>
											<label class="mt-2 col-12 col-md-2 col-lg-1 cus-label">Sampai :</label>
											<div class="mt-2 col-md-4 col-lg-5 mb-3">
												<div class="input-group">
													<input type="date" class="form-control" placeholder="mm/dd/yyyy" name="akhir" value="<?php if(isset($_POST['akhir'])){ echo $_POST['akhir']; }?>">
												</div>
											</div>
											<label class="col-12 col-md-2 col-lg-1 cus-label">Devisi :</label>
											<div class="col-md-4 col-lg-5">
												<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="group">
													<?php foreach ($bagian as $a) :?>
														<option value="<?= $a->id; ?>" <?php if(isset($_POST['group']) && $_POST['group']==$a->id){ echo 'selected="selected"'; }?>><?= $a->bnama; ?></option>
													<?php endforeach;?>
												</select>
											</div>
											<label class="col-12 col-md-2 col-lg-1 cus-label">User :</label>
											<div class="col-md-4 col-lg-5">
												<select multiple class="form-control" multiple="multiple" name="personal[]">
													<?php foreach ($user as $b) :?>
														<option value="<?= $b->uid; ?>" <?php if(isset($_POST['personal']) && in_array($b->uid, $_POST['personal'])){ echo 'selected="selected"'; }?>><?= $b->nama; ?></option>
													<?php endforeach;?>
												</select>
											</div>
											<div class="col-4 ml-2 form-group form-check">
												<input type="checkbox" name="download" value="2" class="form-check-input" id="exampleCheck1">
												<label class="form-check-label" for="exampleCheck1">Download</label>
											</div>
										</div>
										<div class="row">
											<div class="mt-3 mt-lg-0 col-12 ml-2 mb-3">
												<button type="submit" name="show" class="btn btn-primary">Show / Download</button>
												<button type="button" class="ml-2 btn btn-primary" data-toggle="modal" data-target="#TambahAtt">Tambah Record</button>
											</div>
										</div>
										<?php if($this->session->flashdata('status')): ?>
										<div class="text-center alert alert-success" role="alert">
											<?= $this->session->flashdata('status'); ?>
										</div>
										<?php endif; ?>
									</div>
								</form>
								<form method="post" action="<?= base_url();?>report/delabsensi">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
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
												<tr>
													<td><?= $i++;?></td>
													<td><?= $row->uid;?></td>
													<td><?= $row->nama;?></td>
													<td><?= $row->bnama;?></td>
													<td class="<?php if($row->inout==1){ echo "text-danger";} else { echo "text-success"; } ?>"><?= date("d-m-Y H:i:s", $row->time); ?></td>
													<td>
														<select id="inputState" class="form-control <?php if($row->inout==1){ echo "text-danger";} else { echo "text-success"; } ?>" name="inout[]">
														<option class="text-danger" value="1,<?= $row->no; ?>" <?php if($row->inout==1){ echo "selected";} ?>>Keluar</option>
														<option class="text-success" value="0,<?= $row->no; ?>" <?php if($row->inout==0){ echo "selected";} ?>>Masuk</option>
														</select>
													</td>
													<td><input type="checkbox" name="absendelete[]" value="<?= $row->no; ?>"></td>
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
                                </div>
								<div class="row ml-2 mt-3"><button class="btn btn-primary" type="submit">Ubah/Hapus</button></div>
                            </form>
							</div>
                        </div>
                    </div>
                </div>
				<div class="modal fade" id="TambahAtt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Record</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <form method="post" action="<?= base_url();?>report/addabsensi">
					  <div class="modal-body">
						  <div class="form-group">
							<label for="nerw">User</label>
							<select id="inputState" class="form-control" name="uid">
							<?php foreach ($add as $row):?>
								<option value="<?= $row->uid;?>"><?= $row->bnama . " - " . $row->nama ?></option>
							<?php endforeach;?>
							</select>
						  </div>
						  <div class="form-group">
							<label for="nerw">Status</label>
							<select id="inputState" class="form-control" name="inout">
								<option value="0">Masuk</option>
								<option value="1">Keluar</option>
							</select>
						  </div>
						  <div class="form-group">
							<label for="nerw">Time</label>
							<input name="time" type="datetime-local" class="form-control" id="nerw" aria-describedby="emailHelp">
						  </div>
					  </div>
					  <div class="modal-footer">
						<button type="submit" class="btn btn-primary">Save</button>
					  </div>
					  </form>
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