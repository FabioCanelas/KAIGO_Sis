<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContent;

class SiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            [
                'section' => 'Home - About',
                'setting_key' => 'about_title',
                'setting_value' => 'APASIONADOS POR LA TECNOLOGÍA',
            ],
            [
                'section' => 'Home - About',
                'setting_key' => 'about_text',
                'setting_value' => 'Tecnología que inspira. En KIVO curamos experiencias a través de gadgets premium, donde el diseño excepcional y la potencia se encuentran.',
            ],
            [
                'section' => 'Home - Izquierda',
                'setting_key' => 'home_left_title',
                'setting_value' => 'NUESTRO OBJETIVO',
            ],
            [
                'section' => 'Home - Izquierda',
                'setting_key' => 'home_left_text',
                'setting_value' => 'Ser los N°1 en este ámbito ganándonos la confianza de nuestros clientes mediante un servicio de calidad y productos premium.',
            ],
            [
                'section' => 'Home - Derecha',
                'setting_key' => 'home_right_title',
                'setting_value' => 'KIVO',
            ],
            [
                'section' => 'Home - Derecha',
                'setting_key' => 'home_right_text',
                'setting_value' => 'Somos un equipo de emprendedores que buscan ofrecerte y traerte lo mejor en productos tecnológicos.',
            ],
        ];

        foreach ($contents as $content) {
            SiteContent::updateOrCreate(
                ['setting_key' => $content['setting_key']],
                $content
            );
        }
    }
}
