# php常用功能方法


## 基本用法

```php
<?php 
require 'vendor/autoload.php';
use Dreeye\Helper\String_helper;
use Dreeye\Helper\Validate_helper;


$randomStr = String_helper::randomString();

if(Validate_helper::isDate('2015-07-30','Y-m-d'))
  echo '日期格式符合标准';

?>
```
