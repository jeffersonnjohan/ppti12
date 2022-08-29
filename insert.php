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
    <link rel="stylesheet" href="addStudent.css">
</head>
<body>

    <div class="form-container">
        <div class="login-account">
            <center>Add New Student</center> 
        </div>
    
        <div class="container-form">
            <div class="search-menu">
                <form action="" method="post">
                    <div class="menu-options">
                        <div class="options-nama">
                            <label for="nama" class="nama">Nama: </label>
                            <div class="s-input">
                                <input type="text" name="nama" id="nama" class="input" placeholder="Input Your Name">
                            </div>
                        </div>
                            
                        <div class="options-nama-">
                            <label for="asal" class="nama">Asal: </label>
                            <div class="s-input">
                                <input type="text" name="asal" id="asal" class="input" placeholder="Input Your Origin">
                            </div>
                        </div>
                        
                        <div class="options-nama-">
                            <label for="tanggal">DOB</label>
                            <div class="s-input">
                                <select name="tanggal" id="tanggal" class="input-dob">
                                    <option value="-1">Day</option>
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
                                <select name="bulan" id="bulan" class="input-dob">
                                    <option value="-1">Month</option>
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
                                
                                <select name="tahun" id="tahun" class="input-dob">
                                    <option value="-1">Year</option>
                                <?php for($yearCounter = 1980; $yearCounter <= 2022; $yearCounter++): ?>
                                    <option value="<?php echo $yearCounter;?>">
                                        <?php echo $yearCounter; ?>
                                    </option>
                                <?php endfor; ?>
                                </select>
                
                            </div>
                        </div>
                            
                        <div class="options-nama-">
                            <label for="agama" class="nama">Agama</label>
                            <div class="s-input">
                                <select name="agama" id="agama" class="input-religion">
                                    <option value="any">Choose Religion</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Budha">Budha</option>
                                </select>
                            </div>
                        </div>
                
                        <div class="menu-submit">
                            <button type="reset" class="input-reset"><center>Reset</center></button>
                            <button type="submit" name="submit" value="submit" class="input-search"><center>Submit</center></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>