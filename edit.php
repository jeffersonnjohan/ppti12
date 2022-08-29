<?php 
    
    require 'functions.php';
    
    $id = $_GET["id"];
    $queryString = "SELECT
        nama,
        asal,
        DAY(DOB) as 'tanggal',
        MONTH(DOB) as 'bulan',
        YEAR(DOB) as 'tahun',
        agama
        FROM mahasiswa WHERE id = $id";

    $student = query($queryString)[0];

    if(isset($_POST["submit"])){
        $rowAffected = edit($_POST);

        if($rowAffected > 0){
            echo "
                <script>
                    alert('data berhasil diedit')
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diedit')
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
    <title>Edit Page</title>
</head>
<body>
    <h1>Silakan Ubah Data Mahasiswa Berikut</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label for="nama">Nama: </label>
        <br>
        <input type="text" name="nama" id="nama" placeholder="silakan masukkan nama" value="<?php echo $student["nama"];?>">
        <br><br>
        
        <label for="asal">Asal: </label>
        <br>
        <input type="text" name="asal" id="asal" placeholder="silakan masukkan asal" value="<?php echo $student["asal"];?>">
        <br><br>
        
        <label for="tanggal"">Tanggal Lahir: </label>
        <br>
        Hari
        <select name="tanggal" id="tanggal">
            <?php for($i = 1; $i <= 31; $i++): ?>
                <?php if($i != $student["tanggal"]): ?>
                    <option value="<?php printf("%02d", $i)?>"><?php echo $i; ?></option>
                <?php else: ?>
                    <option value="<?php printf("%02d", $i)?>" selected><?php echo $i; ?></option>
                <?php endif;?>
            <?php endfor; ?>
        </select>
        Bulan
        <select name="bulan" id="bulan">
            <?php $i = 1; foreach($months as $month): ?>
                <?php if($i != $student["bulan"]): ?>
                    <option value="<?php printf("%02d", $i++)?>">
                <?php else: ?>
                    <option value="<?php printf("%02d", $i++)?>" selected>
                <?php endif; ?>

                    <?php echo $month; ?>
                    </option>
            <?php endforeach; ?>
        </select>
        
        Tahun
        <select name="tahun" id="tahun">
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
        <button type="submit" name="submit" value="submit">Submit</button>
    </form>
</body>
</html>