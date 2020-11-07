<?php

use yii\db\Migration;

/**
 * Class m201107_135856_create_post_premission_to_role
 */
class m201107_135856_create_post_premission_to_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $auth = Yii::$app->authManager;

        // get role
        $author = $auth->getRole('author');
        $admin = $auth->getRole('admin');
        $superAdmin = $auth->getRole('super-admin');

        // get permission
        $listPost = $auth->getPermission('post-index');
        $createPost = $auth->getPermission('post-create');
        $updatePost = $auth->getPermission('post-update');
        $viewPost = $auth->getPermission('post-view');
        $deletePost = $auth->getPermission('post-delete');

        // assign
        $auth->addChild($author, $createPost);
        $auth->addChild($author, $listPost);
        $auth->addChild($author, $viewPost);
        $auth->addChild($author, $updatePost);

        $auth->addChild($admin, $author);

        $auth->addChild($superAdmin, $admin);
        $auth->addChild($superAdmin, $deletePost);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        // get role
        $author = $auth->getRole('author');
        $admin = $auth->getRole('admin');
        $superAdmin = $auth->getRole('super-admin');

        //get Permission
        $listPost = $auth->getPermission('post-index');
        $createPost = $auth->getPermission('post-create');
        $deletePost = $auth->getPermission('post-delete');
        $updatePost = $auth->getPermission('post-update');
        $viewPost = $auth->getPermission('post-view');

        //assign
        $auth->removeChild($author,$createPost);
        $auth->removeChild($author,$listPost);
        $auth->removeChild($author,$viewPost);
        $auth->removeChild($author,$updatePost);

        $auth->removeChild($admin,$author);

        $auth->removeChild($superAdmin,$admin);
        $auth->removeChild($superAdmin,$deletePost);

        //echo "m201107_135856_create_post_premission_to_role cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201107_135856_create_post_premission_to_role cannot be reverted.\n";

        return false;
    }
    */
}
