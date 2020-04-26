<?php
declare(strict_types=1);
namespace Project;
use Quid\Core;
use Quid\Lemur;

// boot
// class for booting the application and CMS
class Boot extends Lemur\Boot
{
    // config
    public static array $config = [
        'types'=>['app','cms'],
        'version'=>['app'=>'1.0'],
        'lang'=>['en'],

        'service'=>[
            'mailer'=>[Core\Service\PhpMailer::class,['host'=>'smtp.project.com','port'=>587,'username'=>'no-reply@project.com','password'=>'','name'=>'Project']]],

        'compileJs'=>[
            'include'=>[
                'from'=>[
                    1=>'[js]/include']],
            'component'=>[
                'from'=>[
                    3=>'[js]/component']]],

        '@dev'=>[
            'compileJs'=>[
                'test'=>[
                    'from'=>[
                        2=>'[js]/test']]]],

        '@app'=>[
            'service'=>[
                'polyfill'=>Lemur\Service\Polyfill::class],
            'sessionVersionMatch'=>false,

            'compileCss'=>[
                'app'=>[
                    'to'=>'[publicCss]/app.css',
                    'from'=>[
                        0=>'[vendorFront]/css/include',
                        1=>'[vendorFront]/css/component',
                        2=>'[css]/include',
                        3=>'[css]/component',
                        10=>'[css]/app']]],

            'compileJs'=>[
                'app'=>[
                    'to'=>'[publicJs]/app.js',
                    'from'=>[
                        0=>'[vendorFront]/js/import',
                        1=>'[js]/app']]]],

        '@cms'=>[
            'compileCss'=>[
                'cms'=>[
                    'from'=>[
                        3=>'[css]/include',
                        4=>'[css]/component',
                        5=>'[css]/cms-component',
                        10=>'[css]/cms']],
                'tinymce'=>[
                    'from'=>[
                        1=>'[css]/include',
                        10=>'[css]/cms-tinymce']]],

            'compileJs'=>[
                'cms'=>[
                    'from'=>[
                        2=>'[js]/cms']]]]
    ];


    // isApp
    final public function isApp():bool
    {
        return $this->type() === 'app';
    }
}

return [Boot::class,'start'];
?>