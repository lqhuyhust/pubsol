<?php
/**
 * SPT software - Stater plugin
 * 
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Just a basic plugin
 * 
 */

namespace App\plugins\facts4me;

use SPT\App\Instance as AppIns;
use SPT\Plugin\CMS as PluginAbstract;
use SPT\Support\Loader;
use Joomla\DI\Container;
use SPT\File;

class plugin extends PluginAbstract
{ 
    public function register()
    {
        return [
            'viewmodels' => [
                'alias' => [
                    'App\plugins\facts4me\viewmodels\HomeVM' => 'HomeVM',
                    // 'App\plugins\facts4me\viewmodels\AdminVM' => 'AdminVM',
                    // 'App\plugins\facts4me\viewmodels\TopicVM' => 'TopicVM',
                    // 'App\plugins\facts4me\viewmodels\SubTopVM' => 'SubTopVM',
                    // 'App\plugins\facts4me\viewmodels\UserVM' => 'UserVM',
                    'App\plugins\facts4me\viewmodels\AdminUsersVM' => 'AdminUsersVM',
                    'App\plugins\facts4me\viewmodels\PaymentVM' => 'PaymentVM',
                    // 'App\plugins\facts4me\viewmodels\SubjectVM' => 'SubjectVM',
                    'App\plugins\facts4me\viewmodels\WidgetsVM' => 'WidgetsVM',
                    'App\plugins\facts4me\viewmodels\StripeVM' => 'StripeVM',
                    'App\plugins\facts4me\viewmodels\AdminTopicsVM' => 'AdminTopicsVM',
                    'App\plugins\facts4me\viewmodels\AdminTopicVM' => 'AdminTopicVM',
                    'App\plugins\facts4me\viewmodels\AdminPostsVM' => 'AdminPostsVM',
                    'App\plugins\facts4me\viewmodels\AdminPostVM' => 'AdminPostVM',
                    'App\plugins\facts4me\viewmodels\AdminUserVM' => 'AdminUserVM',
                    'App\plugins\facts4me\viewmodels\AdminSubjectsVM' => 'AdminSubjectsVM',
                    'App\plugins\facts4me\viewmodels\AdminSubjectVM' => 'AdminSubjectVM',
                    'App\plugins\facts4me\viewmodels\AdminSettingVM' => 'AdminSettingVM',
                    'App\plugins\facts4me\viewmodels\AdminEmailsVM' => 'AdminEmailsVM',
                    'App\plugins\facts4me\viewmodels\AdminEmailVM' => 'AdminEmailVM',
                    'App\plugins\facts4me\viewmodels\AdminTransactionsVM' => 'AdminTransactionsVM',
                    'App\plugins\facts4me\viewmodels\AdminTransactionVM' => 'AdminTransactionVM',
                ],
            ],
            'models' => [
                'alias' => [
                    'App\plugins\facts4me\models\PaymentModel' => 'PaymentModel',
                    'App\plugins\facts4me\models\EmailModel' => 'EmailModel',
                    'App\plugins\facts4me\models\UserModel' => 'UserModel',
                    'App\plugins\facts4me\models\TopicModel' => 'TopicModel',
                    'App\plugins\facts4me\models\SubjectModel' => 'SubjectModel',
                    'App\plugins\facts4me\models\HelperModel' => 'HelperModel',
                    'App\plugins\facts4me\models\OptionModel' => 'OptionModel',
                ],
            ],
            'entity' => [],
            'file' => [],
            // write your code here
        ];
    }

    public function getInfo()
    {
        return [
            'name' => 'fact4me',
            'author' => 'Dev Joomaio',
            'version' =>  '0.1',
            'description' => 'Fact4me'
        ];
    }

    public function loadFile(Container $container)
    {
        $container->set('file', new File());
    }

    public function loadEntity(Container $container)
    {
        $path = AppIns::path('plugin'). 'facts4me/entities';
        $namespace = 'App\plugins\facts4me\entities';
        $inners = Loader::findClass($path, $namespace);
        foreach($inners as $class)
        {
            if(class_exists($class))
            {
                $entity = new $class($container->get('query'));
                $entity->checkAvailability();
                $container->share( $class, $entity, true);
                $alias = explode('\\', $class);
                $container->alias( $alias[count($alias) - 1], $class);
            }
            // else { debug this }
        }
    }
}
