<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPassportDataToDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert("INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
            (1, NULL, 'CMS1 Personal Access Client', 'jNUD09gdgV8FRGbHgp57OcZqxGWZorHGu6LjlS1S', 'http://localhost', 1, 0, 0, '2020-02-21 00:46:56', '2020-02-21 00:46:56'),
            (2, NULL, 'CMS1 Password Grant Client', 'JnuiZjBOsrAX8b40o1GySbGciRn0Nr4LJOJy0ryg', 'http://localhost', 0, 1, 0, '2020-02-21 00:46:56', '2020-02-21 00:46:56');
        ");

        DB::insert("INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
            (1, 1, '2020-02-21 00:46:56', '2020-02-21 00:46:56');
        ");

        // calling artisan command to generate passport keys for all fresh installations
        Artisan::call('passport:keys');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('oauth_clients')->truncate();
        DB::table('oauth_personal_access_clients')->truncate();
    }
}
