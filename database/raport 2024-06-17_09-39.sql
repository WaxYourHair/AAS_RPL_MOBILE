
-- Database Backup --
-- Ver. : 1.0.1
-- Host : 127.0.0.1
-- Generating Time : Jun 17, 2024 at 04:39:47:AM



CREATE TABLE `guru` (
  `nip` varchar(18) NOT NULL,
  `kd_mp` int(11) DEFAULT NULL,
  `nama_guru` varchar(30) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `agama` enum('ISLAM','PROTESTAN','KATHOLIK','HINDU','BUDHA','KONGHUCU','LAINNYA') DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `kd_mp` (`kd_mp`),
  KEY `kd_mp_2` (`kd_mp`),
  KEY `nip` (`nip`),
  CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`kd_mp`) REFERENCES `mata_pelajaran` (`kd_mp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO guru VALUES
("197303012006040082","10","Bambang","Pamengpeuk","L","ISLAM"),
("197303012006041013","1","Budi","Cikancung","L","ISLAM"),
("197303012006041093","3","Rini Sopiati","Ciledug","P","ISLAM"),
("197303012006041434","5","Titin Suratin","Pamengpeuk","P","ISLAM"),
("197303012006041439","8","Tina Martil","Baleendah","P","ISLAM"),
("197303012006041801","9","Jajang","Cikancung","L","PROTESTAN"),
("197303012006041867","4","Abdul Halim","Tarogong","L","ISLAM"),
("197303012006042817","2","Anwar","Pamengpeuk","L","ISLAM"),
("197303012006047117","7","Hani","Tarogong","P","ISLAM"),
("197303012006048803","11","Entis","Panyileukan","P","ISLAM"),
("197303012006048865","6","Tarno","Mengkurakyat","L","ISLAM");




CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;


INSERT INTO kelas VALUES
("1","VII A"),
("2","VII B"),
("3","VIII A"),
("4","VIII B"),
("5","IX A"),
("6","IX B"),
("7","asd"),
("8","");




CREATE TABLE `kelas_guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(11) NOT NULL,
  `kd_mp` int(11) NOT NULL,
  `nip` varchar(18) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelas` (`id_kelas`),
  KEY `kd_mp` (`kd_mp`),
  KEY `nip` (`nip`),
  CONSTRAINT `kelas_guru_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `kelas_guru_ibfk_2` FOREIGN KEY (`kd_mp`) REFERENCES `mata_pelajaran` (`kd_mp`),
  CONSTRAINT `kelas_guru_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;


INSERT INTO kelas_guru VALUES
("15","1","10","197303012006040082");




CREATE TABLE `mata_pelajaran` (
  `kd_mp` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kd_mp`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;


INSERT INTO mata_pelajaran VALUES
("1","Pendidikan Agama Islam"),
("2","PKN"),
("3","Bahasa Indonesia"),
("4","Matematika"),
("5","Ilmu Pengetahuan Alam"),
("6","Ilmu Pengetahuan Sosial"),
("7","Bahasa Inggris"),
("8","Seni Budaya"),
("9","Penjasorkes"),
("10","Prakarya"),
("11","Bahasa Sunda"),
("12",""),
("13","");




CREATE TABLE `nilai` (
  `nis` varchar(8) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kd_mp` int(11) NOT NULL,
  `nilai_tp1` int(4) DEFAULT NULL,
  `nilai_tp2` int(4) DEFAULT NULL,
  `nilai_tp3` int(4) DEFAULT NULL,
  `nilai_tp4` int(4) DEFAULT NULL,
  `nilai_tp5` int(4) DEFAULT NULL,
  `nilai_tp6` int(4) DEFAULT NULL,
  `nilai_tp7` int(4) DEFAULT NULL,
  `rata_tp` int(4) DEFAULT NULL,
  `nilai_uh1` int(4) DEFAULT NULL,
  `nilai_uh2` int(4) DEFAULT NULL,
  `nilai_uh3` int(4) DEFAULT NULL,
  `nilai_uh4` int(4) DEFAULT NULL,
  `nilai_uh5` int(4) DEFAULT NULL,
  `nilai_uh6` int(4) DEFAULT NULL,
  `nilai_uh7` int(4) DEFAULT NULL,
  `rata_uh` int(4) DEFAULT NULL,
  `nilai_pts` int(4) DEFAULT NULL,
  `nilai_uas` int(4) DEFAULT NULL,
  `nilai_akhir` int(4) DEFAULT NULL,
  `nilai_huruf` enum('A','B','C','D','E') DEFAULT NULL,
  `deskripsi` mediumtext,
  `id_mp` int(11) DEFAULT NULL,
  PRIMARY KEY (`nis`,`id_kelas`,`kd_mp`),
  KEY `id_kelas` (`id_kelas`),
  KEY `kd_mp` (`kd_mp`),
  KEY `fk_id_mp` (`id_mp`),
  CONSTRAINT `fk_id_mp` FOREIGN KEY (`id_mp`) REFERENCES `mata_pelajaran` (`kd_mp`),
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`kd_mp`) REFERENCES `mata_pelajaran` (`kd_mp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO nilai VALUES
("345","1","10","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","E","Sangat Kurang",""),
("asdf","1","10","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","E","Sangat Kurang","");




CREATE TABLE `siswa` (
  `nis` varchar(8) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `agama` enum('ISLAM','PROTESTAN','KATHOLIK','HINDU','BUDHA','KONGHUCU','LAINNYA') DEFAULT NULL,
  `orang_tua` varchar(30) DEFAULT NULL,
  `asal_sekolah` varchar(50) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  PRIMARY KEY (`nis`),
  KEY `siswa_ibfk_2` (`id_kelas`),
  CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO siswa VALUES
("345","dfg","dfg","2024-08-16","L","ISLAM","sfd","sfsdf","1"),
("77241560","alika","Jl. Garut Tasik","2007-07-17","P","ISLAM","Tono","SDN Ngamplang Sari 4",""),
("77287165","siti","Jl. Margalaksana","2007-08-10","P","ISLAM","Jakaria","SDN Ngamplang Sari 4",""),
("asdf","as","dfdf","0000-00-00","L","HINDU","df","df","1");




CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO user VALUES
("1","admin","admin","admin@gmail.com","2024-06-21 00:00:00"),
("2","admin","5f4dcc3b5aa765d61d8327deb882cf99","admin@example.com","2024-06-17 09:30:26");


