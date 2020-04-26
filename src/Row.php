<?php
declare(strict_types=1);
namespace Project;
use Quid\Lemur;

// row
// abstract class for a row, all rows will extend this class
abstract class Row extends Lemur\Row
{
    // config
    public static array $config = [
        '@app'=>[
            'where'=>true,
            'search'=>false,
            'route'=>[
                'cms'=>Lemur\Cms\Specific::class]]
    ];
}
?>