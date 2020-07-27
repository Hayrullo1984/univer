<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_lang".
 *
 * @property int $ID
 * @property string $LANG
 * @property string $SHORTLANG
 *
 * @property UdMainmenu[] $udMainmenus
 */
class UsLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LANG', 'SHORTLANG'], 'required'],
            [['LANG', 'SHORTLANG'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'LANG' => 'Til',
            'SHORTLANG' => 'Til qisqa nomi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUdMainmenus()
    {
        return $this->hasMany(UdMainmenu::className(), ['IDLANG' => 'ID']);
    }
}
