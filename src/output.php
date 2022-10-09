<?php
if ($_POST != NULL) {
    $save_supply = $_POST['save_supply']; //yang di hidden = jumlah kolom
    $save_demand = $_POST['save_demand']; //yang di hidden = jumlah baris
    $get_supply = $_POST['supply'];
    $get_demand = $_POST['demand'];
    $supply = $_POST['supply'];
    $demand = $_POST['demand'];
    $cost = $_POST['cost'];

    $total_perhitungan = 0; //total perhitungan
    
    $arr = []; 
    $flag = [];
    $s_cost = [];
    $d_cost = [];
    $flag_s_cost = [];
    $flag_d_cost = [];

    $count = 0;
    $total_supply = 0;
    $total_demand = 0;

    $keep_column = 0; //kolom tersimpan
    $keep_row = 0; //baris tersimpan

    $num = -1;
}

// menjumlahkan nilai demand
for ($i = 1; $i <= $save_demand; $i++) {
    $total_demand += $get_demand[$i];
}
$total_demand_copy = $total_demand;
// echo "total_demand = ". $total_demand . " ";

// menjumlahkan nilai supply
for ($i = 1; $i <= $save_supply; $i++) {
    $total_supply += $get_supply[$i];
}
// echo "total_supply = ". $total_supply . " ";
$total_supply_copy = $total_supply;

// Flag untuk menandai cost apakah sudah dihitung atau belum, flag pengaruh di supply dan demand jika != 0
for ($i = 1; $i <= $save_supply; $i++) {
    for ($j = 1; $j <= $save_demand; $j++) {
        $arr[$i][$j] = 0;
        $flag[$i][$j] = 0;
    }
}

$count = 4;
//melakukan iterasi untuk menentukan cost
do {
    $cost_max = -1;
    $cost_min = 10000000;

    for ($i = 1; $i <= $save_demand; $i++) {
        $sort = [];
        for ($j = 1; $j <= $save_supply; $j++) {
            if ($flag[$j][$i] == 0) {
                // push data dari array cost ke array sort
                array_push($sort, $cost[$j][$i]);
            }
        }
        // mengurutkan isi array dari terkecil ke terbesar
        sort($sort);
        // kondisi untuk biaya demand
        switch (true) {
            // jika panjang array sort > 1
            case count($sort) > 1:
            $d_cost[$i] = $sort[1] - $sort[0];
            break;

            // jika panjang array sort == 1
            case count($sort) == 1:
            $d_cost[$i] = $sort[0];
            break;

            default:
            $d_cost[$i] = null;
            break;
        }

        // jika -1 < $d_cost[$i]
        if ($cost_max < $d_cost[$i]) {
            $cost_max = $d_cost[$i];
            $keep_column = 1;
            $keep_row = 0;
            $num = $i;
        }
    }

    for ($i = 1; $i <= $save_supply; $i++) {
        $sort = [];
        for ($j = 1; $j <= $save_demand; $j++) {
            if ($flag[$i][$j] == 0) {
                // push data dari array cost ke array sort
                array_push($sort, $cost[$i][$j]);
            }
        }
        // mengurutkan isi array dari terkecil ke terbesar
        sort($sort);

        // untuk biaya supply
        switch (true) {
            // jika panjang array sort > 1
            case count($sort) > 1:
            $s_cost[$i] = $sort[1] - $sort[0];
            break;

            // jika panjang array sort == 1
            case count($sort) == 1:
            $s_cost[$i] = $sort[0];
            break;
            
            default:
            $s_cost[$i] = null;
            break;
        }

        if ($cost_max < $s_cost[$i]) {
            $cost_max = $s_cost[$i];
            $keep_column = 0;
            $keep_row = 1;
            $num = $i;
        }
    }

    $i_min = 0;
    $j_min = 0;

    if ($keep_row == 1) {
        for ($i = 1; $i <= $save_demand; $i++) {
            if ($cost_min >= $cost[$num][$i] && $flag[$num][$i] != 1) {
                $cost_min = $cost[$num][$i];
                $i_min = $num;
                $j_min = $i;
            }
        }
    }

    if ($keep_column == 1) {
        for ($i = 1; $i <= $save_supply; $i++) {
            if ($cost_min >= $cost[$i][$num] && $flag[$i][$num] != 1) {
                $cost_min = $cost[$i][$num];
                $i_min = $i;
                $j_min = $num;
            }
        }
    }

    switch (true) {
        // Jika supply kurang dari demand maka demand dikurangi oleh supply dan di array diset isi supply
        case $supply[$i_min] < $demand[$j_min] :
        $arr[$i_min][$j_min] = $supply[$i_min];
        $flag[$i_min][$j_min] = 1;
        $demand[$j_min] -= $arr[$i_min][$j_min];
        $supply[$i_min] -= $arr[$i_min][$j_min];
        $total_demand -= $arr[$i_min][$j_min];

        for ($i = 1; $i <= $save_supply; $i++) {
            $flag[$i_min][$i] = 1;
        }
        break;

        // Jika supply lebih besar daripada demand, maka supply dikurangi demand dan di array diset isi demand
        case $supply[$i_min] > $demand[$j_min] :
        $arr[$i_min][$j_min] = $demand[$j_min];
        $demand[$j_min] -= $arr[$i_min][$j_min];
        $supply[$i_min] -= $arr[$i_min][$j_min];
        $total_demand -= $arr[$i_min][$j_min];

        for ($i = 1; $i <= $save_demand; $i++) {
            $flag[$i][$j_min] = 1;
        } //end for
        break;

        // Jika demand dan supply pada kolom tersebut sama, maka diset 0 untuk demand dan supplynya dan di array diset isi dari supply
        default:
        $arr[$i_min][$j_min] = $supply[$i_min];
        $supply[$i_min] = 0;
        $demand[$j_min] = 0;

        for ($i = 1; $i <= $save_demand; $i++) {
            $flag[$i][$j_min] = 1;
        } //end for

        for ($i = 1; $i <= $save_supply; $i++) {
            $flag[$i_min][$i] = 1;
        } //end for

        $total_demand -= $arr[$i_min][$j_min];
        break;
    }
    $count--;
} while ($total_demand > 0);

if ($total_demand == NULL && $total_supply == NULL) {
    include "./template/header.php";
    echo "
    <script>
        alert('Data tidak boleh kosong!!!');
        location.href = 'index.php';
    </script>";
} else {
    include "./template/header.php";
    include "./content/tableOutput.php";
    include "./template/footer.php";
}
?>

