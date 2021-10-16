一个简单的PHP图片上传和展示网站
--

安全演示项目，提供图片上传和展示接口。

上传接口
---

* /upfile.php
  * 方法：POST
  * 参数：upfile
  * 上传示例：```curl -F upfile=@public/img/stop.png  http://127.0.0.1:8001/upfile.php```

展示接口
---
* /list.php
  * 在浏览器查看上传的图片

数据接口
---    
* /photos_api.php
  * 获取已上传的图片，返回json数据。
  * 响应数据：```[{id: 0, name: "xxx.png""}]```