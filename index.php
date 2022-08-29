<?php 
    require 'functions.php';
    
    session_start();
    if(isset($_COOKIE['login'])){
        $_SESSION["login"] = true;
    }

    if(!isset($_SESSION["login"])){
        // Kalau belum login
        header("Location: login.php");
    }

    $students = query("SELECT id, nama, asal, DATE_FORMAT(DOB, '%d %M %Y') as 'DOB', agama FROM mahasiswa");
    $cities = query("SELECT DISTINCT asal from mahasiswa");

    if(isset($_POST["submit"])){
        $stringQuery = generateQuery($_POST);
        $students = query($stringQuery);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPTI 12</title>
</head>
<body>
    <a href="logout.php">Logout</a>

    <h1>Daftar Nama PPTI 12</h1>

    <a href="insert.php">Tambah Mahasiswa Baru</a>
    <br><br><br>

    <!-- Search -->
    <h2>Search:</h2>
    <form action="" method="post">
        <label for="nama">Nama: </label>
        <br>
        <input type="text" name="nama" id="nama" placeholder="silakan masukkan nama"">
        <br><br>
        
        <label for="asal">Asal: </label>
        <br>
        <select name="asal" id="asal">
            <option value="any">Any</option>
            <?php foreach($cities as $city): ?>
                <option value="<?php echo $city["asal"];?>">
                    <?php echo $city["asal"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        
        <label for="tanggal"">Tanggal Lahir: </label>
        <br>
        Hari
        <select name="tanggal" id="tanggal">
            <option value="-1">Any</option>
            <?php for($i = 1; $i <= 31; $i++): ?>
                <option value="<?php printf("%02d", $i)?>"><?php echo $i; ?></option>
                <?php endfor; ?>
        </select>
            Bulan
        <select name="bulan" id="bulan">
            <option value="-1">Any</option>
            <?php $i = 1; foreach($months as $month): ?>
                <option value="<?php printf("%02d", $i++)?>">
                    
                    <?php echo $month; ?>
                </option>
                <?php endforeach; ?>
        </select>
        
        Tahun
        <select name="tahun" id="tahun">
            <option value="-1">Any</option>
        <?php for($yearCounter = 1980; $yearCounter <= 2022; $yearCounter++): ?>
            <?php if ($yearCounter != $student["tahun"]): ?>
            <option value="<?php echo $yearCounter;?>">
            <?php else: ?>
            <option value="<?php echo $yearCounter;?>" selected>
            <?php endif; ?>
            
            <?php echo $yearCounter; ?>
            </option>
        <?php endfor; ?>
        </select>
        <br><br>
        
        
        
        <label for="agama">Agama: </label>
        <br>
        <select name="agama" id="agama">
            <option value="any">Any</option>
            <?php foreach($religions as $religion): ?>
                <?php if($religion != $student["agama"]): ?>
                    <option value="<?php echo $religion; ?>"><?php echo $religion; ?></option>
                <?php else: ?>
                    <option value="<?php echo $religion; ?>" selected><?php echo $religion; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="reset">Reset</button>
        <button type="submit" name="submit" value="submit">Search</button>
    </form>

    <!-- Content -->
    <br><br>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Asal</th>
            <th>DOB</th>
            <th>Agama</th>
        </tr>
        <?php $counter = 1 ?>
        <?php foreach($students as $student): ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $student["id"]?>">edit</a>
                <a href="delete.php?id=<?php echo $student["id"]?>">delete</a>
            </td>
            <td>
                <?php echo $student["nama"] ?>
            </td>
            <td>
            <?php echo $student["asal"] ?>
            </td>
            <td>
                <?php echo $student["DOB"] ?>
            </td>
            <td>
                <?php echo $student["agama"] ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>