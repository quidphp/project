<?php
declare(strict_types=1);
namespace Project;
use Quid\Lemur;

// route
// abstract class for a route, all routes will extend this class
abstract class Route extends Lemur\Route
{
    // config
    public static array $config = [
        '@app'=>[
            'jsInit'=>'Lemur.InitDoc();',
            'docOpen'=>[
                'head'=>[
                    'css'=>[
                        'type'=>'css/%type%.css'],
                    'js'=>[
                        'include'=>'js/include.js',
                        'component'=>'js/component.js',
                        'type'=>'js/%type%.js']]]]
    ];
}
?>