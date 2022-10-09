<div class="container d-flex justify-content-center py-5">
    <div class="col-sm-10 col-md-8 col-lg-6">
        <table class='table table-bordered'>
            <h2 class="mb-5 text-center">Tabel Optimalisasi</h2>
            <tr>
                <td class="text-center">S / D</td>
                <?php for ($i = 1; $i <= $save_demand; $i++) : ?>
                    <!-- cetak nomor kebutuhan 1 s/d n -->
                    <td class="text-center">D<?= $i; ?></td>
                <?php endfor; ?>

                <td>Total Supply</td>
            </tr>

            <?php for ($i = 1; $i <= $save_supply; $i++) : ?>
                <tr>
                    <!-- cetak nomor kapasitas 1 s/d n -->
                    <td class="text-center align-middle">S<?= $i; ?></td>

                    <?php for ($j = 1; $j <= $save_demand; $j++) : ?>
                        <!-- jika nilai biaya yang sudah dihitung > 0 -->
                        <?php if ($arr[$i][$j] > 0) : ?>
                            <td>
                                <table>
                                    <td rowspan='1' width='50' class="border-0 pt-4">
                                        <!-- nilai biaya yang sudah dihitung-->
                                        <?= $arr[$i][$j]; ?>
                                    </td>
                                    <div>
                                        <td class="border-0 p-0">
                                            <div class="border-left border-bottom px-1 py-1">
                                                <!-- nilai biaya yang di input-->
                                                <?= $cost[$i][$j]; ?>
                                            </div>
                                        </td>
                                    </div>
                                </table>
                            </td>
                        <?php else : ?>
                            <td>
                                <table>
                                    <td rowspan='1' width='50' class="border-0">0</td>
                                    <td class="border-0 py-1">
                                        <div class="border-left border-bottom px-2 py-2">
                                            <!-- nilai biaya yang di input-->
                                            <?= $cost[$i][$j]; ?>
                                        </div>
                                    </td>
                                </table>
                            </td>
                        <?php endif; ?>

                        <?php if ($j == $save_demand) : ?>
                            <!-- menampilkan data supply -->
                            <td class="text-center align-middle"><?= $get_supply[$i]; ?></td>
                        <?php endif; ?>

                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>

            <tr>
                <td>Total Demand</td>
                <?php for ($i = 1; $i <= $save_demand; $i++) : ?>
                    <!-- menampilkan data demand -->
                    <td class="text-center"><?= $get_demand[$i]; ?></td>
                <?php endfor; ?>
                <td class="text-center align-middle"><?= $total_demand_copy - $total_supply_copy; ?></td>

            </tr>
        </table>
        <table>
            <legend class="text-center">Hasil Optimalisasi</legend>
            <div class="text-center">

                <?php for ($i = 1; $i <= $save_supply; $i++) : ?>
                    <?php for ($j = 1; $j <= $save_demand; $j++) : ?>
                        <?php if ($arr[$i][$j] > 0 && $cost[$i][$j] > 0) : ?>
                            <!-- membuat perincian perhitungan untuk mencari total perhitungan -->
                            <!-- keterangan baris dan kolom yang dihitung -->
                            Supply <?= $i ?> x Demand <?= $j ?> =&nbsp;
                            <!-- keterangan nilai yang dihitung -->
                            <?= $cost[$i][$j] ?> &nbsp;x&nbsp; <?= $arr[$i][$j] ?> &nbsp;=&nbsp; 
                            <!-- keterangan jumlah hasil perhitungan -->
                            <?= $cost[$i][$j] * $arr[$i][$j] ?> &nbsp;
                            <br/>
                        <!-- <?php else : ?>
                            <?php continue; ?> -->
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php endfor; ?>

                <!-- kalkulasi total perhitungan untuk biaya yang diperlukan -->
                <?php for ($i = 1; $i <= $save_supply; $i++) : ?>
                    <?php for ($j = 1; $j <= $save_demand; $j++) : ?>
                        <?php $total_perhitungan += ($cost[$i][$j] * $arr[$i][$j]); ?>
                    <?php endfor; ?>
                <?php endfor; ?>
                <br/>
                <?= "Jadi Biaya Optimal yang dibutuhkan adalah :&nbsp;" . number_format($total_perhitungan); ?>
                <br/><br/>

                <a href='index.php'>Kembali ke awal</a>
            </div>
        </table>
    </div>
</div>