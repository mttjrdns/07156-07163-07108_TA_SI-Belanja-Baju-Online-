<?php

class TransaksiController
{
    private $modelTransaksi;
    private $modelUser;
    private $modelKurir;

    public function __construct()
    {
        $this->modelTransaksi = new TransaksiModel();
        $this->modelUser = new UserModel();
        $this->modelKurir = new KurirModel();
    }

    /**
     * berfungsi untuk menampilkan produk yang sudah di checkout
     */
    public function view()
    {
        $idUser = $_GET['idUser'];
        $dataCheckout = $this->modelTransaksi->getDataCheckout($idUser);
        $totalHargaCheckout = $this->modelTransaksi->getTotalHargaDataCheckout($idUser);
        $dataUser = $this->modelUser->getDataUser($idUser);
        $dataKurir = $this->modelKurir->getKurir();
        extract($dataCheckout);
        extract($totalHargaCheckout);
        extract($dataUser);
        extract($dataKurir);
        $BASE_URL = "http://localhost/projek-belanjaBajuOnline";
        require_once("View/transaksi.php");
    }

    /**
     * berfungsi untuk mendapatkan histori transaksi pada user
     */
    public function getHistoriTransaksi($statusPembelian)
    {
        //? nunggu progress login
        //! $idUser = $_SESSION['user']['id'];
        $dataTransaksi = $this->modelTransaksi->getDataTransaksi(3, $statusPembelian);
        $detailDataTransaksi = $this->modelTransaksi->getDetailDataTransaksi(3, $statusPembelian);
        extract($dataTransaksi);
        extract($detailDataTransaksi);
        $BASE_URL = "http://localhost/projek-belanjaBajuOnline";
        require_once("View/histori_transaksi.php");
    }

    /**
     * berfungsi untuk mendapatkan transaksi pembelian statusnya dalam proses
     */
    public function getPembelianTerproses($statusPembelian)
    {
        //? nunggu progress login
        //! $idUser = $_SESSION['user']['id'];
        $dataTransaksi = $this->modelTransaksi->getDataTransaksi(2, $statusPembelian);
        $detailDataTransaksi = $this->modelTransaksi->getDetailDataTransaksi(2, $statusPembelian);
        extract($dataTransaksi);
        extract($detailDataTransaksi);
        $BASE_URL = "http://localhost/projek-belanjaBajuOnline";
        $judul = "Dalam Proses";
        require_once("View/pembelian.php");
    }

    /**
     * berfungsi untuk mendapatkan transaksi pembelian statusnya dalam pengiriman
     */
    public function getPembelianTerkirim($statusPembelian)
    {
        //? nunggu progress login
        //! $idUser = $_SESSION['user']['id'];
        $dataTransaksi = $this->modelTransaksi->getDataTransaksi(3, $statusPembelian);
        $detailDataTransaksi = $this->modelTransaksi->getDetailDataTransaksi(3, $statusPembelian);
        extract($dataTransaksi);
        extract($detailDataTransaksi);
        $BASE_URL = "http://localhost/projek-belanjaBajuOnline";
        $judul = "Dalam Pengiriman";
        require_once("View/pembelian.php");
    }

    /**
     * berfungsi untuk mengupdate pembelian yang barangnya telah diterima
     */
    public function updatePembelian()
    {
        $idTransaksi = $_GET['id'];
        $this->modelTransaksi->prosesUpdatePembelian($idTransaksi);
        header("location: index.php?page=pembelian&aksi=keadaanTerkirim");
    }

    /**
     * berfungsi untuk mendapatkan produk yang telah dimasukkan ke dalam keranjang
     */
    public function getKeranjang()
    {
        //? nunggu progress login
        //! $idUser = $_SESSION['user']['id'];
        $dataKeranjang = $this->modelTransaksi->getDataKeranjang(4);
        extract($dataKeranjang);
        $BASE_URL = "http://localhost/projek-belanjaBajuOnline";
        require_once("View/keranjang.php");
    }

    /**
     * berfungsi untuk mengahapus produk yang ada dalam keranjang
     */
    public function delete()
    {
        $idBaju = $_GET['idBaju'];
        $idTransaksi = $_GET['idTransaksi'];
        $this->modelTransaksi->prosesDeleteKeranjang($idTransaksi, $idBaju);
        header("location: index.php?page=keranjang&aksi=view");
    }

    /**
     * berfungsi untuk mengupdate jumlah pembelian sebelum dilakukan transaksi
     */
    public function checkoutKeranjang()
    {
        $idTransaksi = $_POST['idTransaksi'];
        $idBaju = $_POST['idBaju'];
        $jumlahPembelian = $_POST['jumlahPembelian'];
        for ($i = 0; $i < count($idTransaksi); $i++) {
            $this->modelTransaksi->updateCheckout($idTransaksi[$i], $idBaju[$i], $jumlahPembelian[$i]);
        }
    }

    /**
     * berfungsi untuk menyimpan data dengan mengupdate transaksi menjadi dalam keadaan proses
     */
    public function update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $idUser = $_POST['idUser'];
        $jarak = $_POST['jarak'];
        $idKurir = $_POST['jasaPengiriman'];
        $tanggal = date("Y-m-d");
        $waktu = date("H:i:s");
        $tanggalWaktu = $tanggal . " " . $waktu;
        $this->modelTransaksi->prosesUpdate($idUser, $tanggalWaktu, $jarak, $idKurir);
        header("location: index.php?page=pembelian&aksi=view");
    }

    /**
     * berfungsi untuk menyimpan data produk ke dalam keranjang
     */
    public function storeKeranjang()
    {
        $idUser = $_POST['idUser'];
        $idBaju = $_POST['idBaju'];
        if (empty($this->modelTransaksi->cekKeranjangUser($idUser, $idBaju))) {
            $this->modelTransaksi->prosesStore($idUser, $idBaju);
        }
    }
}
