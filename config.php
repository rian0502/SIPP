<?php
class Connection{
    private $USERNAME = "root";
    private $PASSWORD = "rian";
    private $HOST = "localhost";
    private $DATABASE = "perpustakaan";
    private ?PDO $koneksi;

    public function __construct(){
        try{
            $this->koneksi = new PDO("mysql:host=".$this->HOST.";dbname=".$this->DATABASE,$this->USERNAME, $this->PASSWORD);
        }catch (PDOException $exception){
            echo "Eror : ".$exception->getMessage();
            die("<br>Koneksi Gagal");
        }
    }
    public function getKoneksi(): ?PDO{
        return $this->koneksi;
    }
    public function destroyConnection(){
        $this->koneksi = null;
    }
}
