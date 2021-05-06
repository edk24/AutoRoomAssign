<?php

require_once './AutoRoomAssign.php';

$unlist = [
    // [uid, sex(1男，2女), type(1=单人房,2=双人房)]
    [
        'name' => '余小波',
        'uid' => 1,
        'gender'   => 1,
        'room_type' => 1,
    ],
    [
        'name' => '李家平',
        'uid' => 2,
        'gender'   => 1,
        'room_type' => 2,
    ],
    [
        'name' => '马文秀',
        'uid' => 1,
        'gender'   => 2,
        'room_type' => 2,
    ],
    [
        'name' => '李仁珍',
        'uid' => 1,
        'gender'   => 2,
        'room_type' => 2,
    ],
    [
        'name' => '吕刚',
        'uid' => 1,
        'gender'   => 1,
        'room_type' => 2,
    ],
    [
        'name' => '马鹃',
        'uid' => 1,
        'gender'   => 2,
        'room_type' => 2,
    ]
];


$roomList = [
    ['3201', 1],
    ['3202', 1],
    ['3203', 2],
    ['3204', 2]
];



$test = new AutoRoomAssign($unlist, $roomList);
echo json_encode($test->assign());