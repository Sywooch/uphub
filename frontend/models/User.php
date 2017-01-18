<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'username',
								'auth_key',
								'password_hash',
								'email',
								'created_at',
								'updated_at' 
						],
						'required' 
				],
				[ 
						[ 
								'status',
								'created_at',
								'updated_at' 
						],
						'integer' 
				],
				[ 
						[ 
								'username',
								'password_hash',
								'password_reset_token',
								'email' 
						],
						'string',
						'max' => 255 
				],
				[ 
						[ 
								'auth_key' 
						],
						'string',
						'max' => 32 
				],
				[ 
						[ 
								'username' 
						],
						'unique' 
				],
				[ 
						[ 
								'email' 
						],
						'unique' 
				],
				[ 
						[ 
								'password' 
						],
						'unique' 
				],
				[ 
						[ 
								'password_reset_token' 
						],
						'unique' 
				] 
		]
		;
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id' => 'ID',
				'username' => 'Username',
				'auth_key' => 'Auth Key',
				'password_hash' => 'Password Hash',
				'password_reset_token' => 'Password Reset Token',
				'email' => 'อีเมล์',
				'status' => 'สถานะ',
				'created_at' => 'Created At',
				'updated_at' => 'Updated At',
				'password' => 'password' 
		];
	}
	public static function findIdentity($id) {
		return static::findOne ( [ 
				'user_id' => $id 
		] );
	}
	public static function findIdentityByAccessToken($token, $type = null) {
		throw new NotSupportedException ( '"findIdentityByAccessToken" is not implemented.' );
	}
	public function getId() {
		return $this->getPrimaryKey ();
	}
	public function getAuthKey() {
		return $this->auth_key;
	}
	public function validateAuthKey($authKey) {
		return $this->getAuthKey () === $authKey;
	}
	public function generateAuthKey() {
		$this->auth_key = Yii::$app->security->generateRandomString ();
	}
}
