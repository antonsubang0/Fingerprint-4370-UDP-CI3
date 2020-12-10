 <?php
 $title=date('d-m-Y');
 $titel1 = $_POST['group'];
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=export-$title-$titel1.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
<p>http://report/portrait?Anton</p>
<h4><u>Absensi CPI Subang</u></h4>
									<table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>UID</th>
												<th>ID</th>
												<th>Name</th>
												<th>Bagian</th>
												<th>Waktu</th>
												<th>In/Out</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $i=1;?>
											<?php if ($tabel==!null):?>
											<?php foreach ($tabel as $row):?>
											<?php if($row->inout==1){
												$inout = 'Keluar';
											} elseif ($row->inout==0) {
												$inout = 'Masuk';
											} else {
												$inout = 'Mengulang';
											}
											?>
												<tr>
													<td><?= $i++;?></td>
													<td><?= $row->uid;?></td>
													<td><?= $row->nama;?></td>
													<td><?= $row->bnama;?></td>
													<td style="color : <?= ($inout=='Keluar')? 'red;' : 'green;' ; ?>"><?= date("d-m-Y H:i:s", $row->time); ?></td>
													<td style="color : <?= ($inout=='Keluar')? 'red;' : 'green;' ; ?>"><?= $inout;?></td>
												</tr>
											<?php endforeach;?>
											<?php endif; ?>
                                        </tbody>
                                    </table>