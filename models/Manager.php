<?php

/*
 * manager 模块
 * 负责对 lib_manager 数据库表的 CURD
 *
 * 此模块是 manager 认证类
 */


namespace app\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class Manager extends ActiveRecord implements IdentityInterface
{

	/**
	 * 指定此模型所关联的数据表为 'lib_manager'
	 */
	public static function tableName()
	{
		return 'lib_manager';	
	}


	/**
	 * 验证规则
	 * @return arrary 验证规则数组
	 *
	 */
	public function rules()
	{
		return [
			[['managerUsername', 'managerPassword'], 'required', 'message' => '不能为空，请输入'  ],	
			[
				['managerUsername', 'managerPassword'],
				'string',
			   	'length' => [6,30],
				'max' => 30,
				'tooShort' => '至少6位字符', 
				'tooLong'  => '至多30位字符',
			],
		];	
	}


	/**
	 * 根据参数 $id 查询身份
	 *
	 * @param string|integer  $id 被查询的ID
	 * @return IdentityInterface | null 通过 ID 所匹配到的身份对象
	 */
	public static function findIdentity( $id )
	{
		return static::findOne( $id );	
	}


	/**
	 * 根据 token 查询身份
	 * 
	 * @param string $token 被查询的 token 
	 * @return IdentityInterface | null 通过 token 所得到的身份对象
	 */
	public static function findIdentityByAccessToken( $token, $type = null )
	{
		return static::findOne(['access_token' => $token ]);	
	}

	
	/**
	 * @return int | string 返回当前用户的 id
	 */
	public function getId()
	{
		#return $this->id;	
		return $this->PK_managerID;	
	}


	/**
	 * @return string 当前用户的 (cookie) 认证密钥 
	 */	
	public function getAuthKey()
	{
		return $this->auth_key;	
	}
	

	/**
	 *  验证当前用户的 (cookie) 认证密钥
	 *
	 * @param string $authKey
	 * @return boolean 是否验证正确当前的用户登陆
	 */
	public function validateAuthKey( $authKey )
	{
		return $this->getAuthKey() === $authKey;	
	}









}
