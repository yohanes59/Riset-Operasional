<div class="container-fluid d-flex justify-content-center py-5">
	<div>
		<form action="output.php" method="post">
			<table class="table table-bordered">
				<tr>
					<td class="text-center align-middle">Supply/Demand</td>
					<!-- nomor kebutuhan 1 s/d n -->
					<?php for ($i = 1; $i <= $demand; $i++) : ?>
						<td class="text-center align-middle">D<?= $i ?></td>
					<?php endfor; ?>
					<td class="text-center">Supply Needed</td>
				</tr>

				<?php for ($i = 1; $i <= $supply; $i++) : ?>
					<tr>
						<!-- nomor kapasitas 1 s/d n -->
						<td class="text-center align-middle">S<?= $i ?></td>

						<!-- field untuk input biaya -->
						<?php for ($j = 1; $j <= $demand; $j++) : ?>
							<td>
								<div class="form-group" style="max-width: 50px;">
									<!-- membuat array 2 dimensi -->
									<input type="text" class="form-control" name="cost[<?= $i ?>][<?= $j ?>]">
								</div>
							</td>
						<?php endfor; ?>

						<td>
							<div class="form-group" style="max-width: 50px;">
								<!-- field untuk input nilai kapasitas yang dibutuhkan -->
								<!-- membuat array 1 dimensi -->
								<input type="text" class="form-control" name="supply[<?= $i ?>]">
							</div>
						</td>
					</tr>
				<?php endfor; ?>

				<tr>
					<td class="text-center align-middle">Demand Requested</td>
					<!-- field untuk input nilai kebutuhan yang dibutuhkan -->
					<?php for ($i = 1; $i <= $demand; $i++) : ?>
						<td>
							<div class="form-group" style="max-width: 50px;">
								<!-- membuat array 1 dimensi -->
								<input type="text" class="form-control" name="demand[<?= $i ?>]">
							</div>
						</td>
					<?php endfor; ?>
					<td></td>
				</tr>

				<div class="form-group" style="max-width: 50px;" hidden>
					<!-- menyimpan nilai demand ke variabel s_demand-->
					<input type="text" class="form-control" name="save_demand" value="<?= $demand ?>">
				</div>
				<div class="form-group" style="max-width: 50px;" hidden>
					<!-- menyimpan nilai supply ke variabel s_supply-->
					<input type="text" class="form-control" name="save_supply" value="<?= $supply ?>">
				</div>
			</table>
			<button class="btn btn-info btn-md" type="submit" style="float: right;">Submit</button>
		</form>
	</div>
</div>