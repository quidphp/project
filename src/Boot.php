<?php
declare(strict_types=1);
namespace Project;
use Quid\Lemur;

// boot
// class for booting the application
class Boot extends Lemur\Boot
{
    // config
    public static $config = [
        'types'=>['app','cms'],
        'version'=>['app'=>'1.0'],
        'lang'=>['en']
    ];
}

return [Boot::class,'start'];
?>