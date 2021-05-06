# AutoRoomAssign

> 酒店单人间双人间房间自动分配算法

根据人数、性别、需要单人房or双人房来进行排房；

**双人房规则**

- 相同性别的同住
- 双人房不够了，自动升级为空的单人间
- 房间不够用了，抛出`\Exception`异常

**单人房规则**

- 单人一间房
- 单人间不够时，升级为双人间
- 房间不够用了，抛出`\Exception`异常

## 演示

查看`Example.php`文件


## 运行

配置好php环境变量

```json
$ php Example.php

[
  {
    "room_nu": "3201",
    "room_type": 1,
    "member": [
      {
        "name": "余小波",
        "uid": 1,
        "gender": 1,
        "room_type": 1
      }
    ]
  },
  {
    "room_nu": "3203",
    "room_type": 2,
    "member": [
      {
        "name": "李家平",
        "uid": 2,
        "gender": 1,
        "room_type": 2
      },
      {
        "name": "吕刚",
        "uid": 1,
        "gender": 1,
        "room_type": 2
      }
    ]
  },
  {
    "room_nu": "3204",
    "room_type": 2,
    "member": [
      {
        "name": "马文秀",
        "uid": 1,
        "gender": 2,
        "room_type": 2
      },
      {
        "name": "李仁珍",
        "uid": 1,
        "gender": 2,
        "room_type": 2
      }
    ]
  }
]
```

*linux用户强烈推荐一个软件`jq`，执行`php Example.php|jq`时自动格式化json字符串；apt和yum源直接安装jq就可以了*