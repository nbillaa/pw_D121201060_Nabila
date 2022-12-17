<?php
include 'koneksi.php';
if(isset($_POST['tambah'])){
    date_default_timezone_set('Asia/Makassar');
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $stok_masuk = $_POST['stok_masuk'];
    $kategori = "Masuk";
    $read = mysqli_query($conn,"SELECT * FROM stok_barang WHERE kode_barang = '".$_POST['kode_barang']."'");
    $simpan = mysqli_fetch_array($read);
    if(mysqli_num_rows($read)!=0){
        if($simpan['kode_barang'] == $kode_barang && $simpan['nama_barang']== $nama_barang){
            $insert = mysqli_query($conn,"INSERT INTO stok_barang VALUES
                            ('".date('d/m/Y H:i:s')."','".$kode_barang."',
                            '".$nama_barang."',
                            '".$stok_masuk."')");
    
            $insert2 = mysqli_query($conn,"INSERT INTO transaksi(Tanggal,kategori,kode_barang,nama_barang,stok) VALUES ('".date('d/m/Y H:i:s')."',
                                                    '".$kategori."',
                                                    '".$kode_barang."',
                                                    '".$nama_barang."',
                                                    '".$stok_masuk."')");
        }else{
            header('location:index.php?error=Kode Barang Harus Berbeda');
        }
    }else{
        $insert = mysqli_query($conn,"INSERT INTO stok_barang VALUES
                            ('".date('d/m/Y H:i:s')."','".$kode_barang."',
                            '".$nama_barang."',
                            '".$stok_masuk."')");
    
        $insert2 = mysqli_query($conn,"INSERT INTO transaksi(Tanggal,kategori,kode_barang,nama_barang,stok) VALUES ('".date('d/m/Y H:i:s')."',
                                                    '".$kategori."',
                                                    '".$kode_barang."',
                                                    '".$nama_barang."',
                                                    '".$stok_masuk."')");
            
    }
    if($insert){
        header('location:index.php');
    }else{
        echo "Data Gagal disimpan";
    }
}elseif(isset($_POST['tambah_barangkeluar'])){
    $read = mysqli_query($conn,"SELECT * FROM stok_barang WHERE kode_barang = '".$_POST['kode_barang']."'");
    if(mysqli_num_rows($read)==0){
        header('location:barangkeluar.php?error=Kode barang tidak ditemukan');
    }else{
        date_default_timezone_set('Asia/Makassar');
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $stok_keluar = $_POST['stok_keluar'];
        $kategori = "Keluar";
        $insert = mysqli_query($conn,"INSERT INTO stok_keluar VALUES 
                                    ('".date('d/m/Y H:i:s')."','".$kode_barang."',
                                    '".$nama_barang."',
                                    '".$stok_keluar."')");
        $insert2 = mysqli_query($conn,"INSERT INTO transaksi VALUES 
                                    ('".date('d/m/Y H:i:s')."','".$kategori."',
                                    '".$kode_barang."',
                                    '".$nama_barang."',
                                    '".$stok_keluar."')");             
        if($insert){
            header('location:barangkeluar.php');
        }
    }
}

if(isset($_GET['tanggal'])){
    date_default_timezone_set('Asia/Makassar');
    $update = mysqli_query($conn,"UPDATE stok_barang SET Tanggal = '".date('d/m/Y H:i:s')."',
                                                        kode_barang = '".$_POST['kode_barang']."',
                                                        nama_barang = '".$_POST['nama_barang']."',
                                                        stok_masuk = '".$_POST['stok_masuk']."' WHERE Tanggal='".$_GET['tanggal']."'");

    $update2 = mysqli_query($conn,"UPDATE transaksi SET Tanggal = '".date('d/m/Y H:i:s')."',
                                                        kode_barang = '".$_POST['kode_barang']."',
                                                        nama_barang = '".$_POST['nama_barang']."',
                                                        stok = '".$_POST['stok_masuk']."' WHERE Tanggal='".$_GET['tanggal']."'");
    if($update){
        header('location:index.php');
    }

}elseif(isset($_GET['tanggal_keluar'])){
    date_default_timezone_set('Asia/Makassar');
    $update = mysqli_query($conn,"UPDATE stok_keluar SET Tanggal = '".date('d/m/Y H:i:s')."',
                                                        kode_barang = '".$_POST['kode_barang']."',
                                                        nama_barang = '".$_POST['nama_barang']."',
                                                        stok_keluar = '".$_POST['stok_keluar']."' WHERE Tanggal='".$_GET['tanggal_keluar']."'");
    
    $update2 = mysqli_query($conn,"UPDATE transaksi SET Tanggal = '".date('d/m/Y H:i:s')."',
                                                        kode_barang = '".$_POST['kode_barang']."',
                                                        nama_barang = '".$_POST['nama_barang']."',
                                                        stok = '".$_POST['stok_keluar']."' WHERE Tanggal='".$_GET['tanggal_keluar']."'");
    if($update){
        header('location:barangkeluar.php');
    }

}elseif(isset($_GET['hapus_data_keluar'])){
    $delete = mysqli_query($conn,"DELETE FROM stok_keluar where Tanggal = '".$_GET['hapus_data_keluar']."' ");
    $delete1 = mysqli_query($conn,"DELETE FROM transaksi where Tanggal = '".$_GET['hapus_data_keluar']."' ");
    if($delete){
        header('location:barangkeluar.php');
    }   
}elseif(isset($_GET['hapus_data_transaksi'])){
    $deleteall = mysqli_query($conn,"DELETE FROM transaksi WHERE 1");
    if($deleteall){
        header('location:detail.php');
    }
}elseif(isset($_GET['hapus_stok_barang'])){
    $deleteall1 = mysqli_query($conn,"DELETE FROM stok_barang WHERE Tanggal ='".$_GET['hapus_stok_barang']."'");
    $deleteall2 = mysqli_query($conn,"DELETE FROM transaksi WHERE Tanggal ='".$_GET['hapus_stok_barang']."'");
    if($deleteall1){
        header('location:index.php');
    }
}
?>