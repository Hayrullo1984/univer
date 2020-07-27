<?php
namespace common\widgets;

use Yii;

class Bulim extends \yii\bootstrap4\Widget
{

    public $models;
    public $budkont;
    public $bulim;
    public $lavozim;
    public $unvon;
    public $daraja;
    public $org;
    public $razryad;
    public $v_shtats;
    public $yil;
   
    /**
     * {@inheritdoc}
     */  
  public function init()
  {
    parent::init();
  }

    /**
     * {@inheritdoc}
     */
    public function run()
    {

        return $this->render('bulim',[
            'models'=>$this->models,
            'budkont'=>$this->budkont,
            'bulim'=>$this->bulim,
            'lavozim'=>$this->lavozim,
            'unvon'=>$this->unvon,
            'daraja'=>$this->daraja,
            'org'=>$this->org,
            'razryad'=>$this->razryad,
            'v_shtats'=> $this->v_shtats,
            'yil' =>$this->yil,
        ]);
        
    }
}
