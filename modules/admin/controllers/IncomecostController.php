<?php
/**
 * Created by PhpStorm.
 * Incomecost: Administrator
 * Date: 2015/1/31
 * Time: 17:33
 */

namespace app\modules\admin\controllers;
use app\models\Incomecost;
use Yii;
use yii\web\Controller;
use app\models\Follow;
use app\models\YiiUser;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class IncomecostController extends Controller{
    public $layout  = 'layout';
    /**
     * @用户授权规则
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @msg消息列表
     */

    public function  actionIndex(){

        $model=Incomecost::find();
        $count=$model->count();
        $page=new Pagination(['defaultPageSize'=>50,'totalCount'=>$count]);
        $items=$model->offset($page->offset)->limit($page->limit)->all();
        return $this->render('index',['page'=>$page,'items'=>$items]);
    }
    /**
     * @add
     */
    public function actionAdd(){
        
        $model=new Incomecost();
        if($model->load(Yii::$app->request->post())//判断是否是表单提交
            && $model->validate() //验证表单提交的内容正确性
            ){
            if($model->save()){
                Yii::$app->session->setFlash('success','新增成功！');
            }else{
                Yii::$app->session->setFlash('error','新增失败！');
            }
            //echo "<pre/>";print_r(Yii::$app->request->post());die();
        }
        return $this->render('add',['model'=>$model]);
    }
    
    
    public function actionEdit($id){
     
        $model=Incomecost::findOne(['id'=>$id]);
        if($model->load(Yii::$app->request->post())//判断是否是表单提交
            && $model->validate() //验证表单提交的内容正确性
            ){
            if($model->save()){
                Yii::$app->session->setFlash('success','修改成功！');
            }else{
                Yii::$app->session->setFlash('error','修改失败！');
            }
        }
        return $this->render('edit',['model'=>$model]);
    }
    
    
    public function actionDelete($id){ 
        if(Yii::$app->request->isAjax){
            //ajax请求删除
            Incomecost::deleteAll(['id'=>$id]);
            return 0;
        }
    }
    

} 