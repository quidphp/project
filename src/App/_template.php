<?php
declare(strict_types=1);
namespace Project\App;
use Quid\Base\Html;

// _template
// trait used by all routes which generate an interface
trait _template
{
    // config
    protected static array $configTemplate = [];


    // trigger
    final public function trigger()
    {
        $r = $this->docOpen();
        $html = Html::main($this->main());
        $r .= Html::div($html,'route-wrap');
        $r .= $this->docClose();

        return $r;
    }
}
?>