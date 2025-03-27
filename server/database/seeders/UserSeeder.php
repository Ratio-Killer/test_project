<?php

namespace Database\Seeders;

use App\Contracts\Services\AbzApiServiceContract;
use App\DataTransferObjects\User\UserStoreDTO;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserSeeder extends Seeder
{
    private AbzApiServiceContract $api_service;

    public function __construct(AbzApiServiceContract $api_service)
    {
        $this->api_service = $api_service;
    }

    /**
     * Run the database seeds.
     * @throws UnknownProperties
     */
    public function run(): void
    {
        $faker = Faker::create();
        $seededUsers = [];
        for ($i = 0; $i < 45; $i++) {
            $gender = rand(0, 1) ? 'men' : 'women';
            $randomId = rand(1, 99);
            $avatarUrl = config('abz_api')['random_image_url'] . "/{$gender}/{$randomId}.jpg";
            $directory = storage_path('app/public/avatar');

            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $fakeImagePath = $directory . "/avatar_{$i}.jpg";
            $imageContent = file_get_contents($avatarUrl);
            file_put_contents($fakeImagePath, $imageContent);

            $photo = new UploadedFile(
                $fakeImagePath,
                "avatar_{$i}.jpg",
                'image/jpeg',
                null,
                true
            );

            $userData = new UserStoreDTO([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => '+380' . $faker->numerify('#########'),
                'position_id' => rand(1, 4),
                'photo' => $photo,
            ]);

            $response = $this->api_service->setUser($userData);
            if ($response['success']) {
                $seededUsers[] = ['user_id' => $response['user_id']];
            }

        }
        print_r($seededUsers);
    }
}
