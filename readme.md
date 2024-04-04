
## 功能简述
- 在线展示简历，多端自适应，且支持下载
- 简历被查看时，发送邮件提醒，附带查看者位置及设备信息
- 简历浏览结束时，发送邮件提醒，附带浏览时长

![](https://unsignedzhang.cn/wp-content/uploads/2024/04/QQ截图20240404152848-300x141.png)
![](https://unsignedzhang.cn/wp-content/uploads/2024/04/qq_pic_merged_1712215705567-300x162.jpg)

## 为什么要做这个？
- 某招聘软件的在线简历功能太难用了，而且还非填不可，它默认给HR看的只有它的在线简历。可是我明明花心思做好了简历，我就想用我自己的。
- 某公司HR看都没看简历就给我拒了，故想到做此功能，让我清楚简历什么时候被查看，看了多久

## 使用说明
> 本项目主要使用的是心跳检测机制，以实现对浏览时长的准确监测。后端使用的是PHP实现，你也可以换成任意你喜欢的后端代码，比如Python或NodeJS

1. 源码已开源在GitHub，请下载并自行部署好PHP环境
[https://github.com/unsignedzhang/resume](https://github.com/unsignedzhang/resume "https://github.com/unsignedzhang/resume")

2. 将pdfjs.7z解压到pdfjs目录中，然后将你的简历放到/pdfjs/web/目录下，修改index.html中以下代码，将file=后的文件名改为你的文件名
```html
<div id="pdf-container">
        <iframe id="pdf-iframe" src="pdfjs/web/viewer.html?file=template.pdf" frameborder="0" width="100%" height="100%"></iframe>
    </div>
```
3. 修改config.php、main.php里的邮箱配置，如何配置请自行Google
4. 在heartbeat.php和check_heartbeat.php中，填入你的接收邮件地址
5. 配置定时脚本，用以检测心跳是否结束。
下面以宝塔面板为例，简述如何配置：*也可用cron job等*
a. 进入宝塔面板，打开计划任务页面
b. 添加新的计划任务：访问URL（你的check_heartbeat.php的URL），设置定时任务时间，1分钟。
6. 配置都已完成后，访问你的项目地址，即可看到效果了。

## 感谢以下项目
[LapisCV - 开箱即用的 Obsidian / Typora 简历](https://github.com/BingyanStudio/LapisCV "https://github.com/BingyanStudio/LapisCV")

[https://mozilla.github.io/pdf.js/](https://mozilla.github.io/pdf.js/ "https://mozilla.github.io/pdf.js/")

[https://github.com/PHPMailer/PHPMailer](https://github.com/PHPMailer/PHPMailer "https://github.com/PHPMailer/PHPMailer")

另外感谢Kimi智能助手😄，帮我写了90%的代码
