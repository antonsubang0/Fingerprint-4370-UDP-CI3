
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
										<h5 class="card-title mt-2">Data Absen <?= $mesin; ?></h5>
									</div>
									<div class="col-12 col-lg-6 text-lg-right">
										<a href="<?= base_url();?>home/downloadabsen/<?= $idmesin; ?>" class="btn btn-primary">Download and Clear Absen</a>
									</div>
								</div>
								<?php if($this->session->flashdata('status')): ?>
										<div class="text-center alert alert-success" role="alert">
								<?= $this->session->flashdata('status'); ?>
								</div>
								<?php endif;?>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
												<th>ID</th>
												<th>Name</th>
												<th>Bagian</th>
												<th>In/Out</th>
												<th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										while(list($uid, $userdata) = each($user)):
										?>
										<tr>
											<td><?php echo $uid ?></td>
											<td><?php echo $userdata[0] ?></td>
											<?php if ($base[$userdata[0]]['nama']==NULL): ?>
											<td>Unknown</td>
											<?php else: ?>
											<td><?= $nama = $base[$userdata[0]]['nama'] ?></td>
											<?php endif; ?>
											<?php if ($bagian[$base[$userdata[0]]['bagian']]==NULL): ?>
											<td>Unknown</td>
											<?php else: ?>
											<td><?= $bagian[$base[$userdata[0]]['bagian']] ?></td>
											<?php endif; ?>
											<td><?php if ($userdata[4]==0) { echo "<div class='text-success'>Masuk</div>"; } else { echo "<div class='text-danger'>Keluar</div>";} ?></td>
											<td><?php echo date_format(date_create($userdata[3]),"d-m-Y H:i:s"); ?>&nbsp;</td>
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