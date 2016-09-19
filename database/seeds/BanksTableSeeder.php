<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            'bank' => 'BANK MANDIRI',
            'address' => 'Jl. Jenderal Gatot Subroto Kav. 36-38. Jakarta 12190 Indonesia',
            'logo' => 'mandiri.png',
            'code' => '008',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BRI',
            'address' => 'Gedung BRI 1 Jl. Jenderal Sudirman Kav.44-46. Jakarta 10210. Indonesia',
            'logo' => 'bri.png',
            'code' => '002',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BNI',
            'address' => 'GEDUNG BNI JL.JEND.SUDIRMAN KAV 1 JAKARTA 10220',
            'logo' => 'bni.png',
            'code' => '009',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'CIMB NIAGA',
            'address' => 'Graha CIMB Niaga Jl. Jend. Sudirman Kav. 58',
            'logo' => 'cimbniaga.png',
            'code' => '022',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'PANIN BANK',
            'address' => 'Jl. Jendral Sudirman Kav. 1 - (Senayan), Jakarta 10270 , INDONESIA',
            'logo' => 'panin.png',
            'code' => '019',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'PERMATA BANK',
            'address' => 'PermataBank Tower I Jl. Jend. Sudirman Kav. 27, Jakarta 12920',
            'logo' => 'permata.png',
            'code' => '013',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK DANAMON',
            'address' => 'Menara Bank Danamon Jl. Prof. Dr. Satrio Kav. E IV No. 6. Jakarta 12950',
            'logo' => 'danamon.png',
            'code' => '011',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BII MAYBANK',
            'address' => 'PLAZA BII TOWER 2 JL. MH. THAMRIN KAV.2 NO.51 WISMA BII, JAKARTA 10350',
            'logo' => 'bii.png',
            'code' => '016',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BTN',
            'address' => 'Menara Bank BTN Jl. Gajah Mada No.1 Jakarta 10130',
            'logo' => 'btn.png',
            'code' => '200',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'OCBC NISP',
            'address' => 'OCBC NISP Tower Jl. Prof. Dr. Satrio Kav. 25 Jakarta 12940 - Indonesia',
            'logo' => 'ocbc.png',
            'code' => '028',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK JABAR',
            'address' => 'Jl. Braga No. 135 - Bandung 40111',
            'logo' => 'jabar.png',
            'code' => '425',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MEGA',
            'address' => 'Menara Bank Mega Lantai 2, Jl. Kapten Tendean Kav. 12 - 14A Jakarta',
            'logo' => 'mega.png',
            'code' => '426',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BUKOPIN',
            'address' => 'Jl. MT. Haryono Kav. 50-51, Jakarta 12770',
            'logo' => 'bukopin.png',
            'code' => '441',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'HSBC',
            'address' => 'Jl. Wolter Monginsidi No. 64 C Kebayoran Baru, South Jakarta',
            'logo' => 'hsbc.png',
            'code' => '041',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'CITIBANK',
            'address' => 'Citibank, N.A. Cabang Indonesia 9th floor, Citibank tower jl. Jend. Sudirman Kav. 54-55',
            'logo' => 'citibank.png',
            'code' => '031',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK UOB',
            'address' => 'Gedung UOB PLAZA JL M.H. Thamrin No.10 Jakarta Pusat',
            'logo' => 'uob.png',
            'code' => '023',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BTPN',
            'address' => 'Menara Cyber 2 Lantai 24 dan 25 HR. Rasuna Said Blok X-5 No.13 Jakarta Selatan 12950',
            'logo' => 'btpn.png',
            'code' => '213',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MANDIRI SYARIAH',
            'address' => 'Jl. MH Thamrin No. 5 Jakarta',
            'logo' => 'mandirisyariah.png',
            'code' => '451',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'STANDARD CHARTERED',
            'address' => 'Wisma Standard Chartered Jl. Jend Sudirman Kav. 33 A. Jakarta 10220 Indonesia',
            'logo' => 'standarchartered.png',
            'code' => '050',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MUAMALAT',
            'address' => 'Gd.Arthaloka Jl. Jend. Sudirman No. 2, Jakarta',
            'logo' => 'muamalat.png',
            'code' => '147',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK DBS',
            'address' => 'Plaza Permata Jl. M H Thamrin Kav.57 Jakarta 10350',
            'logo' => 'dbs.png',
            'code' => '046',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK KALTIM',
            'address' => 'Jl. S. Parman No. 14-15 Kec. Bontang Barat Bontang',
            'logo' => 'kaltim.png',
            'code' => '124',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK JATIM',
            'address' => 'Jl. Basuki Rachmat No. 98-104 Surabaya',
            'logo' => 'jatim.png',
            'code' => '114',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'ANZ',
            'address' => 'ANZ Tower Ground Floor Jl. Jend. Sudirman Kav 33A, Jakarta 10220',
            'logo' => 'anz.png',
            'code' => '061',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK DKI',
            'address' => 'Jl. Ir. H. Juanda III No. 7 - 9, Jakarta Pusat 10120',
            'logo' => 'dki.png',
            'code' => '111',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK JATENG',
            'address' => 'Gedung Grinatha lantai 5 ln. Pemuda No. 142 Semarang',
            'logo' => 'jateng.png',
            'code' => '113',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK EKONOMI',
            'address' => 'Jl. Setiabudi Selatan Kav. 7-8 Jakarta 12920',
            'logo' => 'ekonomi.png',
            'code' => '087',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SUMUT',
            'address' => 'Jl. Imam Bonjol No. 18 Medan',
            'logo' => 'sumut.png',
            'code' => '117',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK RIAU',
            'address' => 'Jalan Jenderal Sudirman No.377 Pekanbaru',
            'logo' => 'riau.png',
            'code' => '119',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MAYAPADA',
            'address' => 'MAYAPADA TOWER Ground Floor JL. Jend. Sudirman Kav 28, Jakarta',
            'logo' => 'mayapada.png',
            'code' => '097',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SUMSELBABEL',
            'address' => 'Jl.Gubernur H.Ahmad Bastari No.7 Kel. Silaberanti Kec.Seberang Ulu I Jakabaring Palembang',
            'logo' => 'sumselbabel.png',
            'code' => '120',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK JTRUST',
            'address' => 'Sahid Sudirman Center 33,35,36 Floor Jl. Jend. Sudirman No. 86 Jakarta',
            'logo' => 'jtrust.png',
            'code' => '095',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SINARMAS',
            'address' => 'Wisma Bank Sinarmas, 1st & 2nd Floor Jl. MH. Thamrin No. 51 – Jakarta 10350',
            'logo' => 'sinarmas.png',
            'code' => '153',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK PAPUA',
            'address' => 'Jl. Ahmad Yani no. 5-7 Jayapura - Papua - Indonesia',
            'logo' => 'papua.png',
            'code' => '132',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'COMMONWEALTH BANK',
            'address' => 'Wisma Metropolitan II 3A Floor Jl. Jenderal Sudirman Kav 29-31 Jakarta 12920',
            'logo' => 'commonwealth.png',
            'code' => '950',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK NAGARI',
            'address' => 'Jl. Pemuda No. 21, Padang 25117 Sumatera Barat',
            'logo' => 'nagari.png',
            'code' => '118',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BRI SYARIAH',
            'address' => 'Jl Abdul Muis No 2-4 Jakarta Pusat',
            'logo' => 'brisyariah.png',
            'code' => '422',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'RABOBANK',
            'address' => 'Plaza 89, Lantai 9 Jl. H.R. Rasuna Said Kav. X-7 No. 6 Jakarta 12940 - Indonesia',
            'logo' => 'rabo.png',
            'code' => '089',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK OF CHINA',
            'address' => 'Jalan Jend. Sudirman Kav.24 Jakarta 12920',
            'logo' => 'china.png',
            'code' => '069',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK ACEH',
            'address' => 'Jl. Tgk. H. M. Daud Beureueh No. 24 Banda Aceh, Aceh - Indonesia, 23123',
            'logo' => 'aceh.png',
            'code' => '116',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BPD BALI',
            'address' => 'JL. RAYA PUPUTAN NITI MANDALA, DENPASAR',
            'logo' => 'bali.png',
            'code' => '129',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK KALSEL',
            'address' => 'Jl. Lambung Mangkurat No.7 Banjarmasin 70111',
            'logo' => 'kalsel.png',
            'code' => '122',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK KALBAR',
            'address' => 'Jl. Rahadi Osman No. 10 Pontianak',
            'logo' => 'kalbar.png',
            'code' => '123',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BNP',
            'address' => 'Jl. Ir. H. Juanda No. 95 , Bandung 40132 Jawa Barat Indonesia',
            'logo' => 'bnp.png',
            'code' => '145',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MEGA SYARIAH',
            'address' => 'Menara Bank Mega Lobby floor Jl. Kapt. Tendean Kav. 12-14 A Jakarta 12790',
            'logo' => 'megasyariah.png',
            'code' => '506',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK PUNDI',
            'address' => 'Jln. R.S. Fatmawati No. 12 JAKARTA SELATAN10350 Indonesia',
            'logo' => 'pundi.png',
            'code' => '558',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK WOORI SAUDARA (BWS)',
            'address' => 'Gedung Bank Saudara Jl. Diponegoro No. 28 Bandung 40115',
            'logo' => 'bws.png',
            'code' => '212',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SULSEL',
            'address' => 'Jl. Dr. Sam Ratulangi No. 16 Makassar',
            'logo' => 'sulsel.png',
            'code' => '126',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK ICBC IND',
            'address' => 'ICBC Tower 32 nd Floor Jl. M.H. Thamrin No.81, Jakarta Pusat 10310',
            'logo' => 'icbc.png',
            'code' => '164',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MESTIKA',
            'address' => 'Jl. H. Zainul Arifin No. 118, Medan',
            'logo' => 'mestika.png',
            'code' => '151',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK NTT',
            'address' => 'Jl. W.J. Lalamentik 102 Kupang, Nusa Tenggara Timur 85000 Indonesia',
            'logo' => 'ntt.png',
            'code' => '130',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SULUT',
            'address' => 'JL SAMRATULANGI NO 27,MANADO',
            'logo' => 'sulut.png',
            'code' => '127',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK CAPITAL',
            'address' => 'Sona Topas Tower lantai 16, Jl. Jendral Sudirman Kav. 26, Jakarta',
            'logo' => 'capital.png',
            'code' => '054',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK DIY',
            'address' => 'JL TENTARA PELAJAR NO 7 YOGYA',
            'logo' => 'diy.png',
            'code' => '112',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK LAMPUNG',
            'address' => 'Jl. Wolter Monginsidi 182 Bandar Lampung',
            'logo' => 'lampung.png',
            'code' => '121',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK QNB',
            'address' => 'QNB Kesawan Tower, Parc 18 Jl. Jendral Sudirman Kav. 52-53 Jakarta 12190',
            'logo' => 'qnb.png',
            'code' => '167',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MALUKU',
            'address' => 'Jl. Raya Pattimura No. 09',
            'logo' => 'maluku.png',
            'code' => '131',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BJB',
            'address' => 'Bank BJB Tower JL. Naripan No. 12-14, Bandung 40111',
            'logo' => 'bjb.png',
            'code' => '110',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK INDEX',
            'address' => 'Plaza Permata Jl. M.H. Thamrin Kav. 57 Lt. 8, Jakarta Pusat 10350',
            'logo' => 'index.png',
            'code' => '555',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK NTB',
            'address' => 'Jl. Pejanggik 30, Mataram 83126',
            'logo' => 'ntb.png',
            'code' => '128',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK AGRO',
            'address' => 'Plaza GRI Jl. HR Rasuna Said Blok X2 No. 1, Jakarta 12950',
            'logo' => 'agro.png',
            'code' => '494',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK KALTENG',
            'address' => 'JL RTA MILONO NO 12 , PALANGKARAYA',
            'logo' => 'kalteng.png',
            'code' => '125',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK JAMBI',
            'address' => 'Jl. Jend. A. Yani No. 18 Jambi',
            'logo' => 'jambi.png',
            'code' => '115',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK KESEJAHTERAAN',
            'address' => 'Gedung IKP-RI Jl. R.P Soeroso No.21, Jakarta Pusat 10330',
            'logo' => 'kesejahteraan.png',
            'code' => '535',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SULTRA',
            'address' => 'JL MAYJEN SUTOYO NO 95 KENDARI',
            'logo' => 'sultra.png',
            'code' => '135',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK BENGKULU',
            'address' => 'JL Basuki Rahmat, 6, Bengkulu',
            'logo' => 'bengkulu.png',
            'code' => '133',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK OF INDIA INDONESIA',
            'address' => 'JL. H. SAMANHUDI NO. 37 JAKARTA 10710, INDONESIA',
            'logo' => 'indiaindonesia.png',
            'code' => '146',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MAYORA',
            'address' => 'Gedung Mayora Jalan Tomang Raya 11440',
            'logo' => 'mayora.png',
            'code' => '553',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK GANESHA',
            'address' => 'Jl. Hayam Wuruk No. 28 Jakarta 10120',
            'logo' => 'ganesha.png',
            'code' => '161',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK INA',
            'address' => 'Wisma BSG Jl. Abdul Muis No 40 Jakarta Pusat',
            'logo' => 'ina.png',
            'code' => '513',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SULTENG',
            'address' => 'JL SULTAN HASANUDDIN NO 20 PALU SULTENG',
            'logo' => 'sulteng.png',
            'code' => '134',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK NOBU',
            'address' => 'NOBU Center Plaza Semanggi, Jl. Jend. Sudirman Kav. 50, Jakarta 12930',
            'logo' => 'nobu.png',
            'code' => '503',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK PANIN SYARIAH',
            'address' => 'Gedung Panin Life Center Lantai 3 Jl. Letjend S. Parman Kav. 91 Jakarta Barat 11420',
            'logo' => 'paninsyariah.png',
            'code' => '517',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK ARTOS',
            'address' => 'Jl. Otto Iskandardinata No. 18 Bandung',
            'logo' => 'artos.png',
            'code' => '542',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BPR KS',
            'address' => 'Jl. Abdurachman Saleh No.2 Bandung',
            'logo' => 'bprks.png',
            'code' => '688',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BPR SUPRA',
            'address' => 'Jl. Abdurachman Saleh No.2 Bandung',
            'logo' => 'bprsupra.png',
            'code' => '-',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK SEMOGA JAYA ARTHA',
            'address' => 'JL AGUS SALIM NO 22, Kota Samarinda, Kalimantan Timur',
            'logo' => 'artha.png',
            'code' => '558',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK ANDARA',
            'address' => 'Plasa Bapindo Citibank Tower fl.28 Jl Jendral Sudirman Kav 54-55, Jakarta 12190',
            'logo' => 'andara.png',
            'code' => '-',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK MNC',
            'address' => 'Gedung MNC Financial Center Lantai 6, 7, 8 Jl. Kebon Sirih Raya No. 27 Jakarta Pusat 10340',
            'logo' => 'mnc.png',
            'code' => '485',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK WOORI INDONESIA',
            'address' => 'Jakarta Stock Exchange Building Tower 1, 16th Floor Jl. Jend Sudirman Kav 52-53 Jakarta 12190 Indonesia',
            'logo' => 'woori.png',
            'code' => '068',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'TCASH',
            'address' => '-',
            'logo' => 'tcash.png',
            'code' => '911',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK YUDHA BHAKTI',
            'address' => 'Gedung Primagraha Persada Jl. Gedung Kesenian No.3-7 Jakarta Pusat 10710',
            'logo' => 'yudha.png',
            'code' => '490',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK DINAR',
            'address' => 'Jl. Ir. H. Juanda No 12 Jakarta Pusat',
            'logo' => 'dinar.png',
            'code' => '526',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BPR/LSB',
            'address' => '-',
            'logo' => 'atmbersama.png',
            'code' => '600',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'BANK EKA',
            'address' => 'JL. AHMAD YANI NO 70 METRO Kota Metro - Lampung',
            'logo' => 'eka.png',
            'code' => '699',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'DOMPETKU',
            'address' => 'Gedung Indosat Jl. Medan Merdeka Barat No. 1 Jakarta Pusat',
            'logo' => 'dompetku.png',
            'code' => '789',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('banks')->insert([
            'bank' => 'ATMBPLUS',
            'address' => '-',
            'logo' => 'atmbersama.png',
            'code' => '987',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
