<?php
define("DEVELOPMENT", TRUE);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function dbConnect() {
    $db = new mysqli("localhost", "root", "", "raport");
    if ($db->connect_errno) {
        die("Connection failed: " . $db->connect_error);
    }
    return $db;
}

function bisa($con, $query) {
    $db = mysqli_query($con, $query);
    return $db ? 1 : 0;
}

function getListPelajaran() {
    $conn = dbConnect();
    if ($conn->connect_errno == 0) {
        $res = $conn->query("SELECT * FROM mata_pelajaran ORDER BY kd_mp");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function getList($query) {
    $conn = dbConnect();
    if ($conn->connect_errno == 0) {
        $res = $conn->query($query);
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function getListSiswa() {
    $conn = dbConnect();
    if ($conn->connect_errno == 0) {
        $res = $conn->query("SELECT * FROM siswa ORDER BY nis");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function getNilaiSiswa($nis) {
    $db = dbConnect();
    if ($db) {
        $nis = $db->escape_string($nis);
        // Ensure the query fetches the required fields including `nama_mp`
        $query = "
            SELECT 
                mp.nama_mp AS nama_mp, 
                n.nilai_tp1, n.nilai_tp2, n.nilai_tp3, n.nilai_tp4, n.nilai_tp5, n.nilai_tp6, n.nilai_tp7, n.rata_tp, 
                n.nilai_uh1, n.nilai_uh2, n.nilai_uh3, n.nilai_uh4, n.nilai_uh5, n.nilai_uh6, n.nilai_uh7, n.rata_uh, 
                n.nilai_pts, n.nilai_uas, n.nilai_akhir, n.nilai_huruf, n.deskripsi 
            FROM nilai n
            JOIN mata_pelajaran mp ON n.kd_mp = mp.kd_mp
            WHERE n.nis='$nis'
        ";
        $result = $db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Query Error: " . $db->error . "<br>";
            return false;
        }
    }
    return false;
}

function getWaliKelas($id_kelas) {
    $db = dbConnect();
    if ($db) {
        $id_kelas = $db->escape_string($id_kelas);
        $query = "SELECT g.nama_guru AS wali_kelas 
                  FROM kelas k 
                  JOIN guru g ON k.wali_kelas = g.nip 
                  WHERE k.id_kelas='$id_kelas'";
        $result = $db->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['wali_kelas'];
        } else {
            echo "Query Error: " . $db->error . "<br>";
            return false;
        }
    }
    return false;
}

 


function getWaliKelasDetails($id_kelas) {
    $db = dbConnect();
    if ($db) {
        $id_kelas = $db->escape_string($id_kelas);
        $query = "SELECT g.nama_guru AS wali_kelas, g.nip, k.nama_kelas 
                  FROM kelas k 
                  JOIN guru g ON k.wali_kelas = g.nip 
                  WHERE k.id_kelas='$id_kelas'";
        $result = $db->query($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            echo "Query Error: " . $db->error . "<br>";
            return false;
        }
    }
    return false;
}

function getTahunAjaran() {
    $db = dbConnect();
    if ($db) {
        $query = "SELECT tahun_akademik, semester FROM tahun_akademik WHERE semester_aktif=1";
        $result = $db->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['tahun_akademik'] . ' - ' . $row['semester'];
        } else {
            echo "Query Error: " . $db->error . "<br>";
            return false;
        }
    }
    return false;
}


function ambilsatubaris($conn, $query) {
    $db = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($db);
}

function hapus($where, $table, $con) {
    $query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
    echo $query;
}

function showError($message) {
    ?>
    <div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
        <?php echo $message;?>
    </div>
    <?php
}

function ambilbanyakbaris($con, $query) {
    $result = mysqli_query($con, $query);
    $rows = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function getListSiswaByKelas($kelas_id) {
    $con = dbConnect();
    $query = "SELECT * FROM siswa WHERE id_kelas='$kelas_id'";
    $result = mysqli_query($con, $query);
    $rows = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

function getUser($username, $password) {
    $db = dbConnect();
    if ($db) {
        $username = $db->escape_string($username);
        $password = $db->escape_string($password);

        // Try to find user in 'siswa' table
        $query = "SELECT * FROM siswa WHERE nama='$username' AND nis='$password'";
        $result = $db->query($query);
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user['role'] = 'siswa';
            return $user;
        }

        // Try to find user in 'guru' table
        $query = "SELECT * FROM guru WHERE nama_guru='$username' AND nip='$password'";
        $result = $db->query($query);
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user['role'] = 'guru';
            return $user;
        }

        // Try to find user in 'admin' table
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password' AND role='admin'";
        $result = $db->query($query);
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user['role'] = 'admin';
            return $user;
        }
    }
    return false;
}

function getGuruBiodata($nip) {
    $db = dbConnect();
    if ($db) {
        $nip = $db->escape_string($nip);
        $query = "SELECT * FROM guru WHERE nip='$nip'";
        $result = $db->query($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            echo "Query Error: " . $db->error . "<br>";
            return false;
        }
    }
    return false;
}

function getBiodataSiswa($nis) {
    $db = dbConnect();
    if ($db) {
        $nis = $db->escape_string($nis);
        $query = "SELECT * FROM siswa WHERE nis='$nis'";
        $result = $db->query($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            echo "Query Error: " . $db->error . "<br>";
            return false;
        }
    }
    return false;
}
function getAverageScoresBySubjectAndSemester($nis) {
    $db = dbConnect();
    if ($db) {
        $nis = $db->escape_string($nis);
        // Query untuk mengambil nilai akhir per mata pelajaran
        $query = "
            SELECT mp.nama_mp, n.nilai_akhir
            FROM nilai n
            JOIN mata_pelajaran mp ON n.kd_mp = mp.kd_mp
            WHERE n.nis = '$nis'
        ";
        $result = $db->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Query Error: " . $db->error . "<br>";
            return false;
        }
    }
    return false;
}

function cekStatusPembayaran($nis) {
    $db = dbConnect();
    if ($db) {
        $nis = $db->escape_string($nis);
        $query = "SELECT status_pembayaran FROM siswa WHERE nis = '$nis'";
        $result = $db->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['status_pembayaran']; // Misalnya, 'LUNAS' atau 'BELUM_LUNAS'
        } else {
            return false;
        }
    }
    return false;
}

function getKelasGuruByTahunAkademik($id_tahun_akademik) {
    $db = dbConnect();
    $sql = "SELECT kg.*, k.nama_kelas, mp.nama_mp, g.nama_guru 
            FROM kelas_guru kg
            JOIN kelas k ON kg.id_kelas = k.id_kelas
            JOIN mata_pelajaran mp ON kg.kd_mp = mp.kd_mp
            JOIN guru g ON kg.nip = g.nip
            WHERE kg.id_tahun_akademik = '$id_tahun_akademik'";
    $result = $db->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function getTahunAkademikList() {
    $db = dbConnect();
    $sql = "SELECT * FROM tahun_akademik";
    $result = $db->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function getNilaiSiswaByTahunAkademik($nis, $id_tahun_akademik) {
    $db = dbConnect();
    $sql = "
        SELECT 
            mp.nama_mp,
            n.nilai_tp1, n.nilai_tp2, n.nilai_tp3, n.nilai_tp4, n.nilai_tp5, n.nilai_tp6, n.nilai_tp7, n.rata_tp,
            n.nilai_uh1, n.nilai_uh2, n.nilai_uh3, n.nilai_uh4, n.nilai_uh5, n.nilai_uh6, n.nilai_uh7, n.rata_uh,
            n.nilai_pts, n.nilai_uas, n.nilai_akhir, n.nilai_huruf, n.deskripsi
        FROM nilai n
        JOIN mata_pelajaran mp ON n.kd_mp = mp.kd_mp
        WHERE n.nis = '$nis' AND n.id_tahun_akademik = '$id_tahun_akademik'
    ";
    $result = $db->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}


?>
