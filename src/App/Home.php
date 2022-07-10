<?php
declare(strict_types=1);
namespace Project\App;
use Quid\Base\Html;
use Quid\Site;

// home
// class for the home route of the app
class Home extends Site\App\Home
{
    // trait
    use _template;


    // config
    protected static array $config = [];


    // main
    final protected function main():string
    {
        return Html::h1('Hello World');
    }
}
?>