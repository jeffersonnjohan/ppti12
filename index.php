<?php 
    require 'functions.php';
    
    session_start();
    if(isset($_COOKIE['login'])){
        $_SESSION["login"] = true;
        $_SESSION["username"] = $_COOKIE["username"];
    }
    
    if(!isset($_SESSION["login"])){
        // Kalau belum login
        header("Location: login.php");
    }
    $username = $_SESSION["username"];
    
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
    <link rel="stylesheet" href="main.css">
    <title>PPTI 12</title>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="nav-wrapper">
                <h1 class="web-title">BLI Students</h1>

                <div class="menu-wrapper">
                    <ul class="menu">
                        <li class="menu-item"><a href="#" class="menu-link active">Home</a></li>
                        <li class="menu-item"><a href="#" class="menu-link">About Us</a></li>
                        <li class="menu-item"><a href="#" class="menu-link">Feedback</a></li>
                        <li class="menu-item"><a href="logout.php" class="menu-link">Logout</a></li>
                    </ul>

                    <div class="profile-info">
                        <img src="pics/3 profile pic.png" alt="">
                        <a href="#" class="profile-name"><?php echo $username;?></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Search -->
    <form action="" method="post" style="display:none;">
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

    <section class="ppti-database">
        <!-- Heading Section: PPTI Database & Search Bar -->
        <div class="heading">
            <h1 class="title">PPTI Database</h1>
            <div class="search-bar">
                <img src="pics/1 search bar.png" alt="" class="img1">
                <input type="text" class="search-input" placeholder="Search for students">
                <div class="button">
                    <button class="button-img2"> <img src="pics/2 option bar svg.svg" alt=""> </button>
                </div>

            </div>
        </div>

        <div class="menu">
            <a href="insert.php" class="add-student">
                <img src="pics/4 add student svg.svg" alt="">
                <div class="text">Add Student</div>
            </a>

            <a href="#" class="edit-student" id="edit-student">
                <img src="pics/5 edit student svg.svg" alt="">
                <div class="text">Edit Student</div>
            </a>
        </div>

        <!-- Content -->
        <div class="table">
            <table class="content-table">
                <div class="heading-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="editDisplay displayNone">Aksi</th>
                            <th>Nama</th>
                            <th>Asal</th>
                            <th>DOB</th>
                            <th>Agama</th>
                        </tr>
                    </thead>
                </div>
    
                <tbody>
                    <?php $counter = 1 ?>
                    <?php foreach($students as $student): ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td class="editDisplay displayNone">
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
                </tbody>
            </table>
        </div>
    
        <div class="free-section"></div>
    </section>

    <div class="search-menu displayNone" id="search-menu">
        <form action="" method="post">
            <div class="menu-options">

                <div class="options-nama">
                    <label for="nama" class="nama">Nama</label>
                    <div class="s-input">
                        <input type="text" name="nama" id="nama" class="input" placeholder="Input your name here">
                    </div>
                </div>

                <div class="options-nama-">
                    <label for="asal" class="nama">Asal</label>
                    <div class="s-input">
                        <select name="asal" id="asal" class="input">
                            <option value="any" class="any">Choose your origin</option>
                            <?php foreach($cities as $city): ?>
                                <option value="<?php echo $city["asal"];?>">
                                    <?php echo $city["asal"]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="options-nama-">
                    <label for="tanggal" class="nama">DOB</label>
                    <div class="s-input">

                        
                        <select name="tanggal" id="tanggal" class="input-dob">
                            <option value="-1" class="any">Day</option>
                            <?php for($i = 1; $i <= 31; $i++): ?>
                                <option value="<?php printf("%02d", $i)?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>

                        <select name="bulan" id="bulan" class="input-dob">
                            <option value="-1" class="any">Month</option>
                            <?php $i = 1; foreach($months as $month): ?>
                                <option value="<?php printf("%02d", $i++)?>">
                                    <?php echo $month; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        
                        <select name="tahun" id="tahun" class="input-dob">
                            <option value="-1" class="any">Year</option>
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
                            <option value="any" class="any">Choose religion</option>
                            <?php foreach($religions as $religion): ?>
                                <option value="<?php echo $religion; ?>"><?php echo $religion; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            
                <div class="menu-submit">
                    <button type="reset" class="input-reset"> <center>Reset</center> </button>
                    <button type="submit" name="submit" value="submit" class="input-search"> <center>Search</center> </button>  
                </div>
            </div>
        </form>
    </div>

    <script src="scriptIndex.js"></script>
</body>
</html>