<?php
namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKeys 
{
    public function disableForeignKey()
    {
    // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement('PRAGMA foreign_keys = OFF');
}

    public function enableForeignKey()
    {
        DB::statement('PRAGMA foreign_keys = ON');
        // DB::statement('SET FOREIGN_KEY_CHECKS=1'); works only in sql
        
    }
}