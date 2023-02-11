<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Telegram\Models\BotMenu;

class BotMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            'Digital documents' => [
                'IDP certificate' => [
                    'Cancel status',
                    'Change address',
                    'How to upload',
                    'Where to use',
                ],
                'Driving license',
                'Technical passport',
                'ID card and foreign passport',
                'Document',
                'Covid-certificate',
                'Certificate',
                'Insurance policy',
            ],
            'Services' => [
                'Internally displaced persons',
                'Military bonds',
                'єOselya',
                'Payment',
                'Benefits and assistance',
                'FOP taxes',
                'Family and migration',
                'Construction and real estate',
            ],
            'Authorization' => [
                'Authorization and Application',
                'Authorization on the portal'
            ],
            'Action.Signature' => [
                'How to create',
                'Can\'t pass PhotoId verification',
                'Where is it stored?',
                'For what?',
            ],
        ];

        $this->recursiveSave($menus);
    }

    protected function recursiveSave(array $menus, $level = 0, ?BotMenu $parentModel = null): void
    {
        foreach ($menus as $mainMenu => $subMenu) {
            $menu = null;

            if (is_string($mainMenu) && is_null($parentModel)) {
                $menu = BotMenu::query()->create(['name' => $mainMenu]);
            }

            if (is_string($mainMenu) && $parentModel) {
                $menu = $parentModel->children()->create(['name' => $mainMenu]);
            }

            if (is_array($subMenu)) {
                $this->recursiveSave($subMenu, $level + 1, $menu);
            } else {
                $parentModel->children()->create(['name' => $subMenu]);
            }
        }
    }
}
