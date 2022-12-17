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
                <a class="bar1" id="current" href="index.php">Stok Masuk</a>
                <a class="bar2" href="barangkeluar.php">Stok Keluar</a>
                <a class="bar3" href="detail.php">Detail Transaksi</a>
            </div>
        </div>
        <div class="sidebar-left">
            <div class="card">
                <form class="form" action="aksi.php" method="POST">
                <h3>Input Data Barang</h3>
                <?php
                    if(isset($_GET['error'])){ ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                    <input type="text" name="kode_barang" placeholder="Kode Barang" class="input" required><br>
                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="input"required><br>
                    <input type="number" name="stok_masuk" placeholder="Stok Barang Masuk" class="input" required><br>
                    
                    <input type="submit" name="tambah" value="Simpan Data" class="btn">
                </form>
            </div>
        </div>   

        <div class="sidebar-right">
            <div style="padding:20px;">
                <div class="namatabel">Data Stok Barang</div>
                <table class="table1">
                    <tr>
                        <th width="10%">Tanggal</th>
                        <th width="5%">Kode Barang</th>
                        <th width="10%">Nama Barang</th>
                        <th width="10%">Stok Barang Masuk</th>
                        <th width="30%">Aksi</th>
                    </tr>
                    <?php
                    include 'koneksi.php';
                        $select = mysqli_query($conn, "SELECT * FROM stok_barang");
                    if(mysqli_num_rows($select) > 0){
                        while($stok_barang = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                        <td><?php echo $stok_barang['Tanggal'];?></td>
                        <td><?php echo $stok_barang['kode_barang']; ?></td>
                        <td><?php echo $stok_barang['nama_barang']; ?></td>
                        <td><?php echo $stok_barang['stok_masuk']; ?></td>
                        <td>
                            <a class="aksi-green" href="edit.php?kode_barang=<?php echo $stok_barang['kode_barang']?>">Ubah</a>
                            <a class="aksi-red" href="aksi.php?hapus_stok_barang=<?php echo $stok_barang['Tanggal']?>">Hapus</a>
                            <a class="aksi-biru" href="barangkeluar.php?kode_barang=<?php echo $stok_barang['kode_barang']?>">Stok Keluar</a>  
                        </td>
                    </tr> 
                    <?php }}else{ ?>   
                    <tr>
                        <td colspan="7"><center><img src="image/gambardata.png" alt="Data Kosong" width="250px" height="170px"><center></td>
                    </tr>
                    <?php } ?>
                </table>
             </div>
        </div>
        <div style="clear:both;"></div>
    </div>
</body>
</html>