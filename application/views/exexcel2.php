 <?php
 $title=date('d-m-Y');
 $titel1 = $_POST['group'];
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=export-$title-$titel1.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

<p>http://report/horizontal?Anton</p>
<h4><u>Absensi CPI Subang</u></h4>
<table id="zero_config" border="2">
    <thead>
	    <tr>
	        <th rowspan="2" width="30">No</th>
			<th rowspan="2" width="60">ID</th>
			<th rowspan="2">Name</th>
			<th rowspan="2">Position</th>
			<?php for ($x = 0; $x <= 31; $x++): ?>
			<th colspan="<?= ($optcount==1)? 2 : 1 ;?>"><?= date('d-m-Y', strtotime('+'.$x.'days', strtotime($stateawal))); ?></th>
			<?php endfor; ?>
		</tr>
		<tr>
			<?php for ($x = 0; $x <= 31; $x++): ?>
			<th width="90">In-Out</th>
				<?php if ($optcount==1) :?>
			<th width="30">#</th>
				<?php endif; ?>
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
					<?php if ($optcount==1): //6?>
						<td>Total : <?= $total;?> </td></tr>
					<?php endif; //6 ?>
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
									if ($optcount==1) {
							  			echo "<td></td><td></td>";
									} else {
										echo "<td></td>";
									}
								}
							}
							if ($row->inout==1) { //keluar
								echo "<td><span style='color: green;'>.........<span>-<span style='color: red;'>". date("H:i", $row->time) ."<span></td>";
								if ($optcount==1) {
							  		echo "<td></td>";
								} 
								$log=0;
								$statejam=$row->time;
							} else { //masuk
								echo "<td><span style='color: green;'>". date("H:i", $row->time) . "<span>";
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
							  		if ($optcount==1) {
							  			echo "<td></td><td></td>";
									} else {
										echo "<td></td>";
									}
								}
								$statejam=$row->time - 3700;
							}

						if ($row->time - $statejam > 3600) {
							if ($row->inout==0) {//masuk
								if ($log==1) {
									if ($optcount==1) {
										echo "</td><td></td>";
									}
								}
								echo "<td><span style='color: green;'>". date("H:i", $row->time) . "</span>";
								
								$jamawal=$row->time;
								$statejam=$row->time;
								$log=1;
								if ($selisih==0) {
									$stateday=date('d-m-Y', strtotime('+ 1 days', strtotime($stateday)));
								} else {
									$stateday=date('d-m-Y', strtotime('+'.$selisih.'days', strtotime($stateday)));
								}

							} elseif($row->inout==1) {//keluar
								if ($jamawal==0) {
									echo "<td><span style='color: green;'>.........</span>";
									$jamawal=$row->time;
									$stateday=date('d-m-Y', strtotime('+'.$selisih.'days', strtotime($stateday)));
								}
								echo "-<span style='color: red;'>". date("H:i", $row->time) ."</span></td>";
								$jamakhir=$row->time;
								$statejam=$row->time;
								$hitung = ($jamakhir-$jamawal)/(60*60);
								$hitung = round($hitung,1);
								if ($hitung>=7.5){$hitung=$hitung-1;}
								if ($hitung>=10) {$hitung=$hitung-1.5;}
								if ($optcount==1) {
									echo "<td>". $hitung ."</td>";
								}
								$log = 2;
								$total=$total+$hitung;
								$jamakhir=0;
								$jamawal=0;
							} else {
								echo "<td>". date("H:i", $row->time);
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
		<?php if ($j==$countquery){ 
			if ($optcount==1) {
				echo "<td>Total : ". $total ."</td></tr>";
			} } //1 ?>
		<?php endif; //1 ?>
	</tbody>
</table>
