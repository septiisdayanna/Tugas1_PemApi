<?php
header('Content-Type: application/json; charset=utf8');

$koneksi = mysqli_connect("localhost", "root", "", "rest_api");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM mahasiswa";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();

    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data;
    }

    echo json_encode($array_data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $universitas = $_POST['universitas'];
    $sql = "INSERT INTO mahasiswa (nama, nim, jurusan, universitas) VALUES ('$nama', '$nim', '$jurusan', '$universitas')";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = ['status' => 'berhasil'];
        echo json_encode([$data]);
    } else {
        $data = ['status' => 'gagal'];
        echo json_encode([$data]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $sql = "DELETE FROM mahasiswa WHERE id = '$id'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = ['status' => 'berhasil'];
        echo json_encode([$data]);
    } else {
        $data = ['status' => 'gagal'];
        echo json_encode([$data]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = $_GET['id'];
    $nama = $_GET['nama'];
    $nim = $_GET['nim'];
    $jurusan = $_GET['jurusan'];
    $universitas = $_GET['universitas'];

    $sql = "UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan', universitas='$universitas' WHERE id='$id'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = ['status' => 'berhasil'];
        echo json_encode([$data]);
    } else {
        $data = ['status' => 'gagal'];
        echo json_encode([$data]);
    }
}
?>