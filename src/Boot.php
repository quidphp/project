<?php
declare(strict_types=1);
namespace Project;
use Quid\Core;
use Quid\Site;

// boot
// class for booting the application and CMS
class Boot extends Site\Boot
{
    // config
    protected static array $config = [
        'types'=>['app','cms'],
        'version'=>['app'=>'1.0'],
        'lang'=>['en'],
        'service'=>[
            'mailer'=>[Core\Service\PhpMailer::class,['host'=>'smtp.project.com','port'=>587,'username'=>'no-reply@project.com','password'=>'','name'=>'Project']]],
    ];


    // getReplace
    final public function getReplace():array
    {
        $return = parent::getReplace();
        $return['emailFooter'] = $this->lang()->text('email/footer',$return);

        return $return;
    }
}

return [Boot::class,'start'];
?>