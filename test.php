<?php
declare(strict_types=1);
namespace Quid\TestSuite {
use Quid\Test;
use Quid\Core;
use Quid\Orm;
use Quid\Main;
use Quid\Base;

// boot
// class for booting the testsuite (can be deleted)
class Boot extends Core\Boot
{
    // config
    public static $config = [
        'types'=>['assert'],
        'version'=>['assert'=>'1.0.1'],
        'lang'=>['en','fr'],
        'cache'=>false,
        'compile'=>false,
        'speed'=>true,
        'timeLimit'=>30,
        'assert'=>[
            'target'=>true,
            'method'=>'start',
            'overview'=>1,
            'db'=>null,
            'exclude'=>[
                Test\Lemur::class,Test\Site::class],
            'fileSession'=>Core\File\Session::class,
            'lang'=>['fr'=>Core\Lang\Fr::class,'en'=>Core\Lang\En::class],
            'langFile'=>['fr'=>'[assertCommon]/fr.php','en'=>'[assertCommon]/en.php'],
            'truncate'=>['log','logCron','logEmail','logError','logHttp','logSql','queueEmail']],
        'callable'=>[
            'uriOptionImg'=>[Base\Html::class,'setUriOption','img',['append'=>false,'exists'=>false]],
            'uriOptionLink'=>[Base\Html::class,'setUriOption','link',['append'=>false,'exists'=>false]],
            'uriOptionScript'=>[Base\Html::class,'setUriOption','script',['append'=>false,'exists'=>false]],
            'uriOptionStyle'=>[Base\Style::class,'setUriOption',['append'=>false,'exists'=>false]],
            'errorHtmlDepth'=>[Core\Error::class,'setDefaultHtmlDepth',true],
            'dbHistory'=>[Core\Db::class,'setDefaultHistory',true],
            'mailerDispatch'=>[Main\ServiceMailer::class,'setDispatch','queue'],
            'ormExceptionQuery'=>[Orm\Exception::class,'showQuery',true],
            'ormCatchableExceptionQuery'=>[Orm\CatchableException::class,'showQuery',true]],
        'dbOption'=>[
            'tables'=>[
                'ormTable'=>['test'=>'ok']],
            'cols'=>[
                'active'=>['label'=>['col','label','*','active'],'priority'=>35],
                'email'=>['class'=>Core\Col\Email::class,'default'=>'default@def.james','search'=>false,'required'=>true]]],
        'sessionOption'=>[
            'userDefault'=>2],
        'uriShortcut'=>[
            'assertMedia'=>'[media]/assert'],
        'finderShortcut'=>[
            'assert'=>'[storagePrivate]/assert',
            'assertCommon'=>'[assert]/common',
            'assertCurrent'=>'[assert]/current',
            'assertStorage'=>'[storagePublic]/storage',
            'assertMedia'=>'[storagePublic]/media/assert'],
        'config'=>[
            Core\Table::class=>[
                'order'=>['id'=>'desc'],
                'relation'=>['appendPrimary'=>true]],
            Core\Col::class=>[
                'generalExcerptMin'=>100],
            Core\Row\User::class=>[
                'crypt'=>[
                    'passwordHash'=>['options'=>['cost'=>4]]]],
            Core\Role\Nobody::class=>[
                'can'=>[
                    'login'=>['assert'=>false]],
                'db'=>[
                    'user'=>['alter'=>true,'insert'=>true,'delete'=>true]]],
            Core\Role\Shared::class=>[
                'ignore'=>false,
                'can'=>[
                    'login'=>['assert'=>false]]],
            Core\Role\User::class=>[
                'ignore'=>false,
                'can'=>[
                    'login'=>['assert'=>true]]],
            Core\Role\Admin::class=>[
                'can'=>[
                    'login'=>['assert'=>true]],
                'db'=>[
                    'user'=>['alter'=>true],
                    'page'=>['truncate'=>true],
                    'ormDb'=>['truncate'=>true],
                    'ormCells'=>['truncate'=>true],
                    'ormCell'=>['truncate'=>true],
                    'ormCol'=>['truncate'=>true],
                    'ormCols'=>['truncate'=>true],
                    'ormRow'=>['truncate'=>true],
                    'ormRows'=>['truncate'=>true],
                    'ormRowsIndex'=>['truncate'=>true],
                    'ormSql'=>['truncate'=>true],
                    'ormTable'=>['truncate'=>true],
                    'ormTables'=>['truncate'=>true],
                    'ormTableSibling'=>['truncate'=>true]]]],
        'service'=>[
            'ldap'=>[Core\Service\Ldap::class,['host'=>'james.com','port'=>388]],
            'mailer'=>[Core\Service\PhpMailer::class,['host'=>'smtp.james.com','port'=>587,'encryption'=>'tls','username'=>'james@james.com','password'=>'james','name'=>'James']]],
        '@dev'=>[
            'callable'=>[
                'uriOptionImg'=>[Base\Html::class,'setUriOption','img',['append'=>false,'exists'=>false]],
                'uriOptionLink'=>[Base\Html::class,'setUriOption','link',['append'=>false,'exists'=>false]],
                'uriOptionScript'=>[Base\Html::class,'setUriOption','script',['append'=>false,'exists'=>false]],
                'uriOptionStyle'=>[Base\Style::class,'setUriOption',['append'=>false,'exists'=>false]],
                'errorHtmlDepth'=>[Core\Error::class,'setDefaultHtmlDepth',true],
                'dbHistory'=>[Core\Db::class,'setDefaultHistory',true],
                'mailerDispatch'=>[Main\ServiceMailer::class,'setDispatch','queue'],
                'ormExceptionQuery'=>[Orm\Exception::class,'showQuery',true],
                'ormCatchableExceptionQuery'=>[Orm\CatchableException::class,'showQuery',true]]]
    ];


    // launch
    public function launch():Core\Boot
    {
        $this->beforeAssert();

        $target = $this->attr('assert/target');
        $exclude = $this->attr('assert/exclude');
        if($target === true)
        {
            $closure = function(string $value) {
                return (stripos($value,'quid\\test') === 0)? true:false;
            };
            $target = array_keys(Base\Autoload::allPsr4($closure,true));

            if(!empty($exclude))
            $target = Base\Arr::valuesStrip($exclude,$target);
        }

        if(!empty($target))
        {
            $method = $this->attr('assert/method');
            $data = ['boot'=>$this];
            $classes = Main\Autoload::findOneOrMany($target,true,true,true);

            if(!empty($exclude))
            $classes = Base\Arr::valuesStrip($exclude,$classes);

            foreach ($classes as $key => $class)
            {
                if(!is_a($class,Base\Test::class,true))
                unset($classes[$key]);
            }

            $array = Base\Call::staticClasses($classes,$method,$data);

            Base\Debug::var($array);
            Base\Debug::var(Base\Number::addition(...array_values($array)));
        }

        $overview = $this->attr('assert/overview');
        if(!empty($overview))
        {
            Base\Debug::var(Base\Server::overview());

            if($overview === true || $overview > 1)
            {
                $closure = function(string $value) {
                    return (stripos($value,'quid') === 0 && stripos($value,'quid\\test') !== 0)? true:false;
                };
                $autoload = Base\Autoload::overview($closure,true);
                Base\Debug::var($autoload);
                $lines = Base\Column::value('line',$autoload);
                Base\Debug::var(Base\Number::addition(...$lines));

                if($overview === true || $overview > 2)
                Base\Debug::var(Base\Autoload::all());
            }
        }

        $this->afterAssert();

        return $this;
    }


    // beforeAssert
    public function beforeAssert():void
    {
        Base\Response::ok();
        Base\Timezone::set('America/New_York',true);

        Base\Dir::empty('[assertCommon]');
        Base\Dir::empty('[assertCurrent]');
        Base\Dir::empty('[assertMedia]');
        Base\Dir::empty('[assertStorage]');

        foreach (static::assertCommon64() as $basename => $value)
        {
            $path = '[assertCommon]/'.$basename;
            $decode = Base\Crypt::base64Decode($value);
            Base\File::set($path,$decode);
        }

        Base\Dir::copy('[assertMedia]','[assertCommon]');

        $db = $this->attr('db');
        if(is_array($db))
        $this->setAttr('assert/db',$db);

        $lang = $this->lang();
        $session = $this->session();
        $session->setUserDefault();

        $fr = $this->attr('assert/langFile/fr');
        $session->setLang('fr');
        $lang->replace($fr);

        $en = $this->attr('assert/langFile/en');
        $session->setLang('en');
        $lang->replace($en);
        $array = ['relation/contextType/assert'=>'Content management system'];
        $lang->replace($array);

        return;
    }


    // afterAssert
    public function afterAssert():void
    {
        Base\Dir::emptyAndUnlink('[assert]');
        Base\Dir::emptyAndUnlink('[assertStorage]');
        Base\Dir::emptyAndUnlink('[storageLog]');
        Base\Dir::emptyAndUnlink('[storage]/session');

        $truncate = $this->attr('assert/truncate');
        if(is_array($truncate))
        {
            $db = $this->db();
            $tables = $db->tables()->gets(...$truncate);
            $tables->truncate();
        }

        Base\Response::emptyCloseDown();

        return;
    }


    // nameFromClass
    public static function nameFromClass():string
    {
        return 'Assert';
    }


    // assertCommon64
    protected static function assertCommon64():array
    {
        return [
            'class.php' => 'PD9waHAKZGVjbGFyZShzdHJpY3RfdHlwZXM9MSk7Cm5hbWVzcGFjZSBRdWlkXEJhc2VcVGVzdDsKdXNlIFF1aWRcQmFzZTsKCi8vIGZpbGUKY2xhc3MgRmlsZSBleHRlbmRzIEJhc2VcVGVzdAp7CgkvLyB0cmlnZ2VyCglwdWJsaWMgc3RhdGljIGZ1bmN0aW9uIHRyaWdnZXIoYXJyYXkgJGRhdGEpOmJvb2wKCXsKCQkvLyBwcmVwYXJlCgkJJG1lZGlhSnBnID0gIltwdWJsaWNdL21lZGlhL2pwZy5qcGciOwoJCSRtZWRpYVZlY3RvciA9ICJbcHVibGljXS9tZWRpYS9zdmcuc3ZnIjsKCQkkbWVkaWFDc3YgPSAiW3B1YmxpY10iLiIvbWVkaWEvY3N2LmNzdiI7CgkJJHByaXZhdGVQYXRoID0gQmFzZVxGaW5kZXI6OnNob3J0Y3V0KCdbcHJpdmF0ZV0nKTsKCQkkc3RvcmFnZVBhdGggPSBCYXNlXEZpbmRlcjo6c2hvcnRjdXQoJ1tzdG9yYWdlXScpOwoJCSRzdG9yYWdlID0gIlthc3NlcnRDdXJyZW50XSI7CgkJJGNvbW1vbiA9ICJbYXNzZXJ0Q29tbW9uXSI7CgkJJGN1cnJlbnRGaWxlID0gQmFzZVxGaW5kZXI6OnBhdGgoIlthc3NlcnRDb21tb25dL2NsYXNzLnBocCIpOwoJCWFzc2VydChCYXNlXERpcjo6cmVzZXQoJHN0b3JhZ2UpKTsKCQkkdG1wID0gdG1wZmlsZSgpOwoJCSRfZmlsZV8gPSBCYXNlXEZpbmRlcjo6c2hvcnRjdXQoIlthc3NlcnRDb21tb25dL2NsYXNzLnBocCIpOwoJCSRfZGlyXyA9IGRpcm5hbWUoJF9maWxlXyk7CgkJJHRlbXAgPSBCYXNlXEZpbGU6OnByZWZpeCgiW2Fzc2VydEN1cnJlbnRdIik7CgkJJG9wZW4gPSBCYXNlXFJlczo6b3BlbigkY3VycmVudEZpbGUpOwoJCSRkaXIgPSBCYXNlXFJlczo6b3BlbigkX2Rpcl8pOwoJCSRzeW0gPSBCYXNlXFN5bWxpbms6OnNldCgkY3VycmVudEZpbGUsIlthc3NlcnRDdXJyZW50XS9zeW0iKTsKCQkkd3JpdGUgPSAiW2Fzc2VydEN1cnJlbnRdL3NwbGljZS50eHQiOwoJCSRzdG9yYWdlID0gIlthc3NlcnRDdXJyZW50XSI7CgkJJGFycmF5ID0gQmFzZVxGaWxlOjptYWtlVXBsb2FkQXJyYXkoJGN1cnJlbnRGaWxlKTsKCQkKCQkvLyBpcwoJCWFzc2VydChCYXNlXEZpbGU6OmlzKCRjdXJyZW50RmlsZSkpOwoJCWFzc2VydChCYXNlXEZpbGU6OmlzKCR0ZW1wKSk7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXMoJHRtcCkpOwoJCWFzc2VydCghQmFzZVxGaWxlOjppcygiW2Fzc2VydEN1cnJlbnRdIikpOwoJCWFzc2VydChCYXNlXEZpbGU6OmlzKCRhcnJheSkpOwoKCQkvLyBpc1JlYWRhYmxlCgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNSZWFkYWJsZSgkY3VycmVudEZpbGUpKTsKCQlhc3NlcnQoQmFzZVxGaWxlOjppc1JlYWRhYmxlKCRjdXJyZW50RmlsZSkpOwoJCWFzc2VydChCYXNlXEZpbGU6OmlzUmVhZGFibGUoJG9wZW4pKTsKCQlhc3NlcnQoQmFzZVxGaWxlOjppc1JlYWRhYmxlKCR0bXApKTsKCQlhc3NlcnQoQmFzZVxGaWxlOjppc1JlYWRhYmxlKCRhcnJheSkpOwoKCQkvLyBpc1dyaXRhYmxlCgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNXcml0YWJsZSgkdGVtcCkpOwoJCWFzc2VydChCYXNlXEZpbGU6OmlzV3JpdGFibGUoJHRtcCkpOwoKCQkvLyBpc0V4ZWN1dGFibGUKCQlhc3NlcnQoIUJhc2VcRmlsZTo6aXNFeGVjdXRhYmxlKCR0ZW1wKSk7CgoJCS8vIGlzRW1wdHkKCQkkZW1wdHkgPSAiJHN0b3JhZ2UvZW1wdHkucGhwIjsKCQlhc3NlcnQoQmFzZVxGaWxlOjpzZXQoJGVtcHR5LCIiKSk7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNFbXB0eSgkdGVtcCkpOwoJCWFzc2VydCghQmFzZVxGaWxlOjppc0VtcHR5KCRjdXJyZW50RmlsZSkpOwoJCWFzc2VydCghQmFzZVxGaWxlOjppc0VtcHR5KCRvcGVuKSk7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNFbXB0eSgkdG1wKSk7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNFbXB0eSgkZW1wdHkpKTsKCgkJLy8gaXNOb3RFbXB0eQoJCWFzc2VydCghQmFzZVxGaWxlOjppc05vdEVtcHR5KCR0ZW1wKSk7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNOb3RFbXB0eSgkY3VycmVudEZpbGUpKTsKCQlhc3NlcnQoQmFzZVxGaWxlOjppc05vdEVtcHR5KCRvcGVuKSk7CgkJYXNzZXJ0KCFCYXNlXEZpbGU6OmlzTm90RW1wdHkoJHRtcCkpOwoJCWFzc2VydChCYXNlXEZpbGU6OmlzTm90RW1wdHkoJGFycmF5KSk7CgoJCS8vIGlzVXBsb2FkZWQKCQlhc3NlcnQoIUJhc2VcRmlsZTo6aXNVcGxvYWRlZCgkdGVtcCkpOwoJCWFzc2VydCghQmFzZVxGaWxlOjppc1VwbG9hZGVkKCRjdXJyZW50RmlsZSkpOwoJCWFzc2VydCghQmFzZVxGaWxlOjppc1VwbG9hZGVkKCR0bXApKTsKCQlhc3NlcnQoIUJhc2VcRmlsZTo6aXNVcGxvYWRlZCgkYXJyYXkpKTsKCgkJLy8gaXNVcGxvYWRBcnJheQoJCWFzc2VydChCYXNlXEZpbGU6OmlzVXBsb2FkQXJyYXkoYXJyYXkoJ25hbWUnPT4nJywndHlwZSc9PicnLCd0bXBfbmFtZSc9PicnLCdlcnJvcic9PjEsJ3NpemUnPT4wKSxhcnJheSgnbmFtZSc9PicnLCd0eXBlJz0+JycsJ3RtcF9uYW1lJz0+JycsJ2Vycm9yJz0+MSwnc2l6ZSc9PjApKSk7CgkJYXNzZXJ0KCFCYXNlXEZpbGU6OmlzVXBsb2FkQXJyYXkoYXJyYXkoJ25hbWV6Jz0+JycsJ3R5cGUnPT4nJywndG1wX25hbWUnPT4nJywnZXJyb3InPT4xLCdzaXplJz0+MCkpKTsKCQlhc3NlcnQoIUJhc2VcRmlsZTo6aXNVcGxvYWRBcnJheShhcnJheSgnbmFtZSc9PicnLCd0eXBlJz0+JycsJ3RtcF9uYW1lJz0+JycsJ2Vycm9yJz0+MSwnc2l6ZSc9PjApLGFycmF5KCduYW16ZSc9PicnLCd0eXBlJz0+JycsJ3RtcF9uYW1lJz0+JycsJ2Vycm9yJz0+MSwnc2l6ZSc9PjApKSk7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNVcGxvYWRBcnJheSgkYXJyYXkpKTsKCgkJLy8gaXNVcGxvYWRFbXB0eU5vdEVtcHR5CgoJCS8vIGlzVXBsb2FkRW1wdHkKCQkkZmlsZSA9IGFycmF5KCduYW1lJz0+JycsJ3R5cGUnPT4nJywndG1wX25hbWUnPT4nJywnZXJyb3InPT40LCdzaXplJz0+MCk7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNVcGxvYWRFbXB0eSgkZmlsZSkpOwoKCQkvLyBpc1VwbG9hZE5vdEVtcHR5CgkJJGZpbGUgPSBhcnJheSgnbmFtZSc9PicnLCd0eXBlJz0+JycsJ3RtcF9uYW1lJz0+JycsJ2Vycm9yJz0+NCwnc2l6ZSc9PjApOwoJCWFzc2VydCghQmFzZVxGaWxlOjppc1VwbG9hZE5vdEVtcHR5KCRmaWxlKSk7CgkJJGZpbGUgPSBhcnJheSgnbmFtZSc9PicnLCd0eXBlJz0+JycsJ3RtcF9uYW1lJz0+JycsJ2Vycm9yJz0+Miwnc2l6ZSc9PjIpOwoJCWFzc2VydChCYXNlXEZpbGU6OmlzVXBsb2FkTm90RW1wdHkoJGZpbGUpKTsKCgkJLy8gaXNVcGxvYWRUb29CaWcKCQkkZmlsZSA9IGFycmF5KCduYW1lJz0+JycsJ3R5cGUnPT4nJywndG1wX25hbWUnPT4nJywnZXJyb3InPT4yLCdzaXplJz0+Mik7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNVcGxvYWRUb29CaWcoJGZpbGUpKTsKCQkkZmlsZSA9IGFycmF5KCduYW1lJz0+JycsJ3R5cGUnPT4nJywndG1wX25hbWUnPT4nJywnZXJyb3InPT4xLCdzaXplJz0+Mik7CgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNVcGxvYWRUb29CaWcoJGZpbGUpKTsKCQkkZmlsZSA9IGFycmF5KCduYW1lJz0+JycsJ3R5cGUnPT4nJywndG1wX25hbWUnPT4nJywnZXJyb3InPT4zLCdzaXplJz0+Mik7CgkJYXNzZXJ0KCFCYXNlXEZpbGU6OmlzVXBsb2FkVG9vQmlnKCRmaWxlKSk7CgoJCS8vIGlzTG9hZGVkCgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNMb2FkZWQoX19GSUxFX18pKTsKCQlhc3NlcnQoIUJhc2VcRmlsZTo6aXNMb2FkZWQoJHRtcCkpOwoJCWFzc2VydCghQmFzZVxGaWxlOjppc0xvYWRlZCgkdGVtcCkpOwoKCQkvLyBpc1Jlc291cmNlCgkJYXNzZXJ0KEJhc2VcRmlsZTo6aXNSZXNvdXJjZSgkb3BlbikpOwoJCWFzc2VydCghQmFzZVxGaWxlOjppc1Jlc291cmNlKCRjdXJyZW50RmlsZSkpOwoKCQkvLyBpc01pbWVHcm91cAoJCWFzc2VydChCYXNlXEZpbGU6OmlzTWltZUdyb3VwKCd0ZXh0JywkY3VycmVudEZpbGUpKTsKCQlhc3NlcnQoIUJhc2VcRmlsZTo6aXNNaW1lR3JvdXAoJ3RleHQnLCR0bXApKTsKCQlhc3NlcnQoQmFzZVxGaWxlOjppc01pbWVHcm91cCgndGV4dCcsJGFycmF5KSk7CgkJCgkJcmV0dXJuIHRydWU7Cgl9Cn0KPz4=',

            'csv.csv' => 'SXRlbSBDb2RlO09MRCBTS1U7VmFyaWF0aW9uIE5hbWU7UGFyZW50IFNLVTtJbXByb3Zpc2luZztzb2xkIGluIHBhaXJzO0NPTExFQ1RJT047VURGX1BST0RVQ19ESU1FTlNJT05TO1ZvbHVtZTtTaGlwV2VpZ2h0OyBTb21lcnRvbiBQcmljaW5nIChSZXRhaWwpOyBEZWxpdmVyeSBTdXJjaGFyZ2UgDQoxNXYzLTAxOzs7Ozs7c2RhYW47MjMtMy80JydEIHggMTYnJ0QgeCAyMycnSDs0LDk0OzQyLDk5OyAkCTE5OSwwMCA7ICQJNDksMDAgDQoxNXgzLTAyOzs7Ozs7TWlsYW47MjcnJ1cgeCAyNCcnRCB4IDI0JydIOzYsOTg7NjIsODM7IiAkCQ0KMjk5LDAwIjsgJAk0OSwwMCANCjE1MGEtMDQ7Ozs7OztNaXdxZWFuOzQ2JydXIHggMjgnJ0QgeCAxOScnSDsxMCw5NTs5OSwyMTsgJAkzNTksMDAgOyAkCTQ5LDAwIA0KMTUxLTA1Ozs7Ozs7TXNhZGxhbjs1MScnVyB4IDE5JydEIHggMjgnJ0g7OSwzNjs4Myw3ODsgJAkzNTksMDAgOyAkCTQ5LDAwIA0KMTVyLTE4Ozs7Ozs7TWlzYWRuOzM4JydXIHggMzgnJ0QgeCAxOScnSDsxMCw5MjsxMDQsNzI7ICQJNDU5LDAwIDsgJAk0OSwwMCANCjFxMy0yOTs7Ozs7O01pbHp4Y247NjAnJ1cgeCAyMCcnRCB4IDI4LTEvMicnSDsyNiwzNzsxNTcsNjM7ICQJNzk5LDAwIDsgJAk3OSwwMCANCjE1ei0zMDs7Ozs7O3pjeGxhbjs0NicnVyB4IDE4JydEIHggMjQtMS8yJydIOzYsMjs1NSwxMjsgJAkyNTksMDAgOyAkCTQ5LDAwIA0KMXczLTM2OzE1My0zNlgyOzs7O3g7TWlsYW47MjAtMS8yJydXIHggMjQnJ0QgeCA0MycnSDszLDczOzI4LDY2OyAkCTE3NSwwMCA7ICQJNDksMDAgDQoxejMtMzg7MTUzLTM4WDI7Ozs7eDtNaWxhbjsxOS0xLzInJ1cgeCAyMy0xLzInJ0QgeCA0MycnSDszLDg0OzI5LDc2OyAkCTE4MCwwMCA7ICQJNDksMDAgDQo7Ozs7Ozs7Ozs7Ow0KOzs7Ozs7Ozs7OzsNCjs7Ozs7Ozs7Ozs7DQo7Ozs7Ozs7Ozs7Ow0KOzs7Ozs7Ozs7Ozs=',

            'en.php' => 'PD9waHAgCnJldHVybiBhcnJheSgKCS8vIGxhYmVsCgknbGFiZWwnPT4nQXNzZXJ0JywKCQoJLy8gZGVzY3JpcHRpb24KCSdkZXNjcmlwdGlvbic9PidEZXNjciBCb290JywKCQoJLy8gdGFibGUKCSd0YWJsZSc9PmFycmF5KAoJCQoJCS8vIGxhYmVsCgkJJ2xhYmVsJz0+YXJyYXkoCgkJCSdvcm1Db2wnPT4nTWVoJywKCQkJJ29ybUNvbHMnPT4nTWVoJywKCQkJJ29ybUNlbGwnPT4nTWVoJywKCQkJJ29ybUNlbGxzJz0+J01laCcsCgkJCSdvcm1Sb3cnPT4nT3JtIFJvdycsCgkJCSdvcm1Sb3dzJz0+J01laCcsCgkJCSdvcm1UYWJsZSc9PidTdXBlciBPcm0gRW4nCgkJKSwKCQkKCQkvLyBkZXNjcmlwdGlvbgoJCSdkZXNjcmlwdGlvbic9PmFycmF5KAoJCQknb3JtVGFibGUnPT4nU3VwZXIgT3JtIERlc2MgRW4nCgkJKQoJKSwKCQoJLy8gZXhjZXB0aW9uCgknZXhjZXB0aW9uJz0+YXJyYXkoCgkJJ2V4Y2VwdGlvbic9PmFycmF5KAoJCQknY2FSb3VsZSc9PidXaGF0ICEhISBbMV0gWzJdIFszXSBbNF0nCgkJKQoJKSwKCQoJLy8gY29sCgknY29sJz0+YXJyYXkoCgkJCgkJLy8gbGFiZWwKCQknbGFiZWwnPT5hcnJheSgKCQkJCgkJCS8vICoKCQkJJyonPT5hcnJheSgKCQkJCSdpbnRlZ2VyJz0+J0ludGVnZXInLAoJCQkJJ2VudW0nPT4nZW51bScsCgkJCQknc2V0Jz0+J3NldCcsCgkJCQkndGh1bWJuYWlscyc9Pid0aHVtYm5haWxzJywKCQkJCSd0ZXN0X29rJz0+J3Rlc3Rfb2snLAoJCQkJJ211bHRpJz0+J211bHRpJywKCQkJCSdjaGVjayc9PidjaGVjaycsCgkJCQkncmVsYXRpb25SYW5nZSc9PidSYW5nZScsCgkJCQknbXlSZWxhdGlvbic9PidNeSByZWxhdGlvbicKCQkJKQoJCSksCgkJCgkJLy8gZGVzY3JpcHRpb24KCQknZGVzY3JpcHRpb24nPT5hcnJheSgKCQkJCgkJCS8vICoKCQkJJyonPT5hcnJheSgKCQkJCSdkYXRlQWRkJz0+J1BlcmZlY3QnCgkJCSkKCQkpCgkpLAoJCgkvLyByZWxhdGlvbgoJJ3JlbGF0aW9uJz0+YXJyYXkoCgkJCgkJJ3Rlc3QnPT5hcnJheSgKCQkJMj0+J29rZW4nLAoJCQkzPT4nd2xsZWwnLAoJCQk1PT4nYmxhJwoJCSkKCSksCgkKCS8vIHBsdXJhbAoJJ3BsdXJhbCc9PmFycmF5KAoJCTE9Pid0ZXN0JXMlIG9rJXMlJywKCQkyPT4ndGVzdGEnCgkpLAoJCgkvLyBjb20KCSdjb20nPT5hcnJheSgKCQknbmVnJz0+YXJyYXkoCgkJCSdpbnNlcnQnPT5hcnJheSgKCQkJCSdvcm1UYWJsZSc9PmFycmF5KAoJCQkJCSdmYWlsdXJlJz0+J05PUENIQU5HRScKCQkJCSkKCQkJKQoJCSksCgkJCgkJJ3Bvcyc9PmFycmF5KAoJCQkndXBkYXRlJz0+YXJyYXkoCgkJCQknb3JtUm93Jz0+YXJyYXkoCgkJCQkJJ25vQ2hhbmdlJz0+J05PUENIQU5HRScKCQkJCSkKCQkJKQoJCSkKCSkKKTsKPz4=',

            'fr.php' => 'PD9waHAgCnJldHVybiBhcnJheSgKCS8vIGxhYmVsCgknbGFiZWwnPT4nQXNzZXJ0aW9uJywKCQoJLy8gZGVzY3JpcHRpb24KCSdkZXNjcmlwdGlvbic9PidEZXNjciBCb290JywKCQoJLy8gZGIKCSdkYic9PmFycmF5KAoJCQoJCS8vIGxhYmVsCgkJJ2xhYmVsJz0+YXJyYXkoCgkJCSdhc3NlcnQnPT4nV2VsbCcKCQkpLAoJCQoJCS8vIGRlc2NyaXB0aW9uCgkJJ2Rlc2NyaXB0aW9uJz0+YXJyYXkoCgkJCSdhc3NlcnQnPT4nT0snCgkJKQoJKSwKCQoJLy8gdGFibGUKCSd0YWJsZSc9PmFycmF5KAoJCQoJCS8vIGxhYmVsCgkJJ2xhYmVsJz0+YXJyYXkoCgkJCSdvcm1Db2wnPT4nTWVoJywKCQkJJ29ybUNvbHMnPT4nTWVoJywKCQkJJ29ybUNlbGwnPT4nTWVoJywKCQkJJ29ybUNlbGxzJz0+J01laCcsCgkJCSdvcm1Sb3cnPT4nT3JtIFJvdycsCgkJCSdvcm1Sb3dzJz0+J01laCcsCgkJCSdvcm1UYWJsZSc9PidTdXBlciBPcm0gRnInCgkJKQoJKSwKCQoJLy8gY29sCgknY29sJz0+YXJyYXkoCgkJCgkJLy8gbGFiZWwKCQknbGFiZWwnPT5hcnJheSgKCQkJCgkJCS8vICoKCQkJJyonPT5hcnJheSgKCQkJCSdpbnRlZ2VyJz0+J0ludGVnZXInLAoJCQkJJ2VudW0nPT4nZW51bScsCgkJCQkndGVzdF9vayc9Pid0ZXN0X29rJwoJCQkpCgkJKSwKCQkKCQkvLyBkZXNjcmlwdGlvbgoJCSdkZXNjcmlwdGlvbic9PmFycmF5KAoJCQkKCQkJLy8gKgoJCQknKic9PmFycmF5KAoJCQkJJ2RhdGVBZGQnPT4nUGFyZmFpdCcKCQkJKQoJCSkKCSksCgkKCS8vIHJlbGF0aW9uCgkncmVsYXRpb24nPT5hcnJheSgKCQkKCQkndGVzdCc9PmFycmF5KAoJCQkyPT4nb2tmcicsCgkJCTM9Pid3bGxlbCcsCgkJCTU9PidibGEnCgkJKQoJKSwKCQoJLy8gcGx1cmFsCgkncGx1cmFsJz0+YXJyYXkoCgkJMT0+J3Rlc3QlcyUgb2slcyUnLAoJCTI9Pid0ZXN0YScKCSkKKTsKPz4=',

            'hash#.php' => 'bG9yZW0gaXBzdW0gbG9yZW0gaXBzdW0=',

            'jpg.jpg' => '/9j/4AAQSkZJRgABAQEAEgASAAD/4QCURXhpZgAATU0AKgAAAAgABQEaAAUAAAABAAAASgEbAAUAAAABAAAAUgEoAAMAAAABAAIAAAEyAAIAAAAUAAAAWodpAAQAAAABAAAAbgAAAAAAAAASAAAAAQAAABIAAAABMjAxOTowNzoxOSAxNTo1MDo1MgAAAqACAAMAAAABAAIAAKADAAMAAAABAAIAAAAAAAD/4QrSaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJYTVAgQ29yZSA1LjUuMCI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiIHhtcDpNb2RpZnlEYXRlPSIyMDE5LTA3LTE5VDE1OjUwOjUyKzAyOjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDE5LTA3LTE5VDE1OjUwOjUyKzAyOjAwIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0icHJvZHVjZWQiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFmZmluaXR5IFBob3RvIChKdW4gMTYgMjAxOSkiIHN0RXZ0OndoZW49IjIwMTktMDctMTlUMTU6NTA6NTIrMDI6MDAiLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDw/eHBhY2tldCBlbmQ9InciPz7/7QAsUGhvdG9zaG9wIDMuMAA4QklNBCUAAAAAABDUHYzZjwCyBOmACZjs+EJ+/+ICZElDQ19QUk9GSUxFAAEBAAACVGxjbXMEMAAAbW50clJHQiBYWVogB+MABwATAA0ALwAdYWNzcEFQUEwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPbWAAEAAAAA0y1sY21zAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALZGVzYwAAAQgAAAA+Y3BydAAAAUgAAABMd3RwdAAAAZQAAAAUY2hhZAAAAagAAAAsclhZWgAAAdQAAAAUYlhZWgAAAegAAAAUZ1hZWgAAAfwAAAAUclRSQwAAAhAAAAAgZ1RSQwAAAhAAAAAgYlRSQwAAAhAAAAAgY2hybQAAAjAAAAAkbWx1YwAAAAAAAAABAAAADGVuVVMAAAAiAAAAHABzAFIARwBCACAASQBFAEMANgAxADkANgA2AC0AMgAuADEAAG1sdWMAAAAAAAAAAQAAAAxlblVTAAAAMAAAABwATgBvACAAYwBvAHAAeQByAGkAZwBoAHQALAAgAHUAcwBlACAAZgByAGUAZQBsAHlYWVogAAAAAAAA9tYAAQAAAADTLXNmMzIAAAAAAAEMQgAABd7///MlAAAHkwAA/ZD///uh///9ogAAA9wAAMBuWFlaIAAAAAAAAG+gAAA49QAAA5BYWVogAAAAAAAAJJ8AAA+EAAC2w1hZWiAAAAAAAABilwAAt4cAABjZcGFyYQAAAAAAAwAAAAJmZgAA8qcAAA1ZAAAT0AAACltjaHJtAAAAAAADAAAAAKPXAABUewAATM0AAJmaAAAmZgAAD1z/2wBDAFA3PEY8MlBGQUZaVVBfeMiCeG5uePWvuZHI////////////////////////////////////////////////////2wBDAVVaWnhpeOuCguv/////////////////////////////////////////////////////////////////////////wAARCAACAAIDAREAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwC7QB//2Q==',

            'json.json' => 'WzEsMiwzXQ==',

            'load.php' => 'PD9waHAgCmRlY2xhcmUoc3RyaWN0X3R5cGVzPTEpOwoKJGEgPSA0MjsKJGIgPSAnYyc7CgppZighZW1wdHkoJGphbWVzKSkKJGEgPSAkamFtZXM7CgpyZXR1cm4gYXJyYXkoJ3Rlc3QnPT4kYSwnYic9PidhJyk7Cj8+',

            'pdf.pdf' => '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IWfLnEq0GNnUHCjymEO+vo8r66RDVbysXXldm5KQHudrxyvtoOSAHky5UZy1E6POyK740yNaOGM97CyZZbNiYl+cS7VkHLOx+4u7IjC54EII7mzVApCd3HkLAejaE0UE8hhUnkffw9fkk55WDPrxrTmDkvwczdMhOowKm8coIwvAHy3/U/jYs7PzubnB2dKFy6X18yvLB0v4Xwz6DxIDaOAKZW5kc3RyZWFtCmVuZG9iagoxNCAwIG9iagoyNDcxCmVuZG9iagoxNSAwIG9iagooU2FucyB0aXRyZSkKZW5kb2JqCjE2IDAgb2JqCihNYWMgT1MgWCAxMC4xMi42IFF1YXJ0eiBQREZDb250ZXh0KQplbmRvYmoKMTcgMCBvYmoKKFBpZXJyZS1QaGlsaXBwZSBFbW9uZCkKZW5kb2JqCjE4IDAgb2JqCigpCmVuZG9iagoxOSAwIG9iagooUGFnZXMpCmVuZG9iagoyMCAwIG9iagooRDoyMDE4MDQwODE5NDkxOVowMCcwMCcpCmVuZG9iagoyMSAwIG9iagooKQplbmRvYmoKMjIgMCBvYmoKWyAoKSBdCmVuZG9iagoxIDAgb2JqCjw8IC9UaXRsZSAxNSAwIFIgL0F1dGhvciAxNyAwIFIgL1N1YmplY3QgMTggMCBSIC9Qcm9kdWNlciAxNiAwIFIgL0NyZWF0b3IKMTkgMCBSIC9DcmVhdGlvbkRhdGUgMjAgMCBSIC9Nb2REYXRlIDIwIDAgUiAvS2V5d29yZHMgMjEgMCBSIC9BQVBMOktleXdvcmRzCjIyIDAgUiA+PgplbmRvYmoKeHJlZgowIDIzCjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwNjc0OSAwMDAwMCBuIAowMDAwMDAwMjUzIDAwMDAwIG4gCjAwMDAwMDMyMjQgMDAwMDAgbiAKMDAwMDAwMDAyMiAwMDAwMCBuIAowMDAwMDAwMjM0IDAwMDAwIG4gCjAwMDAwMDAzNTcgMDAwMDAgbiAKMDAwMDAwMzE4OSAwMDAwMCBuIAowMDAwMDAzMzU3IDAwMDAwIG4gCjAwMDAwMDA0NTQgMDAwMDAgbiAKMDAwMDAwMzE2OCAwMDAwMCBuIAowMDAwMDAzMzA3IDAwMDAwIG4gCjAwMDAwMDM2NTIgMDAwMDAgbiAKMDAwMDAwMzkxOCAwMDAwMCBuIAowMDAwMDA2NDc5IDAwMDAwIG4gCjAwMDAwMDY1MDAgMDAwMDAgbiAKMDAwMDAwNjUyOSAwMDAwMCBuIAowMDAwMDA2NTgyIDAwMDAwIG4gCjAwMDAwMDY2MjIgMDAwMDAgbiAKMDAwMDAwNjY0MSAwMDAwMCBuIAowMDAwMDA2NjY1IDAwMDAwIG4gCjAwMDAwMDY3MDcgMDAwMDAgbiAKMDAwMDAwNjcyNiAwMDAwMCBuIAp0cmFpbGVyCjw8IC9TaXplIDIzIC9Sb290IDExIDAgUiAvSW5mbyAxIDAgUiAvSUQgWyA8NmUyYTExOGZiODJhMDNhMWFhZGNjZmNmZDhhM2JmOTE+Cjw2ZTJhMTE4ZmI4MmEwM2ExYWFkY2NmY2ZkOGEzYmY5MT4gXSA+PgpzdGFydHhyZWYKNjkyNAolJUVPRgo=',

            'php.php' => 'bG9yZW0gaXBzdW0gbG9yZW0gaXBzdW0=',

            'png.png' => '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',

            'svg.svg' => 'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMjAgNTEyIj48cGF0aCBmaWxsPSIjRkZGIiBkPSJNMTc3IDE1OS43bDEzNiAxMzZjOS40IDkuNCA5LjQgMjQuNiAwIDMzLjlsLTIyLjYgMjIuNmMtOS40IDkuNC0yNC42IDkuNC0zMy45IDBMMTYwIDI1NS45bC05Ni40IDk2LjRjLTkuNCA5LjQtMjQuNiA5LjQtMzMuOSAwTDcgMzI5LjdjLTkuNC05LjQtOS40LTI0LjYgMC0zMy45bDEzNi0xMzZjOS40LTkuNSAyNC42LTkuNSAzNC0uMXoiLz48L3N2Zz4=',

            'zip.zip' => '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',

            'ttf.ttf' => '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BfYEYgRaBFgELQPNA5gDHwKoAlgCVgJQAecBpAGJAWABLQErASEBGwEZAQoBBgD8APYA9ADyAOwA6QDlAOMA4QDfANkA1QDTAM8AzQDLAMUAvgC8ALoAuAC0ALIAsACuAKYApACeAJwAlgCRAI8AjQCLAIkAhwCDAIEAfQB1AHEAbQBqAGgAZgBkAFwAUABCAC8IGQc5BiMFcwVkBVAFTAUEBNEEiQRKBDMEJwQbBBkECgQCA/oD+APuA+kD5wPNA8UDvAOWAwIC1QK4AqYCnAJxAmICXAJQAgoBsgGwAZ4BSAEzAS0BKQElAR8BHQEbARkBFwESARABCgEIAQQBAgEAAP4A/AD6APgA9gDyAPAA7ADnAOEA3wDJAMUAwQC6ALQAsgCwAK4ArACqAKgApgCeAJwAmACWAI8AfwB9AGgAZgArACMAAAQAAFIAAAAAAgAAAAIAAAACqgC+A9UAcQRqABAEwQBOBtUAMQYUAHsB7ABcAtUAgQLVAGQDgQAhBKoAVAKBAKQCqgAlAoEAqgI/ABsEwQBgBMEAgQTBAHEEwQBkBMEAGQTBAG0EwQBeBMEAmATBAFgEwQBCAoEAqgKBAJEEqgBeBKoAVASqAF4ElgBaB9UAOwXBADcFwQCeBewAZgXsAKIFVgCgBNUAmgZWAGQGFACiAoEArASWACcF7ACiBNUAmgaqAJMGFACkBlYAXAVWAKAGVgBcBcEAngVWAG0FAAASBhQAogWBAD0HgQAjBNUAIQUAACsFKwAMAtUAkwI/ABsC1QAXBKoAcwQA//QCqgBSBMEAUgUAAIcEwQBYBQAATgTBAFoCqv/uBQAAUATVAIcCKwCNAiv/agSWAKACKwCNBxQAfQTVAIUE1QBMBQAAhwUAAFADgQCLBFYAVALVAB0E1QCFBFYANwaBAC8EKwA3BFYAFAQrABcDFAA7Aj8AsAMUAC0EqgBCBcEANwXBADcF7ABmBVYAoAYUAKQGVgBcBhQAogTBAFIEwQBSBMEAUgTBAFIEwQBSBMEAUgTBAFgEwQBaBMEAWgTBAFoEwQBaAisAjAIrABsCK//RAiv/7ATVAIUE1QBMBNUATATVAEwE1QBMBNUATATVAIUE1QCFBNUAhQTVAIUEwQBMAysAVgTBAFgEwQAOBMEAUALVAEQEgQACBMEAeQXs//gF7P/4CAAA2QKqAMMCqgAj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ADT/5QAkADf/TAAkADj/sgAkADn/mAAkADz/fwAkAFn/zQAkAFr/5QAkALX/zQAkALf/zQAlAA//sgAlABH/mAAlACT/sgAlADj/sgAlAGL/sgAlAGP/sgAlAGj/sgAmAA//sgAmABH/mgAnAA//fwAnABH/ZgAnACT/sgAnADn/ywAnADoAMwAnADz/sgAnAGL/sgAnAGP/sgApAA//GQApABH/AAApACT/ZgApAET/zQApAEj/sgApAEz/5QApAE//5QApAFL/sgApAFX/sgApAGL/ZgApAGP/ZgApAGz/zQApAG7/zQApAHz/sgAqAA//5QAqABH/zQAqACT/sgAqACr/5QAtAA//fwAtABH/ZgAtAB3/5QAtAB7/5QAtACT/zQAtAGL/zQAtAGP/zQAuAAz/sgAuACb/mgAuACr/mgAuADL/sgAuAET/5QAuAEj/sgAuAFL/sgAuAFj/sgAuAFn/fwAuAFr/mgAuAFz/zQAuAGf/sgAuAGz/5QAuAG7/5QAuAHz/sgAuAIH/sgAvACT/5QAvACb/mgAvACr/fwAvADL/mgAvADb/sgAvADf/AAAvADj/mgAvADn/GQAvADr/fwAvADz+/gAvAFr/sgAvAFz/sgAvAGf/mgAvAGj/mgAvALX/fwAvALf/MwAxAA//5QAxABH/zQAxACT/5QAxAGL/5QAxAGP/5QAyAA//sgAyABH/mAAyACT/sgAyADf/sgAyADn/ywAyADoAGQAyADv/zQAyADz/sgAyAGL/sgAyAGP/sgAzAA/+5QAzABH+zQAzACT/TAAzAET/sgAzAEj/sgAzAFL/sgAzAGL/TAAzAGP/TAAzAG7/sgA0ADf/sgA0ADn/5QA0ADoAMwA0ADz/mgA0AEkATAA0AEoAMwA0AE0AfwA0AFMAMwA0AFwAGQA1AAz/zQA1ACb/5QA1ACr/5QA1ADf/mgA1ADj/zQA1ADn/zQA1ADz/sgA1AET/5QA1AEj/zQA1AFL/zQA1AFj/zQA1AFn/zQA1AFr/5QA1AFz/5QA1AGj/zQA1AGz/5QA1AG7/5QA1AHz/zQA1AIH/zQA2AA//zQA2ABH/sgA3AA//GQA3ABD/mgA3ABH/AAA3AB3/mgA3AB7/mgA3ACT/fwA3ACb/zQA3ACr/zQA3ADL/5QA3ADT/5QA3AET/mgA3AEb/fwA3AEj/fwA3AEv/5QA3AEz/5QA3AFD/sgA3AFL/fwA3AFX/sgA3AFb/fwA3AFj/mgA3AFr/sgA3AFz/sgA3AF3/zQA3AGL/fwA3AGP/fwA3AGf/5QA3AG7/mgA4AA//sgA4ABH/mgA4ACT/mgA4AGL/mgA4AGP/mgA5AA//GQA5ABD/mgA5ABH/AAA5AB3/zQA5AB7/zQA5ACT/mAA5ACb/5QA5ACr/5QA5ADL/5QA5ADT/5QA5AET/mgA5AEj/mgA5AEz/5QA5AFL/mgA5AFX/sgA5AFj/sgA5AFz/sgA5AGL/mAA5AGP/mAA5AGf/5QA5AG7/mgA6AA//mgA6ABD/5QA6ABH/fwA6AB3/zQA6AB7/zQA6ADIAGQA6AET/zQA6AEf/zQA6AEj/zQA6AFL/zQA6AFX/5QA6AFj/sgA6AFz/zQA6AGcAGQA6AG7/zQA7ACb/ywA7ACr/zQA7ADL/5QA7AGf/5QA8AA//MwA8ABD/mgA8ABH/GQA8AB3/mgA8AB7/mgA8ACT/fwA8ACb/zQA8ACr/zQA8ADL/5QA8ADb/zQA8AET/fwA8AEf/fwA8AEj/fwA8AEz/5QA8AFL/fwA8AFP/mgA8AFT/ZgA8AFj/mgA8AFn/sgA8AGL/fwA8AGP/fwA8AGf/5QA8AG7/fwBEAEX/5QBEAEr/5QBEAFP/5QBEAFf/zQBEAFn/zQBEAFr/zQBEAFz/5QBFAA//mgBFABH/fwBFAEX/5QBFAE//5QBFAFj/5QBFAFn/5QBFAFr/5QBFAFz/5QBFAIH/5QBGAA//sgBGABH/mgBGAEv/zQBGAE7/sgBGAE//zQBGAFz/ywBHAFn/5QBHALcAGQBIAA//sgBIABH/mgBIAEX/5QBIAEr/5QBIAFP/5QBIAFn/zQBIAFr/5QBIAFv/5QBIAFz/ywBIAF3/5QBJAAMA5QBJAAQATABJAAwATABJAA//sgBJABH/mgBJACIAZgBJAET/5QBJAEj/5QBJAEkATABJAEwAGQBJAE8AGQBJAFL/5QBJAGz/5QBJAG7/5QBJAHP/5QBJAHcAzQBJAHz/5QBJALUAZgBJALcATABKAA//zQBKABH/sgBKAET/zQBKAEj/zQBKAEr/zQBKAE//5QBKAFL/zQBKAFP/5QBKAFX/5QBKAGz/zQBKAG7/zQBKAHz/zQBOAET/sgBOAEb/zQBOAEf/sgBOAEj/sgBOAEr/sgBOAEz/zQBOAE//zQBOAFL/sgBOAFP/zQBOAFT/sgBOAFb/zQBOAFj/zQBOAFz/zQBOAGz/sgBOAHz/sgBOAIH/zQBPAFr/5QBQAFj/5QBQAIH/5QBRAFj/5QBRAFn/5QBRAIH/5QBSAA//sgBSABH/mgBSAFn/5QBSAFv/zQBSAFz/5QBTAA//sgBTABH/mgBTAFr/5QBTAFz/5QBTAF3/5QBVAA//GQBVABD/5QBVABH/AABVAB3/5QBVAB7/5QBVAET/zQBVAEb/ywBVAEf/ywBVAEj/zQBVAEr/zQBVAE3/5QBVAE7/zQBVAE//5QBVAFL/sgBVAFP/5QBVAFT/sgBVAFX/5QBVAFb/zQBVAFcAGQBVAFj/zQBVAFn/5QBVAGz/zQBVAG7/zQBVAHz/sgBVAIH/zQBWAA//sgBWABH/mgBWAFr/zQBXALcAMwBZAA//fwBZABH/ZgBZAET/5QBZAEb/zQBZAEf/5QBZAEj/5QBZAFL/5QBZAFT/5QBZAGz/5QBZAG7/5QBZAHz/5QBaAA//ZgBaABH/TABaAET/5QBaAEb/5QBaAEf/5QBaAEj/5QBaAFL/5QBaAFT/5QBaAGz/5QBaAG7/5QBaAHz/5QBbAEb/zQBbAEf/5QBbAEj/5QBbAFL/5QBbAHz/5QBcAA//ZgBcABH/TABcAET/5QBcAEb/5QBcAEf/5QBcAEj/5QBcAEr/5QBcAFL/5QBcAFb/5QBcAGz/5QBcAG7/5QBcAHz/5QBcALcAGQBdAEb/5QBdAEf/5QBdAEj/5QBdAFL/5QBdAHz/5QBiACb/zQBiACr/zQBiADL/5QBiADT/5QBiADf/TABiADj/sgBiADn/mABiADz/fwBiAFn/zQBiAFr/5QBiALX/zQBiALf/zQBjACb/zQBjACr/zQBjADL/5QBjADT/5QBjADf/TABjADj/sgBjADn/mABjADz/fwBjAFn/zQBjAFr/5QBjALX/zQBjALf/zQBnACT/sgBnADf/sgBnADn/ywBnADoAGQBnADv/zQBnADz/sgBoACT/mgBsAFn/zQBsAFr/zQBsAFz/5QBuAFn/zQBuAFr/zQBuAFz/5QB8AFn/5QB8AFv/zQB8AFz/5QC0ACT/ywC0AGL/ywC0AGP/ywC2ACT/zQC2AGL/zQC2AGP/zQC3AEf/zQC3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'
        ];
    }
}
}


/* ASSERT  */
namespace Quid\TestSuite\Assert {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Assert",'ActivatePassword',function() {

// activatePassword
class ActivatePassword extends Core\Route\ActivatePassword
{
    // config
    public static $config = [
        'path'=>[
            'en'=>'activate/password/[primary]/[hash]',
            'fr'=>'activer/mot-de-passe/[primary]/[hash]']
    ];


    // trigger
    public function trigger()
    {
        return static::class;
    }
}

//__init
ActivatePassword::__init();
});
}
namespace Quid\TestSuite\Assert {
use Quid\TestSuite;
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Assert",'Contact',function() {

// contact
class Contact extends Core\Route
{
    // config
    public static $config = [
        'row'=>TestSuite\Row\OrmCol::class,
        'path'=>['en'=>'contact','fr'=>'contact']
    ];


    // trigger
    public function trigger()
    {
        return static::class;
    }
}

//__init
Contact::__init();
});
}
namespace Quid\TestSuite\Assert {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Assert",'Error',function() {

// error
class Error extends Core\Route\Error
{
    // config
    public static $config = [];


    // trigger
    public function trigger()
    {
        return static::class;
    }
}

//__init
Error::__init();
});
}
namespace Quid\TestSuite\Assert {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Assert",'Home',function() {

// home
class Home extends Core\Route\Home
{
    // config
    public static $config = [];


    // trigger
    public function trigger()
    {
        return static::class;
    }
}

//__init
Home::__init();
});
}
namespace Quid\TestSuite\Assert {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Assert",'Sitemap',function() {

// sitemap
class Sitemap extends Core\Route\Sitemap
{
    // config
    public static $config = [];


    // trigger
    public function trigger()
    {
        return static::class;
    }
}

//__init
Sitemap::__init();
});
}


/* CMS */
namespace Quid\TestSuite\Cms {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Cms",'System',function() {

// system
class System extends Core\Route
{
    // config
    public static $config = [
        'type'=>'cms',
        'user'=>'extended'
    ];


    // trigger
    public function trigger():string
    {
        return '';
    }
}

//__init
System::__init();
});
}


/* COL */
namespace Quid\TestSuite\Col {
use Quid\Core;
use Quid\Orm;
use Quid\Base;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Col",'OrmCell__Name',function() {

// ormCell__Name
class OrmCell__Name extends Core\Col
{
    // config
    public static $config = [
        'ignore'=>false,
        'required'=>true
    ];


    // onSet
    public function onSet($return,array $row,?Orm\Cell $cell=null,array $option)
    {
        if(is_string($return))
        $return = Base\Str::stripEnd('abcde',$return);

        return $return;
    }


    // onGet
    public function onGet($return,array $option)
    {
        $return = $this->value($return);

        if(is_string($return))
        $return .= 'abcde';

        return $return;
    }
}

//__init
OrmCell__Name::__init();
});
}
namespace Quid\TestSuite\Col {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Col",'UserIds',function() {

// userIds
class UserIds extends Core\Col\Set
{
    // config
    public static $config = [];
}

//__init
UserIds::__init();
});
}


/* ROLE */
namespace Quid\TestSuite\Role {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Role",'User',function() {

// user
class User extends Core\Role\User
{
    // config
    public static $config = [
        'user'=>'extended'
    ];
}

//__init
User::__init();
});
}


/* ROW */
namespace Quid\TestSuite\Row {
use Quid\TestSuite;
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Row",'OrmCell',function() {

// ormCell
class OrmCell extends Core\Row
{
    // config
    public static $config = [
        'cols'=>[
            'googleMaps'=>['required'=>false],
            'name'=>['class'=>TestSuite\Col\OrmCell__Name::class],
            'enum'=>['tag'=>'radio','relation'=>'test'],
            'set'=>['set'=>true,'relation'=>[2=>'ok',3=>'well',4=>'OK']],
            'integer'=>['cell'=>Core\Cell\Integer::class],
            'medias'=>[
                'media'=>6,
                'extension'=>'php'],
            'thumbnail'=>[
                'version'=>['large'=>[55,'jpg','crop',600,300]]],
            'thumbnails'=>[
                'media'=>6,
                'class'=>Core\Col\Medias::class,
                'version'=>['large'=>[55,'jpg','crop',600,300]]]]
    ];
}

//__init
OrmCell::__init();
});
}
namespace Quid\TestSuite\Row {
use Quid\TestSuite;
use Quid\Core;
use Quid\Orm;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Row",'OrmCol',function() {

// ormCol
class OrmCol extends Core\Row
{
    // config
    public static $config = [
        'cols'=>[
            'other'=>['relation'=>[2,3,4]],
            'password'=>['class'=>Core\Col\UserPassword::class],
            'myRelation'=>['relation'=>['test',3,4,9=>'ok']],
            'relationRange'=>['relation'=>['min'=>0,'max'=>20,'inc'=>2],'editable'=>false],
            'relationLang'=>['complex'=>'radio','relation'=>'test'],
            'relationCall'=>['relation'=>[self::class,'testCall']],
            'rangeInt'=>['relation'=>8],
            'multi'=>['complex'=>'multiselect','set'=>true,'relation'=>'test'],
            'check'=>['set'=>true,'relation'=>['min'=>0,'max'=>20,'inc'=>2]],
            'user_ids'=>['class'=>TestSuite\Col\UserIds::class],
            'medias'=>['media'=>6],
            'media'=>['version'=>[
                'small'=>[50,'jpg','crop',300,200],
                'large'=>[70,'jpg','ratio_y',500,400]]],
            'email'=>['description'=>'Ma description']]
    ];


    // testCall
    public static function testCall(Orm\ColRelation $relation):array
    {
        return ['test','test2','test3'];
    }
}

//__init
OrmCol::__init();
});
}
namespace Quid\TestSuite\Row {
use Quid\TestSuite;
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Row",'OrmRow',function() {

// ormRow
class OrmRow extends Core\Row
{
    // config
    public static $config = [
        'where'=>[true,'name_en'=>'test'],
        'order'=>['date'=>'desc'],
        '@cms'=>[
            'route'=>['contact'=>TestSuite\Assert\Contact::class]
        ]
    ];
}

//__init
OrmRow::__init();
});
}
namespace Quid\TestSuite\Row {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Row",'OrmTableSibling',function() {

// ormTableSibling
class OrmTableSibling extends Core\Row
{
    // config
    public static $config = [
        'relation'=>['method'=>'myMethod']
    ];


    // myMethod
    public function myMethod()
    {
        return $this->cellName();
    }
}

//__init
OrmTableSibling::__init();
});
}
namespace Quid\TestSuite\Row {
use Quid\TestSuite;
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Row",'User',function() {

// user
class User extends Core\Row\User
{
    // config
    public static $config = [
        'emailModel'=>[
            'resetPassword'=>'resetPassword',
            'registerConfirm'=>'registerConfirm']
    ];


    // activatePasswordRoute
    public function activatePasswordRoute():string
    {
        return TestSuite\Assert\ActivatePassword::class;
    }
}

//__init
User::__init();
});
}


/* ROWS */
namespace Quid\TestSuite\Rows {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Rows",'OrmDb',function() {

// ormDb
class OrmDb extends Core\Rows
{
    // config
    public static $config = [];
}

//__init
OrmDb::__init();
});
}


/* TABLE */
namespace Quid\TestSuite\Table {
use Quid\Core;
use Quid\Base;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Table",'OrmDb',function() {

// ormDb
class OrmDb extends Core\Table
{
    // config
    public static $config = [
        'key'=>'name_en',
        'pair'=>'id',
        'priority'=>2000,
        'search'=>false,
        'parent'=>'doesNotExist',
        'label'=>'Le nom de la table',
        'description'=>'ok/Description table',
        '@assert'=>[
            'where'=>[['date','>=',[Base\Date::class,'getTimestamp']]]]
    ];


    // default
    public function default():?array
    {
        return ['what'=>['id'],'where'=>['id'=>2]];
    }
}

//__init
OrmDb::__init();
});
}
namespace Quid\TestSuite\Table {
use Quid\Core;

\Quid\Main\Autoload::setClosure("Quid\TestSuite\Table",'OrmTable',function() {

// ormTable
class OrmTable extends Core\Table
{
    // config
    public static $config = [
        'parent'=>'ormDb',
        'relation'=>['onGet'=>true,'what'=>['id','name_en','dateAdd'],'output'=>'[dateAdd] [name_en] _ [id]','order'=>['name_en'=>'desc']]
    ];
}

//__init
OrmTable::__init();
});
}
?>