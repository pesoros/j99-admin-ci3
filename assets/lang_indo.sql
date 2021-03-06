
DELETE FROM `language`;
INSERT INTO `language` (`id`, `phrase`, `english`) VALUES
  (1, 'login', 'Gabung'),
  (2, 'email', 'Alamat email'),
  (3, 'password', 'Kata sandi'),
  (4, 'reset', 'Mengatur ulang'),
  (5, 'dashboard', 'Dasbor'),
  (6, 'home', 'Beranda'),
  (7, 'profile', 'Profil'),
  (8, 'profile_setting', 'Pengaturan Profil'),
  (9, 'firstname', 'Nama depan'),
  (10, 'lastname', 'Nama keluarga'),
  (11, 'about', 'Tentang'),
  (12, 'preview', 'Pratinjau'),
  (13, 'image', 'Gambar'),
  (14, 'save', 'Menyimpan'),
  (15, 'upload_successfully', 'Unggah Berhasil!'),
  (16, 'user_added_successfully', 'Pengguna Berhasil Ditambahkan!'),
  (17, 'please_try_again', 'Silahkan Coba Lagi...'),
  (18, 'inbox_message', 'Pesan Kotak Masuk'),
  (19, 'sent_message', 'Pesan Terkirim'),
  (20, 'message_details', 'Detail Pesan'),
  (21, 'new_message', 'Pesan baru'),
  (22, 'receiver_name', 'Nama Penerima'),
  (23, 'sender_name', 'Nama pengirim'),
  (24, 'subject', 'Subjek'),
  (25, 'message', 'Pesan'),
  (26, 'message_sent', 'Pesan terkirim!'),
  (27, 'ip_address', 'Alamat IP'),
  (28, 'last_login', 'Login terakhir'),
  (29, 'last_logout', 'Logout Terakhir'),
  (30, 'status', 'Status'),
  (31, 'delete_successfully', 'Hapus Berhasil!'),
  (32, 'send', 'Kirim'),
  (33, 'date', 'Tanggal'),
  (34, 'action', 'Tindakan'),
  (35, 'sl_no', 'Nomor TL.'),
  (36, 'are_you_sure', 'Apa kamu yakin ?'),
  (37, 'application_setting', 'Pengaturan Aplikasi'),
  (38, 'application_title', 'Judul Permohonan'),
  (39, 'address', 'Alamat'),
  (40, 'phone', 'Telepon'),
  (41, 'favicon', 'Favicon'),
  (42, 'logo', 'Logo'),
  (43, 'language', 'Bahasa'),
  (44, 'left_to_right', 'Kiri ke kanan'),
  (45, 'right_to_left', 'Kanan ke kiri'),
  (46, 'footer_text', 'Catatan kaki'),
  (47, 'site_align', 'Penyelarasan Aplikasi'),
  (48, 'welcome_back', 'Selamat Datang kembali!'),
  (49, 'please_contact_with_admin', 'Silahkan Kontak Dengan Admin'),
  (50, 'incorrect_email_or_password', 'Email/Kata Sandi Salah'),
  (51, 'select_option', 'Pilih opsi'),
  (52, 'ftp_setting', 'Sinkronisasi Data [Pengaturan FTP]'),
  (53, 'hostname', 'Nama Host'),
  (54, 'username', 'User Name'),
  (55, 'ftp_port', 'FTP Port'),
  (56, 'ftp_debug', 'FTP Debug'),
  (57, 'project_root', 'Project Root'),
  (58, 'update_successfully', 'Perbarui Berhasil'),
  (59, 'save_successfully', 'Simpan Berhasil!'),
  (61, 'internet_connection', 'Koneksi internet'),
  (62, 'ok', 'Ok'),
  (63, 'not_available', 'Tidak tersedia'),
  (64, 'available', 'Tersedia'),
  (65, 'outgoing_file', 'File Keluar'),
  (66, 'incoming_file', 'File masuk'),
  (67, 'data_synchronize', 'Sinkronisasi Data'),
  (68, 'unable_to_upload_file_please_check_configuration', 'Tidak dapat mengunggah file! silakan periksa konfigurasi'),
  (69, 'please_configure_synchronizer_settings', 'Silakan konfigurasikan pengaturan sinkronisasi'),
  (70, 'download_successfully', 'Unduh Berhasil'),
  (71, 'unable_to_download_file_please_check_configuration', 'Tidak dapat mengunduh berkas! silakan periksa konfigurasi'),
  (72, 'data_import_first', 'Impor Data Terlebih Dahulu'),
  (73, 'data_import_successfully', 'Impor Data Berhasil!'),
  (74, 'unable_to_import_data_please_check_config_or_sql_file', 'Tidak dapat mengimpor data! silakan periksa konfigurasi / file SQL.'),
  (75, 'download_data_from_server', 'Unduh Data dari Server'),
  (76, 'data_import_to_database', 'Impor Data Ke Basis Data'),
  (77, 'data_upload_to_server', 'Unggah Data ke Server'),
  (78, 'please_wait', 'Harap tunggu...'),
  (79, 'ooops_something_went_wrong', 'Ups ada yang salah...'),
  (80, 'module_permission_list', 'Daftar Izin Modul'),
  (81, 'user_permission', 'Izin Pengguna'),
  (82, 'add_module_permission', 'Tambah Izin Modul'),
  (83, 'module_permission_added_successfully', 'Izin Modul Berhasil Ditambahkan!'),
  (84, 'update_module_permission', 'Perbarui Izin Modul'),
  (85, 'download', 'Unduh'),
  (86, 'module_name', 'Nama Modul'),
  (87, 'create', 'Membuat'),
  (88, 'read', 'Membaca'),
  (89, 'update', 'Memperbarui'),
  (90, 'delete', 'Menghapus'),
  (91, 'module_list', 'Daftar Modul'),
  (92, 'add_module', 'Tambahkan Modul'),
  (93, 'directory', 'Direktori Modul'),
  (94, 'description', 'Keterangan'),
  (95, 'image_upload_successfully', 'Unggah Gambar Berhasil!'),
  (96, 'module_added_successfully', 'Modul Berhasil Ditambahkan'),
  (97, 'inactive', 'tidak aktif'),
  (98, 'active', 'Aktif'),
  (99, 'user_list', 'Daftar pengguna'),
  (100, 'see_all_message', 'Lihat Semua Pesan'),
  (101, 'setting', 'Pengaturan'),
  (102, 'logout', 'Keluar'),
  (103, 'admin', 'Admin'),
  (104, 'add_user', 'Tambahkan pengguna'),
  (105, 'user', 'Pengguna'),
  (106, 'module', 'Modul'),
  (107, 'new', 'Baru'),
  (108, 'inbox', 'kotak masuk'),
  (109, 'sent', 'Terkirim'),
  (110, 'synchronize', 'Sinkronisasi'),
  (111, 'data_synchronizer', 'Sinkronisasi Data'),
  (112, 'module_permission', 'Izin Modul'),
  (113, 'backup_now', 'Cadangkan Sekarang!'),
  (114, 'restore_now', 'Pulihkan Sekarang!'),
  (115, 'backup_and_restore', 'Cadangkan dan Pulihkan'),
  (116, 'captcha', 'Kata Captcha'),
  (117, 'database_backup', 'Cadangan Basis Data'),
  (118, 'restore_successfully', 'Kembalikan Berhasil'),
  (119, 'backup_successfully', 'Backup Berhasil'),
  (120, 'filename', 'Nama file'),
  (121, 'file_information', 'Informasi Berkas'),
  (122, 'size', 'Ukuran'),
  (123, 'backup_date', 'Tanggal Cadangan'),
  (124, 'overwrite', 'Timpa'),
  (125, 'invalid_file', 'File yang tidak valid!'),
  (126, 'invalid_module', 'Modul Tidak Valid'),
  (127, 'remove_successfully', 'Hapus Berhasil!'),
  (128, 'install', 'Install'),
  (129, 'uninstall', 'Uninstall'),
  (130, 'tables_are_not_available_in_database', 'Tabel tidak tersedia di database.sql'),
  (131, 'no_tables_are_registered_in_config', 'Tidak ada tabel yang terdaftar di config.php'),
  (132, 'enquiry', 'Pertanyaan'),
  (133, 'read_unread', 'Baca/Belum Dibaca'),
  (134, 'enquiry_information', 'Informasi Permintaan'),
  (135, 'user_agent', 'Agen pengguna'),
  (136, 'checked_by', 'Diperiksa oleh'),
  (137, 'new_enquiry', 'Pertanyaan Baru'),
  (138, 'fleet', 'Manajemen armada'),
  (139, 'fleet_type', 'Jenis Armada'),
  (140, 'add', 'Menambahkan'),
  (141, 'list', 'Daftar'),
  (142, 'fleet_facilities', 'Fasilitas Armada'),
  (143, 'fleet_registration', 'Pendaftaran Armada'),
  (144, 'reg_no', 'Nomor Pendaftaran'),
  (145, 'model_no', 'Model nomor.'),
  (146, 'engine_no', 'Nomor mesin'),
  (147, 'chasis_no', 'nomor rangka.'),
  (148, 'total_seat', 'Jumlah Kursi'),
  (149, 'seat_numbers', 'Nomor kursi'),
  (150, 'owner', 'Pemilik'),
  (151, 'company', 'Nama perusahaan'),
  (152, 'trip', 'Manajemen Perjalanan'),
  (153, 'location', 'Lokasi'),
  (154, 'route', 'Rute'),
  (155, 'assign', 'Menetapkan'),
  (156, 'close', 'Menutup'),
  (157, 'location_name', 'Nama lokasi'),
  (158, 'google_map', 'Google Map'),
  (159, 'start_point', 'Titik Awal'),
  (160, 'end_point', 'Titik Akhir'),
  (161, 'route_name', 'Nama Rute'),
  (162, 'distance', 'Jarak'),
  (163, 'approximate_time', 'Perkiraan Waktu'),
  (164, 'stoppage_points', 'Poin Penghentian'),
  (165, 'fleet_registration_no', 'Nomor Pendaftaran Armada'),
  (166, 'start_date', 'Tanggal mulai'),
  (167, 'end_date', 'Tanggal akhir'),
  (168, 'driver_name', 'Nama pengemudi'),
  (169, 'assistants_ids', 'asisten'),
  (170, 'sold_ticket', 'Tiket Terjual'),
  (171, 'total_income', 'Jumlah pemasukan'),
  (172, 'total_expense', 'Total Biaya'),
  (173, 'total_fuel', 'Jumlah Bahan Bakar'),
  (174, 'trip_comment', 'Komentar Perjalanan'),
  (175, 'closed_by', 'Ditutup oleh'),
  (176, 'ticket', 'Manajemen Tiket'),
  (177, 'passenger', 'Penumpang'),
  (178, 'middle_name', 'Nama tengah'),
  (179, 'date_of_birth', 'Tanggal lahir'),
  (180, 'passenger_id', 'ID penumpang.'),
  (181, 'address_line_1', 'Jalur Alamat 1'),
  (182, 'address_line_2', 'Jalur Alamat 2'),
  (184, 'zip_code', 'Kode Pos'),
  (186, 'name', 'Nama'),
  (187, 'ac_available', 'tersedia AC'),
  (188, 'trip_id', 'ID perjalanan.'),
  (189, 'book', 'Pesan'),
  (190, 'booking_id', 'Nomor Pemesanan.'),
  (191, 'available_seats', 'Kursi yang tersedia'),
  (192, 'select_seats', 'Pilih Kursi'),
  (193, 'time', 'Waktu'),
  (194, 'offer_code', 'Kode Penawaran'),
  (195, 'price', 'Harga'),
  (196, 'discount', 'Diskon'),
  (197, 'request_facilities', 'Fasilitas Permintaan'),
  (198, 'pickup_location', 'Lokasi penjemputan'),
  (199, 'drop_location', 'Jatuhkan Lokasi'),
  (200, 'amount', 'Jumlah'),
  (201, 'invalid_passenger_id', 'ID Penumpang tidak valid'),
  (202, 'invalid_input', 'Masukan Tidak Valid'),
  (203, 'booking_date', 'Tanggal Pemesanan'),
  (204, 'cancelation_fees', 'Biaya Pembatalan'),
  (205, 'causes', 'Penyebab'),
  (206, 'comment', 'Komentar'),
  (207, 'refund', 'Pengembalian dana'),
  (208, 'refund_by', 'Pengembalian dana oleh'),
  (209, 'feedback', 'Masukan'),
  (210, 'rating', 'Peringkat'),
  (211, 'blood_group', 'Golongan darah'),
  (212, 'religion', 'Agama'),
  (219, 'details', 'rincian'),
  (220, 'type_name', 'Jenis Nama'),
  (221, 'view_details', 'Melihat rincian'),
  (222, 'document_pic', 'Gambar Dokumen'),
  (223, 'fitness_list', 'Daftar kebugaran'),
  (226, 'fitness_name', 'Nama Kebugaran'),
  (227, 'fitness_description', 'Keterangan'),
  (228, 'successfully_updated', 'Data Anda Berhasil Diperbarui'),
  (229, 'fitness_period', 'Daftar Periode Kebugaran'),
  (230, 'fitness_id', 'Nama Kebugaran'),
  (231, 'vehicle_id', 'Kendaraan Tidak'),
  (234, 'start_milage', 'Mulai Jarak tempuh'),
  (235, 'end_milage', 'Akhir Jarak tempuh'),
  (236, 'agent', 'Agen'),
  (237, 'agent_first_name', 'Nama depan'),
  (238, 'agent_second_name', 'Nama keluarga'),
  (239, 'agent_company_name', 'Nama perusahaan'),
  (240, 'agent_document_id', 'ID dokumen'),
  (241, 'agent_pic_document', 'File Dokumen'),
  (242, 'agent_phone', 'Telepon'),
  (243, 'agent_mobile', 'Nomor telepon seluler'),
  (244, 'agent_email', 'Surel'),
  (245, 'agent_address_line_1', 'Jalur Alamat 1'),
  (246, 'agent_address_line_2', 'Jalur Alamat 2'),
  (247, 'agent_address_city', 'Kota'),
  (248, 'agent_address_zip_code', 'Kode Pos'),
  (249, 'agent_country', 'Negara'),
  (252, 'sl', 'SL'),
  (253, 'route_id', 'Nama Rute'),
  (254, 'vehicle_type_id', 'Jenis Kendaraan'),
  (255, 'group_price_per_person', 'Harga Grup Per Orang'),
  (256, 'group_size', 'Anggota kelompok'),
  (257, 'successfully_saved', 'Data Anda Berhasil Disimpan'),
  (258, 'account', 'Akun'),
  (259, 'account_name', 'Nama akun'),
  (260, 'account_type', 'Jenis akun'),
  (261, 'account_transaction', 'Transaksi Akun'),
  (262, 'account_id', 'Nama akun'),
  (263, 'transaction_description', 'Detil transaksi'),
  (265, 'pass_book_id', 'ID Penumpang'),
  (267, 'payment_id', 'ID pembayaran'),
  (268, 'create_by_id', 'Dibuat oleh'),
  (269, 'offer', 'Menawarkan'),
  (270, 'offer_name', 'Nama Penawaran'),
  (271, 'offer_start_date', 'Tanggal Mulai Penawaran'),
  (272, 'offer_end_date', 'Penawaran Tanggal Terakhir'),
  (274, 'offer_discount', 'Diskon'),
  (275, 'offer_terms', 'Ketentuan Penawaran'),
  (276, 'offer_route_id', 'Nama Rute'),
  (277, 'offer_number', 'Nomor Penawaran'),
  (280, 'seat_number', 'Nomor Kursi'),
  (281, 'available_seat', 'Kursi yang tersedia'),
  (282, 'owner_name', 'Nama pemilik'),
  (283, 'agent_picture', 'Gambar'),
  (284, 'account_add', 'Menambahkan akun'),
  (285, 'add_agent', 'Tambahkan Agen'),
  (286, 'hr', 'Sumber daya manusia'),
  (287, 'create_hr', 'Tambahkan Karyawan'),
  (288, 'serial', 'Sl'),
  (289, 'position', 'Posisi'),
  (290, 'phone_no', 'No Telepon'),
  (291, 'email_no', 'Surel'),
  (292, 'picture', 'Gambar'),
  (293, 'first_name', 'Nama depan'),
  (294, 'second_name', 'Nama keluarga'),
  (295, 'document_id', 'ID Dokumen'),
  (298, 'country', 'Negara'),
  (299, 'city', 'Kota'),
  (300, 'zip', 'Kode Pos '),
  (393, 'add_passenger', 'Tambahkan Penumpang'),
  (394, 'search_tiket', 'Cari Tiket'),
  (395, 'slogan', 'Slogan'),
  (396, 'website', 'Website'),
  (397, 'submit', 'Kirim'),
  (398, 'customer_service', 'Pelayanan pelanggan'),
  (399, 'submit_successfully', 'Kirim Berhasil!'),
  (400, 'add_to_website', 'Tambahkan ke Website'),
  (401, 'our_customers_say', 'Pelanggan Kami Mengatakan'),
  (402, 'website_status', 'Status Situs Web'),
  (403, 'title', 'Judul'),
  (405, 'total_fleet', 'Jumlah Armada'),
  (406, 'total_passenger', 'Jumlah Penumpang'),
  (407, 'todays_trip', 'Perjalanan hari ini'),
  (408, 'seats_available', 'Kursi tersedia'),
  (409, 'no_trip_avaiable', 'Tidak ada perjalanan yang tersedia'),
  (410, 'booking', 'Pemesanan'),
  (411, 'something_went_worng', 'Ada yang salah!'),
  (412, 'paypal_email', 'Email Paypal'),
  (413, 'currency', 'Mata uang'),
  (414, 'reports', 'Laporan'),
  (415, 'search', 'Mencari'),
  (417, 'go', 'Go'),
  (418, 'all', 'Semua'),
  (419, 'filter', 'Saring'),
  (420, 'last_year_progress', 'Kemajuan Tahun Lalu'),
  (421, 'download_document', 'Unduh Dokumen'),
  (422, 'mobile', 'Nomor telepon seluler.'),
  (424, 'account_list', 'Daftar Akun'),
  (425, 'add_income', 'Tambah Penghasilan'),
  (426, 'add_expense', 'Tambahkan Biaya'),
  (427, 'agent_list', 'Daftar Agen'),
  (428, 'add_fitness', 'Tambahkan Kebugaran'),
  (429, 'fitness', 'kebugaran'),
  (430, 'add_fitness_period', 'Tambahkan Periode Kebugaran'),
  (431, 'employee_type', 'Tipe Karyawan'),
  (432, 'employee_list', 'Daftar Karyawan'),
  (433, 'add_offer', 'Tambahkan Penawaran'),
  (434, 'offer_list', 'Daftar Penawaran'),
  (435, 'add_price', 'Tambahkan Harga'),
  (436, 'price_list', 'Daftar Harga'),
  (437, 'schedules', 'Penjadwalan'),
  (438, 'assigns', 'assigns'),
  (439, 'unpaid_cash_booking_list', 'daftar belum dibayar'),
  (440, 'downtime', 'downtime');
  