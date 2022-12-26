<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use App\Models\SubClassificationAccount;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [
                'code' => '1100001',
                'name' => 'Kas',
                'is_cash' => true,
                'is_active' => true,
                'sub_category' => 'Kas dan Setara Kas'
            ],
            [
                'code' => '1100002',
                'name' => 'Kas Kecil',
                'is_cash' => true,
                'is_active' => true,
                'sub_category' => 'Kas dan Setara Kas'
            ],
            [
                'code' => '1200001',
                'name' => 'Bank',
                'is_cash' => true,
                'is_active' => true,
                'sub_category' => 'Bank'
            ],
            [
                'code' => '1300001',
                'name' => 'Piutang Dagang',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Piutang Usaha'
            ],
            [
                'code' => '1399001',
                'name' => 'Piutang Lain',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Piutang Lain'
            ],
            [
                'code' => '1400001',
                'name' => 'Persediaan Barang Dagang',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Persediaan Barang Dagang'
            ],
            [
                'code' => '1499001',
                'name' => 'Persediaan Lain',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Persediaan Lain'
            ],
            [
                'code' => '1510001',
                'name' => 'Uang Dibayar Dimuka',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Uang Dibayar Dimuka'
            ],
            [
                'code' => '1520001',
                'name' => 'Pajak Dibayar Dimuka',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Pajak Dibayar Dimuka'
            ],
            [
                'code' => '1530001',
                'name' => 'Biaya Dibayar Dimuka',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Biaya Dibayar Dimuka'
            ],
            [
                'code' => '1530002',
                'name' => 'Sewa Dibayar Dimuka',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Biaya Dibayar Dimuka'
            ],
            [
                'code' => '1539002',
                'name' => 'Biaya Dibayar Dimuka Lainnya',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Biaya Dibayar Dimuka'
            ],
            [
                'code' => '1600000',
                'name' => 'Investasi Saham',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Investasi'
            ],
            [
                'code' => '1700001',
                'name' => 'Tanah',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Harta Tetap Berwujud'
            ],[
                'code' => '1700002',
                'name' => 'Bangunan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Harta Tetap Berwujud'
            ],
            [
                'code' => '1700002',
                'name' => 'Mesin dan Peralatan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Harta Tetap Berwujud'
            ],
            [
                'code' => '1700003',
                'name' => 'Kendaraan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Harta Tetap Berwujud'
            ],
            [
                'code' => '1710002',
                'name' => 'Akumulasi Penyusutan Bangunan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Akumulasi Penyusutan Harta Tetap'
            ],
            [
                'code' => '1710002',
                'name' => 'Akumulasi Penyusutan Mesin dan Peralatan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Akumulasi Penyusutan Harta Tetap'
            ],
            [
                'code' => '1710003',
                'name' => 'Akumulasi Penyusutan Kendaraan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Akumulasi Penyusutan Harta Tetap'
            ],
            [
                'code' => '1709003',
                'name' => 'Harta Lain',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Harta Tetap Berwujud'
            ],
            [
                'code' => '1719003',
                'name' => 'Akumulasi Penyusutan Harta Lain',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Akumulasi Penyusutan Harta Tetap'
            ],
            [
                'code' => '1900000',
                'name' => 'Harta Unit Usaha',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Harta Unit Usaha'
            ],
            [
                'code' => '2100001',
                'name' => 'Utang Usaha',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Utang Usaha'
            ],
            [
                'code' => '2190001',
                'name' => 'Utang Belum Ditagih',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Utang Usaha'
            ],
            [
                'code' => '2190002',
                'name' => 'Utang Giro',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Utang Usaha'
            ],
            [
                'code' => '2210000',
                'name' => 'Uang Muka Penjualan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Uang Muka Diterima'
            ],
            [
                'code' => '2290000',
                'name' => 'Pendapatan Belum Ditagihkan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Pendapatan Belum Ditagihkan'
            ],
            [
                'code' => '2300000',
                'name' => 'Utang Pajak',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Utang Pajak'
            ],
            [
                'code' => '2600000',
                'name' => 'Utang Pembiayaan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Utang Jangka Panjang'
            ],
            [
                'code' => '3100001',
                'name' => 'Modal Disetor',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Modal'
            ],
            [
                'code' => '3200001',
                'name' => 'Laba Ditahan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Laba'
            ],
            [
                'code' => '3300000',
                'name' => 'Laba Tahun Berjalan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Laba'
            ],   
            [
                'code' => '3900000',
                'name' => 'Modal Unit Usaha',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Modal Unit Usaha'
            ],            
            [
                'code' => '4100001',
                'name' => 'Penjualan Produk',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Penjualan Produk'
            ],
            [
                'code' => '4200001',
                'name' => 'Potongan Penjualan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Potongan Penjualan'
            ],
            [
                'code' => '4300001',
                'name' => 'Retur Penjualan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Retur Penjualan'
            ],
            [
                'code' => '4900001',
                'name' => 'Penjualan Jasa',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Pendapatan Lain'
            ],
            [
                'code' => '5100001',
                'name' => 'Harga Pokok Penjualan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Harga Pokok Penjualan'
            ],
            [
                'code' => '5900001',
                'name' => 'Potongan Pembelian',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Atas Pendapatan'
            ],
            [
                'code' => '5900002',
                'name' => 'Beban Pembelian',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Atas Pendapatan'
            ],
            [
                'code' => '5900003',
                'name' => 'Beban Pengiriman',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Atas Pendapatan'
            ],
            [
                'code' => '5900004',
                'name' => 'Penyesuaian Persediaan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Atas Pendapatan'
            ],
            [
                'code' => '5300000',
                'name' => 'Retur Pembelian',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Retur Pembelian'
            ],
            [
                'code' => '5200000',
                'name' => 'Potongan Pembelian',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Potongan Pembelian'
            ],
            [
                'code' => '5800001',
                'name' => 'Beban Listrik',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Operasional'
            ],
            [
                'code' => '5800002',
                'name' => 'Beban Gaji',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Operasional'
            ],
            [
                'code' => '5800003',
                'name' => 'Beban Air',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Operasional'
            ],
            [
                'code' => '5899999',
                'name' => 'Beban Lain',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Operasional'
            ],
            [
                'code' => '5600001',
                'name' => 'Beban Pajak',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Pajak'
            ],
            [
                'code' => '5700001',
                'name' => 'Beban Penyusutan',
                'is_cash' => false,
                'is_active' => true,
                'sub_category' => 'Beban Penyusutan'
            ],
        ];
        
        foreach ($accounts as $account) {
            //find single data sub classification account by finding the sub_category
            $subClassification = SubClassificationAccount::where('name', $account['sub_category'])->first();
            $account['sub_classification_account_id'] = $subClassification->id;
            
            if ($subClassification) {
                Account::create($account);
            }
        }
    }
}