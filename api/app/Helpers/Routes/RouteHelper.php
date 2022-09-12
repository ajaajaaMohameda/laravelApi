<?php
namespace App\Helpers\Routes;

use Psy\Readline\Hoa\IteratorRecursiveDirectory;
class RouteHelper
{
    public static function loadRoutesFiles($folder)
    {
         // iterate throught the v1 folder recursively
    $dirIterator = new IteratorRecursiveDirectory($folder);
    /**
     * @var RecursiveIteratorIterator | IteratorRecursiveDirectory $it
     */
        $it = new \RecursiveIteratorIterator($dirIterator);
    
        while($it->valid()) {
            if(!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension()) {
                require $it->key();
            }
            $it->next();
        }
    }
}

