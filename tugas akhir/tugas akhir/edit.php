<?php
include 'koneksi.php';
$edit_data = mysqli_query($conn,"SELECT * FROM stok_barang where kode_barang = '".$_GET['kode_barang']."'");
$hasil = mysqli_fetch_array($edit_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="nav">
        <div class = "titlenav">
            Informasi Persediaan Stok Barang Toko
        </div>
    </div>
    <div class="wraper" id="title-id">
        <div class="atas">
            <div class="title">
                <div class="titleumum">Edit Data Barang Toko</div>
                <a class="bar1" id="current" href="index.php">Stok Masuk</a>
                <a class="bar2" href="barangkeluar.php">Stok Keluar</a>
            </div>
        </div>
        <div class="sidebar-left">
            <div class="card">
                <form class="form" action="aksi.php?tanggal=<?php echo $hasil['Tanggal']?>" method="POST">
                <h3>Edit Data Barang</h3>
                    <input type="text" name="kode_barang" value="<?php echo $hasil['kode_barang']?>" class="input" required><br>
                    <input type="text" name="nama_barang" value="<?php echo $hasil['nama_barang']?>" class="input"required><br>
                    <input type="number" name="stok_masuk" value="<?php echo $hasil['stok_masuk']?>" class="input" required><br>
                    
                    <input type="submit" name="edit" value="Edit Data" class="btn">
                </form>
            </div>
        </div>   

        <div class="sidebar-right">
            <div style="padding:20px;">
                <span class="namatabel"><center>Data Stok Barang</center></span>
                <table class="table1">
                    <tr>
                        <th width="10%">Tanggal</th>
                        <th width="10%">Kode Barang</th>
                        <th width="15%">Nama Barang</th>
                        <th width="10%">Stok Barang Masuk</th>
                        <th width="30%">Aksi</th>
                    <?php
                    include 'koneksi.php';
                        $select = mysqli_query($conn, "SELECT * FROM stok_barang");
                        while($stok_barang = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                        <td><?php echo $stok_barang['Tanggal']; ?></td>
                        <td><?php echo $stok_barang['kode_barang']; ?></td>
                        <td><?php echo $stok_barang['nama_barang']; ?></td>
                        <td><?php echo $stok_barang['stok_masuk']; ?></td>
                        <td>
                            <a class="aksi-red-edit" href="aksi.php?hapus_stok_barang=<?php echo $stok_barang['Tanggal']?>">Hapus</a>
                        </td>
                    </tr> 
                    <?php }  ?>
                </table>
             </div>
        </div>
        <div style="clear:both;"></div>
    </div>
</body>
</html>