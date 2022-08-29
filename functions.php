<?php 

$months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli","Agustus","September","Oktober","November","Desember"];
$religions = ["Kristen", "Katolik", "Hindu", "Islam", "Konghucu", "Budha"];

// Connect Database
$conn = mysqli_connect("localhost", "root", "", "ppti12");

function query($strQuery){
    global $conn;

    // Ambil hasil select dari query
    $result = mysqli_query($conn, $strQuery);

    // Convert ke array associative
    $students = [];

    while($row = mysqli_fetch_assoc($result)){
        $students[] = $row;
    }

    return $students;
}

function insert($data){
    $nama = htmlspecialchars($data["nama"]);
    $asal = htmlspecialchars($data["asal"]);
    $tanggal = $data["tanggal"];
    $bulan = $data["bulan"];
    $tahun = $data["tahun"];
    $agama = $data["agama"];

    global $conn;
    mysqli_query($conn, "INSERT INTO mahasiswa VALUES
        (NULL, '$nama', '$asal', '$tahun-$bulan-$tanggal', '$agama')
    ");

    return mysqli_affected_rows($conn);
}

function edit($data){
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $asal = htmlspecialchars($data["asal"]);
    $tanggal = $data["tanggal"];
    $bulan = $data["bulan"];
    $tahun = $data["tahun"];
    $agama = $data["agama"];

    $query = "UPDATE mahasiswa SET
        nama = '$nama',
        asal = '$asal',
        DOB = '$tahun-$bulan-$tanggal',
        agama = '$agama'
        WHERE id = $id
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function generateQuery($data){
    $nama = htmlspecialchars($data["nama"]);
    $asal = htmlspecialchars($data["asal"]);
    $tanggal = $data["tanggal"];
    $bulan = $data["bulan"];
    $tahun = $data["tahun"];
    $agama = $data["agama"];

    $finalQuery = "SELECT id, nama, asal, DATE_FORMAT(DOB, '%d %M %Y') as 'DOB', agama FROM mahasiswa WHERE";
    $isNeedAnd = false;
    $isEmptyAll = true;

    if($nama != ""){
        $isEmptyAll = false;
        $finalQuery = $finalQuery." "."nama LIKE '%$nama%'";
        $isNeedAnd = true;
    }
    if($asal != "any"){
        $isEmptyAll = false;
        if($isNeedAnd){
            $finalQuery = $finalQuery." "."AND asal = '$asal'";
        } else{
            $finalQuery = $finalQuery." "."asal = '$asal'";
        }
        $isNeedAnd = true;
    }
    if($tanggal != -1){
        $isEmptyAll = false;
        if($isNeedAnd){
            $finalQuery = $finalQuery." "."AND DAY(DOB) = $tanggal";
        } else{
            $finalQuery = $finalQuery." "."DAY(DOB) = $tanggal";
        }
        $isNeedAnd = true;
    }
    if($bulan != -1){
        $isEmptyAll = false;
        
        if($isNeedAnd){
            $finalQuery = $finalQuery." "."AND MONTH(DOB) = $bulan";
        } else{
            $finalQuery = $finalQuery." "."MONTH(DOB) = $bulan";
        }

        $isNeedAnd = true;
    }
    if($tahun != -1){
        $isEmptyAll = false;
        
        if($isNeedAnd){
            $finalQuery = $finalQuery." "."AND YEAR(DOB) = $tahun";
        } else{
            $finalQuery = $finalQuery." "."YEAR(DOB) = $tahun";
        }

        $isNeedAnd = true;
    }

    if($agama != "any"){
        $isEmptyAll = false;
        
        if($isNeedAnd){
            $finalQuery = $finalQuery." "."AND agama = '$agama'";
        } else{
            $finalQuery = $finalQuery." "."agama = '$agama'";
        }

        $isNeedAnd = true;
    }
    
    if($isEmptyAll){
        $finalQuery = $finalQuery." 1";
    }
    return $finalQuery;
}

function signup($data){
    global $conn;

    $password = $data["password"];
    $username = $data["username"];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $result = mysqli_query($conn, "INSERT INTO users(username, pass) VALUES
        ('$username', '$password')
    ");

    return mysqli_affected_rows($conn);
}

function login($data){
    $username = $data["username"];
    $password = $data["password"];

    $result = query("SELECT * FROM users WHERE username='$username'")[0];

    if(password_verify($password, $result["pass"])){
        return true;
    } else{
        return false;
    }
}

?>