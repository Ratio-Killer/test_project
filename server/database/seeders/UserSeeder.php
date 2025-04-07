<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Traits\Image\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserSeeder extends Seeder
{
use ImageTrait;
    /**
     * Run the database seeds.
     * @throws UnknownProperties
     */
    public function run(): void
    {
        $faker = Faker::create();
        $positionIds = Position::pluck('id')->toArray();
        $users = [];

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

            $processedPhoto = $this->processImage($photo);

            $userData = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => '+380' . $faker->numerify('#########'),
                'position_id' => $faker->randomElement($positionIds),
                'photo' => url("images/users/{$processedPhoto->getFilename()}"),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $users[] = $userData;
        }

        DB::table('users')->insert($users);
    }
}
