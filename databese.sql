CREATE TABLE pelanggan(
    id_pelanggan INT(11) NOT NULL AUTO_INCREMENT,
    nama_pelanggan VARCHAR(50) NOT NULL,
    alamat_pelanggan TEXT NOT NULL,
    PRIMARY KEY(id_pelanggan)
);

CREATE TABLE sparepart(
    id_sparepart INT(11) NOT NULL AUTO_INCREMENT,
    nama_sparepart VARCHAR(50) NOT NULL,
    merk_sparepart VARCHAR(50) NOT NULL,
    harga_sparepart INT(15) NOT NULL,
    stock_sparepart INT(5) NOT NULL,
    PRIMARY KEY(id_sparepart)
);

CREATE TABLE pabrikan_motor(
    id_pabrikan_motor INT(11) NOT NULL AUTO_INCREMENT,
    nama_pabrikan VARCHAR(50) NOT NULL,
    asal_negara VARCHAR(50) NOT NULL,
    PRIMARY KEY(id_pabrikan_motor)
);

CREATE TABLE kendaraan(
    id_kendaraan INT(11) NOT NULL AUTO_INCREMENT,
    plat_nomor VARCHAR(10) NOT NULL,
    nama_kendaraan VARCHAR(50) NOT NULL,
    id_pabrikan_motor INT(11) NOT NULL,
    id_pelanggan INT(11) NOT NULL,
    PRIMARY KEY(id_kendaraan),
    UNIQUE KEY(plat_nomor),
    FOREIGN KEY(id_pabrikan_motor) REFERENCES pabrikan_motor(id_pabrikan_motor),
    FOREIGN KEY(id_pelanggan) REFERENCES pelanggan(id_pelanggan)
);

CREATE TABLE service(
    id_service INT(11) NOT NULL AUTO_INCREMENT,
    id_pelanggan INT(11) NOT NULL,
    id_kendaraan INT(11) NOT NULL,
    id_sparepart INT(11),
    jenis_service VARCHAR(100),
    tanggal_service VARCHAR(20),
    biaya_service INT(15),
    PRIMARY KEY(id_service),
    FOREIGN KEY(id_pelanggan) REFERENCES pelanggan(id_pelanggan),
    FOREIGN KEY(id_kendaraan) REFERENCES kendaraan(id_kendaraan),
    FOREIGN KEY(id_sparepart) REFERENCES sparepart(id_sparepart)
);

CREATE TABLE pengguna(
    username VARCHAR(20) NOT NULL,
    password VARCHAR(35) NOT NULL,
    PRIMARY KEY(username)
);