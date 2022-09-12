<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
class CommentSeeder extends Seeder
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
        $this->truncate('comments');
        // create 3 comment for each post
        Comment::factory(3)
        ->for(Post::factory(1),'post')
        ->create();
        $this->enableForeignKey();
    }
}
