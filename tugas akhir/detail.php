<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Final</title>
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
                <div class="titleumum">Data Barang Toko</div>
                <a class="bar1" href="index.php">Stok Masuk</a>
                <a class="bar2" href="barangkeluar.php">Stok Keluar</a>
                <a class="bar3" id="current" href="detail.php">Detail Transaksi</a>
            </div>
            <div class="sidebar-left">
                <div class="wrap1">
                    <div class="judul">
                        <a class="hapus_semua" href="aksi.php?hapus_data_transaksi=<?php echo "ya"?>">Hapus</a>
                        Histori Transaksi
                    </div>
                    <table class="table1">
                        <tr>
                            <th width="10%">Tanggal</th>
                            <th width="10%">Kategori</th>
                            <th width="10%">Kode Barang</th>
                            <th width="10%">Nama Barang</th>
                            <th width="10%">Stok</th>
                            <th width="10%">Aksi</th>
                        </tr>
                        <?php
                        include 'koneksi.php';
                            $select = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY Tanggal DESC");
                        if(mysqli_num_rows($select) > 0){
                            while($stok_barang = mysqli_fetch_array($select)){
                        ?>
                        <tr>
                            <td><?php echo $stok_barang['Tanggal']; ?></td>
                            <td><b><i><?php echo $stok_barang['kategori']; ?></i></b></td>
                            <td><?php echo $stok_barang['kode_barang']; ?></td>
                            <td><?php echo $stok_barang['nama_barang']; ?></td>
                            <td><?php echo $stok_barang['stok']; ?></td>
                            <td>
                                <a class="aksi-biru" href="detail.php?kode_barang=<?php echo $stok_barang['kode_barang']?>">Lihat Detail</a> 
                            </td>
                        </tr> 
                        <?php }}else{ ?>   
                        <tr>
                            <td colspan="7"><center><img src="image/histori.png" alt="Data Kosong" width="250px" height="250px"><center></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="wrap2">
                    <div class="namatabel">Detail Transaksi Barang</div>
                        <table class="table1">
                            <tr>
                                <th width="10%">Tanggal</th>
                                <th width="10%">Kategori</th>
                                <th width="10%">Kode Barang</th>
                                <th width="10%">Nama Barang</th>
                                <th width="10%">Stok</th>
                            </tr>
                            
                            <?php
                                include 'koneksi.php';
                                if(isset($_GET['kode_barang'])){
                                    $select = mysqli_query($conn, "SELECT * FROM transaksi where kode_barang = '".$_GET['kode_barang']."'");
                                    if(mysqli_num_rows($select) > 0){
                                        while($stok_barang = mysqli_fetch_array($select)){
                                    ?>
                                    <tr>
                                        <td><?php echo $stok_barang['Tanggal']; ?></td>
                                        <td><b><i><?php echo $stok_barang['kategori']; ?></i></b></td>
                                        <td><?php echo $stok_barang['kode_barang']; ?></td>
                                        <td><?php echo $stok_barang['nama_barang']; ?></td>
                                        <td><?php echo $stok_barang['stok']; ?></td>
                                    </tr> 
                                    <?php }}}else{ ?>   
                                    <tr>
                                        <td colspan="5"><center><img src="image/detail.png" alt="Data Kosong" width=300px height=250px><center></td>
                                    </tr>
                            <?php }?>
                        </table>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
</body>
</html>