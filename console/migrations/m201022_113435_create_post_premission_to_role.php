<?php

use yii\db\Migration;

/**
 * Class m201022_113435_create_post_premission_to_role
 */
class m201022_113435_create_post_premission_to_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $author = $auth->getRole('author');
        $admin = $auth->getRole('admin');
        $superAdmin = $auth->getRole('super-admin');

        $listPost = $auth->getPermission('post-index');
        $createPost = $auth->getPermission('post-create');
        $updatePost = $auth->getPermission('post-update');
        $deletePost = $auth->getPermission('post-delete');
        $viewPost = $auth->getPermission('post-view');

        //assign
        $auth->addChild($author,$createPost);
        $auth->addChild($author,$updatePost);
        $auth->addChild($author,$viewPost);
        $auth->addChild($author,$listPost);
        

        $auth->addChild($admin, $author);

        $auth->addChild($superAdmin, $admin);
        $auth->addChild($superAdmin, $deletePost);
       
    }

    public function safeDown()
    {
        return false;
    }
}
