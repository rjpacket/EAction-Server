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

### 5.通用上传图片接口

#### 5.1 直接请求后台支持的上传类型，目前支持七牛和本地两种

|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/uploadImageType|

#### 5.2 如果是七牛，前端上传之后拿到ImageUrl调用更新接口，参考更换头像接口

#### 5.3 如果是本地，需要继续调用下面接口

|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/localUploadImage|
|file|图片文件，低于2M|记住设置ContentType为from-data(存疑)|

### 6.更换头像接口
|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/image|
|image|String|七牛返回的图片地址|

### 7.更新用户信息
|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/user|
|username|String|用户名|
|sex|String|用户性别|
|signature|String|个性签名|
|password|String|密码，密码的修改需要验证是否匹配之前的密码|

### 8.发表社区动态
|参数|类型|描述|
|:-|:-|:-|
|url|post|/api/v1/sendTalk|
|content|String|发表的内容|
|imageUrls|String|可选，逗号拼接的七牛图片地址|

### 9.获取社区动态
|参数|类型|描述|
|:-|:-|:-|
|url|get|/api/v1/talk|
|page|int|页数， 从1开始|
|size|int|每一页的个数， 默认10|