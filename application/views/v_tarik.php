        <div class="col-md-9 col-10 pt-2 px-2 bg-light">
            <div class="card shadow-sm py-3">
                <div class="card-body overflow-auto pt-1 pb-0" style="height: 69vh;">
                    <div class="row mb-3 position-relative">
                    	<div class="col-12 position-absolute d-flex justify-content-center">
                    	<?php if($this->session->flashdata('status')): ?>
                            <div class="alert alert-success homenotif-cs notif-time shadow-sm" role="alert">
							<?= $this->session->flashdata('status'); ?>
							</div>
						<?php endif; ?>
						<?php if($this->session->flashdata('statusgagal')): ?>
                            <div class="alert alert-danger homenotif-cs notif-time shadow-sm" role="alert">
							<?= $this->session->flashdata('statusgagal'); ?>
							</div>
						<?php endif; ?>
						</div>
                        <div class="col-md-10 col-9">
                            <h4 class="mb-0">Download</h4>
                            <small>Download Attandance from Machines</small>
                        </div>
                    </div>
                    <div class="row bg-light rounded-lg py-3 mx-1">
                        <div class="col overflow-auto" style="height: 50vh;">
                            <table id="tabel1" class="table table-sm table-striped align-middle table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Machines</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$i=1;
									
									foreach ($daftarmesin as $row) :
									?>
									<tr>
										<td class="pt-3"><?= $i++ ?></td>
										<td class="pt-3"><?= $row->namamesin; ?></td>
                                        <td class="pt-3"><?= ($statusMachine[$row->ipmesin]>0) ? "Disconnected" : "Connected"; ?></td>
										<td><a class="btn btn-primary nav-ajs-cs <?= ($statusMachine[$row->ipmesin]>0) ? "disabled" : " "; ?>" href="<?= base_url("home/downloadabsen/")?><?= $row->id;?>">Download Data</a></td>
									</tr>
									<?php endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Machines</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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