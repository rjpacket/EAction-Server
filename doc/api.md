### 1.Header通用参数

|参数|类型|描述|
|:-|:-|:-|
|version|String|版本号，比如100|
|app_type|String|app的平台类型，比如ios/android/web|
|version_code|String|版本代号1.0.0|
|device_id|String|设备号|
|model|String|手机型号，比如HUAWEI-P20|
|sign|String|请求的验签，由固定算法得出，保证每条请求sign的唯一性，暂时不需要|
|imei|String|手机imei|
|application_id|String|apk的包名|
|mac_address|String|手机的mac地址|
|channel|String|手机的渠道号|
|brand|String|手机品牌|
|time_stamp|String|时间戳|
|osversion|String|手机系统版本|
|access_user_token|String|登录用户的验证token，如果有需要带上|

### 2.登录接口

|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/login|
|phone|String|手机号|
|code|String|验证码，如果密码登录不传code|
|password|String|密码，如果验证码登录不传password|

### 3.获取验证码接口

|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/getcode|
|phone|String|手机号|

### 4.退出登录接口

|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/logout|