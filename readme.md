## About

一些简单物流公司抓取接口的查询整合，理论上没有请求次数限制，不保证长期有效，有时间会陆续增加

## Support

✅ 代表暂时有效

🚧 代表施工中

❌ 代表失效或因有验证需要crack

| 快递公司     | 常量名          | 抓取类型       | 支持       | 添加日期      | 备注|       失效日期
| :-----:      | :-----:         | :-----:        | :-----:    | :-----:       | :-----:     | :-----:
| 申通         | TYPE_STO        | 简单API        | ✅         | 2019-08-19
| 圆通         | TYPE_YTO        | 简单API        | ✅         | 2019-08-19    | 注意请求频率
| 中通         | TYPE_ZTO        | 简单API        | ✅         | 2019-08-19
| 百世快递     | TYPE_BSET       | HTML正则       | ✅         | 2019-08-27
| 丹鸟快递     | TYPE_DANN       | 简单API        | ✅         | 2019-08-29
| 中国邮政     | TYPE_CHPO       | API            | ✅         | 2019-08-30    | 滑动验证码
| 顺丰         |                 |                | ❌
| 韵达         |                 |                | ❌
| 天天快递     |                 |                | ❌         |               | 苏宁滑动验证码
| 17track     |                 |   API             | 🚧         |               | js加密

## TODO
* 重新整理readme...
* 整合17track

## Install
```sh
composer require sockball/logistics
```

## Require
部分物流需要 `python3` 支持，如中国邮政；

* `php >= 7.1`，并启用 `exec`函数
* `python >= 3` 并安装模块 `cv2 requests numpy`：`pip install opencv-python requests numpy`

## Demo
```php
use sockball\logstics\Logistics;
use sockball\logistics\base\Trace;

// 圆通
$waybillNo = 'YT4234858984188';

$logistics = Logistics::getInstance();
$response = $logistics->query(Logistics::TYPE_YTO, $waybillNo);

if ($response->isSuccess())
{
    foreach ($response as $trace)
    {
        /** @var Trace $trace */
        // echo $trace->timestamp;
        // echo $trace->state;
        echo $trace->info . "\n";
    }
    // print_r($response->getLatest());
    // print_r($response->getAll());
    // print_r($response->getRaw());
}
else
{
    echo $response->getError();
}
```
或
```sh
git clone https://github.com/sockball/logistics.git
cd logistics
composer install

./vendor/bin/phpunit tests/
...
```

方法示例
```php
// '暂无信息'
$response->getError();

// 直接读取最新的物流信息
$response->timestamp;
$response->info;

// 遍历物流信息 或 getAll() 后再遍历
foreach ($response as $trace)
{
    echo $trace->info;
}

// 获取原请求数据
$response->getRaw();
```

## License
[MIT](https://github.com/sockball/logistics/blob/master/LICENSE)
