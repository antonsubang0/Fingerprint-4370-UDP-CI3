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
                <div class="col-md-9 col-8">
                    <h4 class="mb-0">Report</h4>
                    <small>Report of Attandance by List Horizontal</small>
                </div>
                <div class="col-md-3 col-4 text-right">
                	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapsExample" aria-expanded="false" aria-controls="collapsExample">
					    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
						  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
						</svg>
					</button>
                </div>
            </div>
            <div class="row mb-3">
            	<div class="col">
            		<div class="collapse" id="collapsExample">
					  <div class="card card-body">
					    <form method="post" action="<?= base_url();?>report/horizontal">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="mt-2 col-12 col-md-2 col-lg-2 cus-label">Dari :</label>
									<div class="mt-2 col-md-4 col-lg-4 mb-3">
										<div class="input-group">
											<input type="text" id="datepicker" class="form-control" placeholder="dd-mm-yyyy" name="awal" value="<?php if(isset($_POST['awal'])){ echo $_POST['awal']; }?>" autocomplete="off">
										</div>
									</div>
									<label class="mt-2 col-12 col-md-2 col-lg-2 cus-label">Sampai :</label>
									<div class="mt-2 col-md-4 col-lg-4 mb-3">
										<div class="input-group">
											<input type="text" id="datepicker1" class="form-control" placeholder="dd-mm-yyyy" name="akhir" value="<?php if(isset($_POST['akhir'])){ echo $_POST['akhir']; }?>" autocomplete="off">
										</div>
									</div>
									<label class="col-12 col-md-2 col-lg-2 cus-label">Devisi :</label>
									<div class="col-md-4 col-lg-4 mb-3">
										<select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="group">
											<?php foreach ($bagian as $a) :?>
												<option value="<?= $a->id; ?>" <?php if(isset($_POST['group']) && $_POST['group']==$a->id){ echo 'selected="selected"'; }?>><?= $a->bnama; ?></option>
											<?php endforeach;?>
										</select>
									</div>
									<label class="col-12 col-md-2 col-lg-2 cus-label">User :</label>
									<div class="col-md-4 col-lg-4 mb-3">
										<select multiple class="form-control" multiple="multiple" name="personal[]">
											<?php foreach ($user as $b) :?>
												<option value="<?= $b->uid; ?>" <?php if(isset($_POST['personal']) && in_array($b->uid, $_POST['personal'])){ echo 'selected="selected"'; }?>><?= $b->nama; ?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="col-8 ml-3 form-group form-check">
										<div class="custom-control custom-radio custom-control-inline idshow1">
											<input type="radio" id="show1" name="download" value="1" class="custom-control-input" checked>
											<label class="custom-control-label" for="show1">Show</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline iddownload">
											<input type="radio" id="download" name="download" value="2" class="custom-control-input">
											<label class="custom-control-label" for="download">Download</label>
										</div>
										<div class="custom-control custom-checkbox custom-control-inline showcount">
										  	<input type="checkbox" class="custom-control-input" id="showcount" name="showcount" value="1">
										  	<label class="custom-control-label" for="showcount">Show Counting on Excel</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="mt-3 mt-lg-0 col-12 ml-2 mb-3">
										<button type="submit" name="show" class="btn btn-primary nav-ajs-cs">Show / Download</button>
									</div>
								</div>
							</div>
						</form>
					  </div>
					</div>
            	</div>	
            </div>
            <div class="row bg-light rounded-lg py-3 mx-1">
                <div class="col overflow-auto" style="height: 50vh;">
                    <table id="2312312" class="align-middle table table-sm table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
								<th rowspan="2">ID</th>
								<th rowspan="2">Name</th>
								<th rowspan="2">Bagian</th>
								<?php for ($x = 0; $x <= 31; $x++): ?>
								<th colspan="3"><?= date('d-m-Y', strtotime('+'.$x.'days', strtotime($stateawal))); ?></th>
								<?php endfor; ?>
							</tr>
							<tr>
								<?php for ($x = 0; $x <= 31; $x++): ?>
								<th>In</th>
								<th>Out</th>
								<th>Count</th>
								<?php endfor; ?>
							</tr>

                        </thead>
                        <tbody>
							<?php 	$i=1;
									$uid='';
									$j=0;
							?>
							<?php if ($tabel==!null): //1?> 
							<?php foreach ($tabel as $row): //2?>
							<?php
								$j=$j+1;
								if($row->inout==1){ //3
									$inout="Keluar";
								} else {
									$inout="Masuk";
								} //3
							?>
								<?php if ($uid != $row->uid): //4?>
									<?php $stateday=$stateawal; ?>
									<?php if($i != 1): //5 ?>
										<td>Total : <?= $total;?> </td></tr>
									<?php endif; //5?>
								<tr>
									<td><?= $i++;?></td>
									<td><?= $row->uid;?></td>
									<td><?= $row->nama;?></td>
									<td><?= $row->bnama;?></td>
									<?php $uid= $row->uid; ?>
									<?php $total=0; ?>
										<?php 	$d= new DateTime($stateawal);
												$e= new DateTime(date("d-m-Y", $row->time));
												$deff = $d->diff($e);
												$selisih = $deff->days;
												$stateday=date('d-m-Y', strtotime('+'.$selisih.'days', strtotime($stateawal)));
												if ($selisih>0) {
												for ($x = 0; $x < $selisih; $x++) {
												  echo "<td></td><td></td><td></td>";
												}
												}
												if ($row->inout==1) { //keluar
													echo "<td></td><td class='text-danger'>". date("d-m-Y H:i:s", $row->time) ."</td><td></td>";
													$log=0;
													$statejam=$row->time;
												} else { //masuk
													echo "<td class='text-success'>". date("d-m-Y H:i:s", $row->time) ."</td>";
													$log=1;
													$jamawal=$row->time;
													$statejam=$row->time;
												}
										?>
									<?php else: ?>
										<?php 	$d= new DateTime($stateday);
												$e= new DateTime(date("d-m-Y", $row->time));
												$deff = $d->diff($e);
												$selisih = $deff->days;
												if ($selisih>1) {
													for ($x = 1; $x < $selisih; $x++) {
												  		echo "<td></td><td></td><td></td>";
													}
													$statejam=$row->time - 3700;
												}

											if ($row->time - $statejam > 3600) {
												if ($row->inout==0) {
													if ($log==1) {
														echo "<td></td><td></td>";
													}
													echo "<td class='text-success'>". date("d-m-Y H:i:s", $row->time) ."</td>";
													
													$jamawal=$row->time;
													$statejam=$row->time;
													$log=1;
													if ($selisih==0) {
														$stateday=date('d-m-Y', strtotime('+ 1 days', strtotime($stateday)));
													} else {
														$stateday=date('d-m-Y', strtotime('+'.$selisih.'days', strtotime($stateday)));
													}

												} elseif($row->inout==1) {
													if ($jamawal==0) {
														echo "<td></td>";
														$jamawal=$row->time;
														$stateday=date('d-m-Y', strtotime('+'.$selisih.'days', strtotime($stateday)));
													}
													echo "<td class='text-danger'>". date("d-m-Y H:i:s", $row->time) ."</td>";
													$jamakhir=$row->time;
													$statejam=$row->time;
													$hitung = ($jamakhir-$jamawal)/(60*60);
													$hitung = round($hitung,1);
													if ($hitung>=7.5){$hitung=$hitung-1;}
													if ($hitung>=10) {$hitung=$hitung-1.5;}
													echo "<td>". $hitung ."</td>";
													$log = 2;
													$total=$total+$hitung;
													$jamakhir=0;
													$jamawal=0;
												} else {
													echo "<td class='text-success'>". date("d-m-Y H:i:s", $row->time) ."</td>";
													$jamawal=$row->time;
													$statejam=$row->time;
													$log=1;
													if ($selisih==0) {
														$stateday=date('d-m-Y', strtotime('+ 1 days', strtotime($stateday)));
													} else {
														$stateday=date('d-m-Y', strtotime('+'.$selisih.'days', strtotime($stateday)));
													}
													
												}	
											}
										?>
								<?php endif; //4?>
							<?php endforeach; //2?>
							<?php if ($j==$countquery){ echo "<td>Total : ". $total ."</td></tr>"; } //1 ?>
							<?php endif; //1 ?>
                        </tbody>
                       <tfoot>
                            <tr>
                                <th rowspan="2">No</th>
								<th rowspan="2">ID</th>
								<th rowspan="2">Name</th>
								<th rowspan="2">Bagian</th>
								<?php for ($x = 0; $x <= 31; $x++): ?>
								<th>In</th>
								<th>Out</th>
								<th>Count</th>
								<?php endfor; ?>
							</tr>
							<tr>
								<?php for ($x = 0; $x <= 31; $x++): ?>
								<th colspan="3"><?= date('d-m-Y', strtotime('+'.$x.'days', strtotime($stateawal))); ?></th>
								<?php endfor; ?>
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