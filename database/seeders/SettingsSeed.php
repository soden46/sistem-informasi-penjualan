<?php

namespace Database\Seeders;

use App\Models\Settings as ModelsSettings;
use Illuminate\Database\Seeder;

class SettingsSeed extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'nama_perusahaan' => 'CV Mitra Bangun Handayani',
                'tentang' => 'CV MBH merupakan salah satu perusahaan yang bergerak di bidang konstruksi, terutama pada bidang persiapan dan pematangan lahan konstruksi, jasa sewa alat berat dan pengadaan bahan bangunan konstruksi. CV MBH menyediakan berbagai solusi kebutuhan secara cepat dan tepat serta berorientasi pada kualitas. Selain menangani pekerjaan yang berkaitan dengan lahan konstruksi, CV MBH juga memberikan 
                solusi atas pekerjan penataan lahan masyarakat secara umum, misalnya penataan lahan pertanian, irigasi, talut, jalan dll. 
                Dengan umur yang masih relatif muda, CV MBH berdedikasi untuk menjadi perusahaan yang berorientasi terhadap kualitas pekerjaan serta berupaya menjadi solusi cepat dan tepat terhadap berbagai kebutuhan masyarakat.
                ',
                'alamat' => 'Jl. Dasarata No.9, Arjuna, Kec. Cicendo, Kota Bandung, Jawa Barat 40172',
                'telepon' => '098778928897',
                'email' => 'email@mail.com',
                'whatsapp' => '098778928897',
                'instagram' => 'cv.mbh',
                'facebook' => 'cv mbh'
            ]
        ];

        foreach ($settings as $key => $value) {
            ModelsSettings::create($value);
        }
    }
}
