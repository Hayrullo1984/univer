<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rm_shtat".
 *
 * @property int $ID
 * @property int $IDBUDKONT
 * @property int $IDMARKAZ
 * @property int $IDBULUM
 * @property int $IDLAVOZIM
 * @property int $IDUNVON
 * @property int $IDDARAJA
 * @property double $BIRLIKSONI
 * @property int $IDRAZRYAD
 * @property double $USTAMA
 * @property double $JAMI
 * @property string $IZOH
 * @property int $YNL
 * @property int $IDORG
 * @property int $IDUSER
 * @property string $INSDATE
 *
 * @property UsBudkont $bUDKONT
 * @property UsLavozim $lAVOZIM
 * @property UsIlmunvon $uNVON
 * @property UsIlmdaraja $dARAJA
 * @property UsOrg $oRG
 * @property UsMarkaz $mARKAZ
 * @property UsRazryad $rAZRYAD
 */
class RmShtat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rm_shtat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDBUDKONT', 'IDMARKAZ', 'IDBULUM', 'IDLAVOZIM', 'IDUNVON', 'IDDARAJA', 'BIRLIKSONI', 'IDRAZRYAD', 'JAMI', 'YNL', 'IDORG', 'IDUSER'], 'required'],
            [['IDBUDKONT', 'IDMARKAZ', 'IDBULUM', 'IDLAVOZIM', 'IDUNVON', 'IDDARAJA', 'IDRAZRYAD',  'YNL', 'IDORG', 'IDUSER'], 'integer'],
            [['IDBUDKONT', 'IDMARKAZ', 'IDBULUM', 'IDLAVOZIM', 'IDUNVON', 'IDDARAJA', 'IDRAZRYAD', 'IDUSTAMA', 'YNL', 'IDORG', 'IDUSER'], 'integer'],
            [['BIRLIKSONI', 'JAMI'], 'number'],
            [['IZOH'], 'string', 'max' => 255],
            [['INSDATE'], 'string', 'max' => 20],
            [['IDBUDKONT'], 'exist', 'skipOnError' => true, 'targetClass' => UsBudkont::className(), 'targetAttribute' => ['IDBUDKONT' => 'ID']],
            [['IDLAVOZIM'], 'exist', 'skipOnError' => true, 'targetClass' => UsLavozim::className(), 'targetAttribute' => ['IDLAVOZIM' => 'ID']],
            [['IDUNVON'], 'exist', 'skipOnError' => true, 'targetClass' => UsIlmunvon::className(), 'targetAttribute' => ['IDUNVON' => 'ID']],
            [['IDDARAJA'], 'exist', 'skipOnError' => true, 'targetClass' => UsIlmdaraja::className(), 'targetAttribute' => ['IDDARAJA' => 'ID']],
            [['IDORG'], 'exist', 'skipOnError' => true, 'targetClass' => UsOrg::className(), 'targetAttribute' => ['IDORG' => 'ID']],
            [['IDMARKAZ'], 'exist', 'skipOnError' => true, 'targetClass' => UsMarkaz::className(), 'targetAttribute' => ['IDMARKAZ' => 'ID']],
            [['IDRAZRYAD'], 'exist', 'skipOnError' => true, 'targetClass' => UsRazryad::className(), 'targetAttribute' => ['IDRAZRYAD' => 'ID']],
            [['IDBULUM'], 'exist', 'skipOnError' => true, 'targetClass' => UsBulim::className(), 'targetAttribute' => ['IDBULUM' => 'ID']], 
            [['IDUSTAMA'], 'exist', 'skipOnError' => true, 'targetClass' => UsUstama::className(), 'targetAttribute' => ['IDUSTAMA' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDBUDKONT' => 'Status',
            'IDMARKAZ' => 'Markaz',
            'IDBULUM' => 'Bo\'lim',
            'IDLAVOZIM' => 'Lavozim',
            'IDUNVON' => 'Unvon',
            'IDDARAJA' => 'Daraja',
            'BIRLIKSONI' => 'Shtat birliksoni',
            'IDRAZRYAD' => 'Razryad',
            'IDUSTAMA' => 'Ustama',
            'JAMI' => 'Jami',
            'IZOH' => 'Izoh',
            'YNL' => 'Yil',
            'IDORG' => 'Tashkilot',
            'IDUSER' => 'User',
            'INSDATE' => 'Insdate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBUDKONT()
    {
        return $this->hasOne(UsBudkont::className(), ['ID' => 'IDBUDKONT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBULIM()
    {
        return $this->hasOne(UsBulim::className(), ['ID' => 'IDBULUM']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLAVOZIM()
    {
        return $this->hasOne(UsLavozim::className(), ['ID' => 'IDLAVOZIM']);
    }

     /** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getUSTAMA() 
   { 
       return $this->hasOne(UsUstama::className(), ['ID' => 'IDUSTAMA']); 
   } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUNVON()
    {
        return $this->hasOne(UsIlmunvon::className(), ['ID' => 'IDUNVON']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDARAJA()
    {
        return $this->hasOne(UsIlmdaraja::className(), ['ID' => 'IDDARAJA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getORG()
    {
        return $this->hasOne(UsOrg::className(), ['ID' => 'IDORG']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMARKAZ()
    {
        return $this->hasOne(UsMarkaz::className(), ['ID' => 'IDMARKAZ']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRAZRYAD()
    {
        return $this->hasOne(UsRazryad::className(), ['ID' => 'IDRAZRYAD']);
    }
}
