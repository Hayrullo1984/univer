<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_bulim".
 *
 * @property int $ID
 * @property int $IDORG
 * @property int $IDMARKAZ
 * @property string $NAMEBULIM
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 * @property UsOrg $oRG
 * @property UsLavozim[] $usLavozims
 */
class UsBulim extends \yii\db\ActiveRecord
{

 

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_bulim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDORG', 'NAMEBULIM', 'IDLANG'], 'required'],
            [['IDORG', 'IDMARKAZ', 'IDLANG', 'IDALIFBO'], 'integer'],
            ['IDMARKAZ','default', 'value' => 0],
            [['NAMEBULIM'], 'string', 'max' => 255],
            [['IDALIFBO'], 'exist', 'skipOnError' => true, 'targetClass' => UsAlifbo::className(), 'targetAttribute' => ['IDALIFBO' => 'ID']],
            [['IDLANG'], 'exist', 'skipOnError' => true, 'targetClass' => UsLang::className(), 'targetAttribute' => ['IDLANG' => 'ID']],
            [['IDORG'], 'exist', 'skipOnError' => true, 'targetClass' => UsOrg::className(), 'targetAttribute' => ['IDORG' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'IDORG' => 'Tashkilot',
            'IDMARKAZ' => 'Markaz',
            'NAMEBULIM' => 'Bo\'lim',
            'IDLANG' => 'Til',
            'IDALIFBO' => 'Alifbo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getALIFBO()
    {
        return $this->hasOne(UsAlifbo::className(), ['ID' => 'IDALIFBO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANG()
    {
        return $this->hasOne(UsLang::className(), ['ID' => 'IDLANG']);
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
    public function getUsLavozims()
    {
        return $this->hasMany(UsLavozim::className(), ['IDBULIM' => 'ID']);
    }
}
