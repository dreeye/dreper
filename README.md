# php常用功能方法


## 字符串类

```php
<?php 
require 'vendor/autoload.php';
use Dreeye\Helper\String_helper;

$randomStr = String_helper::randomString('alnum', 16);

?>
```

## 验证类

```php
<?php 
require 'vendor/autoload.php';
use Dreeye\Helper\Validate_helper;

if(Validate_helper::isMobile('13087637896'))
  echo '手机号格式正确';
  
if(Validate_helper::isDate('2015-07-30','Y-m-d'))
  echo '日期格式正确';

?>
```
