# tp51-library for ThinkPHP5.1
[![Latest Stable Version](https://poser.pugx.org/yoko/tp51-library/v/stable)](https://packagist.org/packages/yoko/tp51-library)
[![Total Downloads](https://poser.pugx.org/yoko/tp51-library/downloads)](https://packagist.org/packages/yoko/tp51-library)
[![Latest Unstable Version](https://poser.pugx.org/yoko/tp51-library/v/unstable)](https://packagist.org/packages/yoko/tp51-library)
[![License](https://poser.pugx.org/yoko/tp51-library/license)](https://packagist.org/packages/yoko/tp51-library)

tp51-library 是针对 ThinkPHP5.1 版本封装的一套工具类库。

## 使用说明
* tp51-library 需要Composer支持
* 安装命令 ` composer require yoko/tp51-library `
* 案例代码：
控制器需要继承 `library\Controller`，然后`$this`就可能使用全部功能
```php
// 定义 MyController 控制器
class MyController extend \library\Controller {

    // 指定当前数据表名
    protected $dbQuery = '数据表名';
    
    // 显示数据列表
    public function index(){
        $this->_page($this->dbQuery);
    }
    
    // 当前列表数据处理
    protected function _index_page_filter(&$data){
         foreach($data as &$vo){
            // @todo 修改原列表
         }
    }
    
}
```
* 必要数据库表SQL（sysconf 函数需要用到这个表）
```sql
CREATE TABLE `system_config` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '配置名',
  `value` varchar(500) DEFAULT NULL COMMENT '配置值',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_system_config_name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统配置';
```

## 列表处理
```php
// 列表展示
$this->_page($dbQuery, $isPage, $isDisplay, $total);

// 列表展示搜索器（按 name、title 模糊搜索；按 status 精确搜索）
$this->_query($dbQuery)->like('name,title')->equal('status')->page();

// 对列表查询器进行二次处理
$query->_query($dbQuery)->like('name,title')->equal('status');
$db = $query->db(); // @todo 这里可以对db进行操作
$this->_page($db); // 显示列表分页
```

## 表单处理
```php
// 表单显示及数据更新
$this->_form($dbQuery, $tplFile, $pkField , $where, $data);
```

## 删除处理
```php
// 数据删除处理
$this->_deleted($dbQuery);
```

## 禁用启用处理
```php
// 数据禁用处理
$this->_save($dbQuery,['status'=>'0']);

// 数据启用处理
$this->_save($dbQuery,['status'=>'1']);
```

## 文件存储组件（ oss 及 qiniu 需要配置参数）
```php

// 配置默认存储方式    
sysconf('storage_type','文件存储类型');

// OSS存储配置
sysconf('storage_oss_domain', '文件访问域名');
sysconf('storage_oss_keyid', '接口授权AppId');
sysconf('storage_oss_secret', '接口授权AppSecret');
sysconf('storage_oss_bucket', '文件存储空间名称');
sysconf('storage_oss_is_https', '文件HTTP访问协议');
sysconf('storage_oss_endpoint', '文件存储节点域名');

// 七牛云存储配置
sysconf('storage_qiniu_region', '文件存储节点');
sysconf('storage_qiniu_domain', '文件访问域名');
sysconf('storage_qiniu_bucket', '文件存储空间名称');
sysconf('storage_qiniu_is_https', '文件HTTP访问协议');
sysconf('storage_qiniu_access_key', '接口授权AccessKey');
sysconf('storage_qiniu_secret_key', '接口授权SecretKey');


// 生成文件名称(链接url或文件md5)
$filename = \library\File::name($url,$ext,$prv,$fun);

// 获取文件内容（自动存储方式）
$result = \library\File::get($filename)

// 保存内容到文件（自动存储方式）
boolean \library\File::save($filename,$content);

// 判断文件是否存在
boolean \library\File::has($filename);

// 获取文件信息
$result = \library\File::info($filename);

//指定存储类型（调用方法）
boolean \library\File::instance('oss')->save($filename,$content);
boolean \library\File::instance('local')->save($filename,$content);
boolean \library\File::instance('qiniu')->save($filename,$content);

$result = \library\File::instance('oss')->get($filename);
$result = \library\File::instance('local')->get($filename);
$result = \library\File::instance('qiniu')->get($filename);

boolean \library\File::instance('oss')->has($filename);
boolean \library\File::instance('local')->has($filename);
boolean \library\File::instance('qiniu')->has($filename);

$resutl = \library\File::instance('oss')->info($filename);
$resutl = \library\File::instance('local')->info($filename);
$resutl = \library\File::instance('qiniu')->info($filename);
```

## 通用数据保存
```php
// 指定关键列更新（$where 为扩展条件）
boolean data_save($dbQuery,$data,'pkname',$where);
```

## 通用网络请求
```php
// 发起get请求
$result = http_get($url,$query,$options);
$result = \library\tools\Http::get($url,$query,$options);

// 发起post请求
$result = http_post($url,$data,$options);
$result = \library\tools\Http::post($url,$data,$options);
```

## emoji 表情转义（部分数据库不支持可以用这个）
```php
// 输入数据库前转义
$content = emoji_encode($content);

// 输出数据库后转义
$content = emoji_decode($content); 
```

## 系统参数配置（基于 system_config 数据表）
```php
// 设置参数
sysconf($keyname,$keyvalue);

// 获取参数
$keyvalue = sysconf($kename);
```

## UTF8加密算法
```php
// 字符串加密操作
$string = encode($content);

// 加密字符串解密
$content = decode($string);
```