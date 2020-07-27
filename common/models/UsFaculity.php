<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_faculity".
 *
 * @property int $ID
 * @property int $IDORG
 * @property string $NAMEFACULITY
 * @property string $SHORTNAMEFACULITY
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 * @property UsOrg $oRG
 */
class UsFaculity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_faculity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IDORG', 'NAMEFACULITY', 'SHORTNAMEFACULITY', 'IDLANG', 'IDALIFBO'], 'required'],
            [['IDORG', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEFACULITY'], 'string', 'max' => 150],
            [['SHORTNAMEFACULITY'], 'string', 'max' => 20],
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
            'NAMEFACULITY' => 'Fakultet',
            'SHORTNAMEFACULITY' => 'Fakultet qisqacha nomi',
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
}
