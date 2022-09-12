<?php
namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;
trait TruncateTable 
{
    function truncate($table) {
        DB::table($table)->truncate();
    }
}