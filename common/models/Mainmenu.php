<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ud_mainmenu".
 *
 * @property int $ID
 * @property string $NAMEMMENU
 * @property int $POSITION
 * @property int $IDLANG
 * @property int $IDALIFBO
 *
 * @property UsAlifbo $aLIFBO
 * @property UsLang $lANG
 */
class Mainmenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ud_mainmenu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NAMEMMENU', 'POSITION', 'IDLANG', 'IDALIFBO'], 'required'],
            [['POSITION', 'IDLANG', 'IDALIFBO'], 'integer'],
            [['NAMEMMENU'], 'string', 'max' => 20],
            [['URL'], 'string', 'max' => 60],
            [['IDALIFBO'], 'exist', 'skipOnError' => true, 'targetClass' => UsAlifbo::className(), 'targetAttribute' => ['IDALIFBO' => 'ID']],
            [['IDLANG'], 'exist', 'skipOnError' => true, 'targetClass' => UsLang::className(), 'targetAttribute' => ['IDLANG' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NAMEMMENU' => 'Menu nomi',
            'POSITION' => 'Joylashishi',
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
}
