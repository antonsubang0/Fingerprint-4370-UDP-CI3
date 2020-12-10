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
								<form method="post" action="<?= base_url();?>report/horizontal">
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
											<div class="col-md-6 col-lg-3 mt-3 mt-lg-0 col-6 ml-2 mb-3">
												<button type="submit" name="show" class="btn btn-primary">Show / Download</button>
											</div>
										</div>
									</div>
								</form>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
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
																	echo "<td></td><td>". date("d-m-Y H:i:s", $row->time) ."</td><td></td>";
																	$log=0;
																} else { //masuk
																	echo "<td>". date("d-m-Y H:i:s", $row->time) ."</td>";
																	$log=1;
																	$jamawal=$row->time;
																}
														?>
													<?php else: ?>
														<?php 	$d= new DateTime($stateday);
																$e= new DateTime(date("d-m-Y", $row->time));
																$deff = $d->diff($e);
																$selisih = $deff->days;
																$stateday=date('d-m-Y', strtotime('+'.$selisih.'days', strtotime($stateday)));
																if ($selisih>1) {
																for ($x = 1; $x < $selisih; $x++) {
																  echo "<td></td><td></td><td></td>";
																	}
																}
																if ($log==0) {
																	echo "<td>". date("d-m-Y H:i:s", $row->time) ."</td>";
																	$jamawal=$row->time;
																	$log=1;
																} elseif($log==1) {
																	echo "<td>". date("d-m-Y H:i:s", $row->time) ."</td>";
																	$jamakhir=$row->time;
																	$hitung = ($jamakhir-$jamawal)/(60*60);
																	$hitung = round($hitung,1);
																	if ($hitung>=8){$hitung=$hitung-1;}
																	if ($hitung>=10) {$hitung=$hitung-1.5;}
																	echo "<td>". $hitung ."</td>";
																	$log=2;
																	$total=$total+$hitung;
																} else {
																	echo "<td>". date("d-m-Y H:i:s", $row->time) ."</td>";
																	$jamawal=$row->time;
																	$log=1;
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