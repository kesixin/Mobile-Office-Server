<?php

    namespace Home\Model;
    use Think\Model;
    use Think\Model\RelationModel;
class User_roleModel extends RelationModel{
    protected $tableName='user_role';
    protected $_link=array(
        'role'=>array(
            'mapping_type'=> self::HAS_ONE,//查询类型
            'mapping_name'=>'role',//关联的映射名称，用于获取数据用
//该名称不要和当前模型的字段有重复，否则会导致关联数据获取的冲突。如果mapping_name没有定义的话，会取class_name的定义作为mapping_name
            'class_name'=>'role',
            'foreign_key'=>'id',
        ),
    );
}