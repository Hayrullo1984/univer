<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ClientForm extends Model
{
    public $things;
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['things'], 'required'],
            // ['things', 'validateLimit'],
        ];
    }

 
    // public function validateLimit($attribute, $params)
    // {
    //     if(!$this->hasErrors()){
    //         if (count($this->things)<2 && count($this->things)>5) {
    //             $this->addError($attribute, '2 tadan kam va 5 tadan ko\'p bo\'lmasligi kerak ');
    //         }

    //     }
    // }
  


}
