
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
								<?php if($this->session->flashdata('status')): ?>
								<div class="text-center alert alert-success" role="alert">
									<?= $this->session->flashdata('status'); ?>
								</div>
								<?php endif; ?>
								<?php if($this->session->flashdata('statusgagal')): ?>
								<div class="text-center alert alert-danger" role="alert">
									<?= $this->session->flashdata('statusgagal'); ?>
								</div>
								<?php endif; ?>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>Machine</th>
                                                <th>Status</th>
												<td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										<?php
										$i=1;
										
										foreach ($daftarmesin as $row) :
										?>
										<tr>
											<td><?= $i++ ?></td>
											<td><?= $row->namamesin; ?></td>
                                            <td><?= ($statusMachine[$row->ipmesin]>0) ? "Disconnected" : "Connected"; ?></td>
											<td><a class="btn btn-primary mb-1 <?= ($statusMachine[$row->ipmesin]>0) ? "disabled" : " "; ?>" href="<?= base_url("home/downloadabsen/")?><?= $row->id;?>">Tarik Data</a></td>
										</tr>
										<?php endforeach;?>
                                        </tbody>
										<tfoot>
										</tfoot>
                                    </table>
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
