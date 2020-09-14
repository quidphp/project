<?php
declare(strict_types=1);
namespace Project;
use Quid\Site;

// row
// abstract class for a row, all rows will extend this class
abstract class Row extends Site\Row
{
    // config
    protected static array $config = [];
}
?>