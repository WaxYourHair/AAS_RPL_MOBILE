<?php
session_start();
include_once '../functions.php'; // Ensure this path is correct

// Ensure no output before PDF creation
ob_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
    header("Location: login.php");
    exit();
}

// Include autoload file from Composer
require_once('../vendor/autoload.php'); // Ensure this path is correct

$nis = $_SESSION['user']['nis'];
$nama_siswa = $_SESSION['user']['nama'];
$id_kelas = $_SESSION['user']['id_kelas'];
$nilai_siswa = getNilaiSiswa($nis);

// Fetching class teacher and academic year from database
$wali_kelas_details = getWaliKelasDetails($id_kelas); // Fetching the class teacher details
$tahun_ajaran = getTahunAjaran(); // Fetching the academic year

$wali_kelas = $wali_kelas_details['wali_kelas'];
$nip_wali_kelas = $wali_kelas_details['nip'];
$kelas = $wali_kelas_details['nama_kelas'];

$tanggal_cetak = date("d M Y");

$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistem Raport');
$pdf->SetTitle('Cetak Raport');
$pdf->SetHeaderData('', '', 'Cetak Raport', '');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(10, 10, 10); // Set margin
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 10); // Adjust font size
$pdf->AddPage();

// Create header
$html = '
<h3 style="text-align:center;">SMPN 1 GRABAG</h3>
<h3 style="text-align:center;">Akreditasi A</h3>
<hr style="border:1px solid;">
<p style="text-align:right;">Alamat : Jl. Raya Grabag No.100, Grabag, Kec. Grabag, Kabupaten Magelang, Jawa Tengah 56196t</p>
<h4 style="text-align:center;">DATA HASIL BELAJAR SISWA</h4>
<h4 style="text-align:center;">RAPORT SISWA</h4>
<br>
<table>
    <tr>
        <td width="150"><b>NIS</b></td>
        <td width="20">:</td>
        <td width="250">' . htmlspecialchars($nis) . '</td>
        <td width="100"><b>Tahun Ajaran</b></td>
        <td width="20">:</td>
        <td>' . htmlspecialchars($tahun_ajaran) . '</td>
    </tr>
    <tr>
        <td width="150"><b>Nama Siswa</b></td>
        <td width="20">:</td>
        <td width="250">' . htmlspecialchars($nama_siswa) . '</td>
    </tr>
    <tr>
        <td width="150"><b>Kelas</b></td>
        <td width="20">:</td>
        <td width="250">' . htmlspecialchars($kelas) . '</td>
    </tr>
</table>
<br>
<table border="1" cellpadding="4">
    <thead>
        <tr>
            <th rowspan="2" style="text-align:center;">MATA PELAJARAN</th>
            <th colspan="4" style="text-align:center;">NILAI</th>
            <th rowspan="2" style="text-align:center;">NILAI AKHIR</th>
            <th rowspan="2" style="text-align:center;">PREDIKAT</th>
            <th rowspan="2" style="text-align:center;">KETERANGAN</th>
        </tr>
        <tr>
            <th style="text-align:center;">RTP</th>
            <th style="text-align:center;">RNU</th>
            <th style="text-align:center;">PTS</th>
            <th style="text-align:center;">UAS</th>
        </tr>
    </thead>
    <tbody>';

foreach ($nilai_siswa as $nilai) {
    // Convert predikat to letter grades
    $predikat = '';
    if ($nilai['nilai_akhir'] >= 90) {
        $predikat = 'A';
    } elseif ($nilai['nilai_akhir'] >= 80) {
        $predikat = 'B';
    } elseif ($nilai['nilai_akhir'] >= 70) {
        $predikat = 'C';
    } else {
        $predikat = 'D';
    }

    $html .= '<tr>
                <td>' . htmlspecialchars($nilai['nama_mp']) . '</td>
                <td style="text-align:center;">' . htmlspecialchars($nilai['nilai_tp1']) . '</td>
                <td style="text-align:center;">' . htmlspecialchars($nilai['nilai_tp2']) . '</td>
                <td style="text-align:center;">' . htmlspecialchars($nilai['nilai_tp3']) . '</td>
                <td style="text-align:center;">' . htmlspecialchars($nilai['nilai_tp4']) . '</td>
                <td style="text-align:center;">' . htmlspecialchars($nilai['nilai_akhir']) . '</td>
                <td style="text-align:center;">' . htmlspecialchars($predikat) . '</td>
                <td>' . htmlspecialchars($nilai['deskripsi']) . '</td>
            </tr>';
}

$html .= '</tbody>
</table>
<p style="text-align:right;">GRABAG, ' . htmlspecialchars($tanggal_cetak) . '</p>
<table>
    <tr>
        <td class="text-center" width="500">
            Kepala Sekolah
            <br>
            SMP NEGERI 1 GRABAG
            <br>
            <br>
            <br>
            <br>
            <u>HAMAS ARDHANA </u>
            <br>
            NIP. 123456789
        </td>
        <td class="text-center" width="500">
            Wali Kelas
            <br>
            <br>
            <br>
            <br>
            <u>' . htmlspecialchars($wali_kelas) . '</u>
            <br>
            NIP. ' . htmlspecialchars($nip_wali_kelas) . '
        </td>
    </tr>
</table>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('raport.pdf', 'I');

ob_end_flush(); // Stop output buffering and output everything
?>
