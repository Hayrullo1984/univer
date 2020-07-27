<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "us_permissions".
 *
 * @property int $id
 * @property string $action_name
 * @property string $description
 */
class UsPermission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'us_permissions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['action_name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action_name' => 'Action Name',
            'description' => 'Description',
        ];
    }
}
