<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23
 * Time: 22:48
 */

namespace AtServer;




abstract class EntityFactoryBase {

	private static $instanceList = [];

	/**
	 * @param      $class
	 * @param null $id
	 * @param bool $is_instance
	 *
	 * @return mixed
	 * @throws \AtServer\SystemException
	 */
	public static function instance( $class, $id = null ) {
		if ( ! class_exists( $class ) ) {
			\AtServer\ThrowException::SystemException( \AtServer\ErrorHandler::CLASS_EXIST, $class . '类不存在' );
		}
		return new $class( $id );
	}

	/**
	 * 删除对象实例
	 */
	public static function clear(){
		foreach ( self::$instanceList as $obj ) {
			unset( $obj );
	    }
	}

	public static function initEntity($className,$obj){
		/**
		 * 默认值
		 */
		$proper=get_class_vars($className);
		foreach ( $proper as $key => $value ) {
			if($key{0}!='_'){
				$obj->$key=$value;
			}
		}
	}
}