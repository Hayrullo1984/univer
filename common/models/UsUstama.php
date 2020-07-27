<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_ustama".
 *
 * @property int $ID
 * @property int $IDLAVOZIM
 * @property string $SANA
 * @property double $USTAMA
 *
 * @property RmShtat[] $rmShtats 
 * @property UsLavozim $lAVOZIM
 */
class UsUstama extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_ustama';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDLAVOZIM', 'SANA', 'USTAMA'], 'required'],
            [['IDLAVOZIM'], 'integer'],
            [['SANA'], 'safe'],
            [['USTAMA'],'number'],
            [['IDLAVOZIM'], 'exist', 'skipOnError' => true, 'targetClass' => UsLavozim::className(), 'targetAttribute' => ['IDLAVOZIM' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDLAVOZIM' => 'Lavozim',
            'SANA' => 'Sana',
            'USTAMA' => 'Ustama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
       public function getRmShtats() 
   { 
       return $this->hasMany(RmShtat::className(), ['IDUSTAMA' => 'ID']); 
   } 

   
   /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getLAVOZIM()
    {
        return $this->hasOne(UsLavozim::className(), ['ID' => 'IDLAVOZIM']);
    }
}
