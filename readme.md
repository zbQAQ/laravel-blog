
## About THIS

该项目是个人学习laravel的项目，有实现 后台管理系统、文章的增删查改、商品的各类操作，还有前端api接口实现，主要服务于我的另一个vue项目[（链接）](https://gitee.com/zbQAQ/vue-myLibrary)

## PROJECT MIGRATION

- 首先要有composer环境[（安装地址）](https://www.phpcomposer.com/)
- 然后需要 php 运行环境 我这里使用的laragon[（安装地址）](https://laragon.org/)  

- 在www文件夹下中克隆git远程版本库 https://gitee.com/zbQAQ/laravel-blog
- 执行composer install安装依赖 
- 执行php artisan key:generate生成key 
- 创建数据库 运行sql文件下日期最新的sql文件
- 配置.env  
- 主要这 几行  DB_DATABASE=laravel-blog <br/>
              DB_PREFIX=blog_ <br/>
              DB_USERNAME=root <br/>
              DB_PASSWORD= <br/>
- Then  就在laragon下可以跑啦

## 最后

个人是前端新手，喜欢钻研新鲜的技术，如果你对此有什么意见可以邮箱(1290368140@qq.com)我，我会认真看并且采纳的谢谢。

