<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            $this->provUser(
                'Laravel News',
                'https://laravel-news.com',
                'https://laravel-news.com/favicon-32x32.png',
            ),
        );
        User::insert(
            $this->provUser(
                'Scotch io',
                'https://scotch.io',
                'https://scotch.io/favicon-32x32.png',
            ),
        );
        User::insert(
            $this->provUser(
                'Envato Tuts+',
                'https://code.tutsplus.com',
                'https://static.tutsplus.com/packs/media/images/favicon-4822c2463d591273c6c8eea96b1422e3.png',
            ),
        );
        User::insert(
            $this->provUser(
                'Scott Robinson',
                'https://dor.ky/',
                'https://dor.ky/assets/images/favicons/favicon-32x32.png',
            ),
        );
        User::insert(
            $this->provUser(
                'DigitalOcean',
                'https://www.digitalocean.com',
                'https://www.digitalocean.com/assets/community/favicon-32x32-e377577c425642ab495296dfec040ec903e36ffc4cd7a0a4281e84597891a774.png',
            ),
        );
        User::insert(
            $this->provUser(
                'Pusher',
                'https://pusher.com',
                'https://d2cy1obokpvee9.cloudfront.net/manifest/favicon-96x96.png',
            ),
        );
        User::insert(
            $this->provUser(
                'John Koster',
                'https://stillat.com',
                'https://stillat.com/favicon-32x32.png',
            ),
        );
        User::insert(
            $this->provUser(
                'Povilas Korop',
                'https://laraveldaily.com/author/povilas/',
                'https://secure.gravatar.com/avatar/1653e999074ac526727ad5f84c1e563b',
            ),
        );
        User::insert(
            $this->provUser(
                'Vegibit',
                'https://vegibit.com',
                'https://vegibit.com/themes/vegibit.png',
            ),
        );

        // User::factory()->create([
        //     'email' => 'admin@site.test',
        // ]);

        // User::factory()
        //     ->count(9)
        //     ->create();
    }

    private function provUser(
        string $name,
        string $url,
        ?string $image = null
    ): array {
        $name = Str::title($name);
        $slug = Str::slug($name);
        $email = $slug . '@' . $slug . '.com';
        $password = Hash::make(bin2hex(random_bytes(9)));

        return compact('name', 'url', 'image', 'url', 'password', 'email');
    }
}
