<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
class PostSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->disableForeignKey();
        $this->truncate('posts');

        Post::factory(200)
        // ->has(Comment::factory(3), 'comments')
        ->create();
        $this->enableForeignKey();
    }
}
