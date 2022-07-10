<?php
declare(strict_types=1);
namespace Project\App;
use Quid\Base\Html;
use Quid\Site;

// error
// class for the error route of the app
class Error extends Site\App\Error
{
    // trait
    use _template;


    // config
    protected static array $config = [];


    // main
    final protected function main():string
    {
        return $this->outputHtml();
    }
}
?>