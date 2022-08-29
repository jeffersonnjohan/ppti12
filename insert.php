<?php 
    
    require 'functions.php';
    session_start();
    if(!isset($_SESSION["login"])){
        // Kalau belum login
        header("Location: login.php");
    }
    
    if(isset($_POST["submit"])){
        $rowAffected = insert($_POST);

        if($rowAffected > 0){
            echo "
                <script>
                    alert('data berhasil disubmit')
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal disubmit')
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Page</title>
</head>
<body>
    <h1>Silakan Masukkan Data Mahasiswa Baru</h1>
    <form action="" method="post">
            <label for="nama">Nama: </label>
            <br>
            <input type="text" name="nama" id="nama" placeholder="silakan masukkan nama">
            <br><br>
            
            <label for="asal">Asal: </label>
            <br>
            <input type="text" name="asal" id="asal" placeholder="silakan masukkan asal">
            <br><br>
            
            <label for="tanggal">Tanggal Lahir: </label>
            <br>
            Hari
            <select name="tanggal" id="tanggal">
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            Bulan
            <select name="bulan" id="bulan">
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            
            Tahun
            <select name="tahun" id="tahun">
            <?php for($yearCounter = 1980; $yearCounter <= 2022; $yearCounter++): ?>
                <option value="<?php echo $yearCounter;?>">
                    <?php echo $yearCounter; ?>
                </option>
            <?php endfor; ?>
            </select>
            <br><br>
            
            
            
            <label for="agama">Agama: </label>
            <br>
            <select name="agama" id="agama">
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Islam">Islam</option>
                <option value="Konghucu">Konghucu</option>
                <option value="Budha">Budha</option>
            </select>
            <br><br>

            <button type="reset">Reset</button>
            <button type="submit" name="submit" value="submit">Submit</button>
    </form>
</body>
</html>