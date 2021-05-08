<?php

class AutoRoomAssign {

    /**
     * 入住人员信息列表
     *
     * @var array
     */
    protected $humanList = [];

    /**
     * 房间数组
     *
     * @var array
     */
    protected $roomList = [];


    /**
     * 初始化
     *
     * @param array $humanList 入住人信息，二维数组，[[name=>姓名, uid=>UID, gender=>性别（1男 2女）, room_type=>房间要求(1单人房，2双人房)]]
     * @param array $roomList 空房间数组， 二维数组， [[房间号, 房间类型(1单人房，2双人房)]] 
     */
    public function __construct(array $humanList, array $roomList)
    {
        $this->humanList = $humanList;
        $this->roomList = $roomList;
    }

    /**
     * 分配房间
     *
     * @return array
     */
    public function assign()
    {
        $complete_array = [];



    do {
        $user = $this->humanList[0];

        try {
            $tmp_room = $this->getRoom($user['room_type']);
            if ($tmp_room == false) {
                throw new \Exception('没有可分配房间');
            }
        } catch (\Exception $e) {
            continue;
        }



        $tmp_assign = [
            'room_nu' => $tmp_room[0],
            'room_type' => $tmp_room[1],
            'member'    => [],
        ];
        array_push($tmp_assign['member'], $user);
        array_splice($this->humanList, 0, 1);


        if ($tmp_room[1] == 2) {
            // 双人房，抓一个同房
            $partner = $this->findEqualPartner($user);
            if ($partner != null) {
                array_push($tmp_assign['member'], $partner);
            }
        }

        array_push($complete_array, $tmp_assign);
    } while (count($this->humanList) > 0);


    return $complete_array;
    }

    /**
     * 寻找同住人【双人间时】
     *
     * @param array $user
     * @return array|null
     */
    protected function findEqualPartner($user):?array {
        foreach ($this->humanList as $i => $row) {
            // 性别相等
            if (
                $row['gender'] == $user['gender'] &&
                $row['room_type'] == $user['room_type']
            ) {
                // 同样的房型
                array_splice($this->humanList, $i, 1);
                // $this->humanList = array_merge($this->humanList);
                return $row;
            }
        }
        // 找不到
        return null;
    }


    /**
     * 获取房间
     *
     * @param integer $room_type 房间类型
     * @param boolean $force 强制（有空房就可以）
     * @return array|null
     */
    protected function getRoom($room_type, $force = false) :?array {
        $i = 0;
        foreach ($this->roomList as $i => $room) {
            // 找到相同类型房型
            if ($room[1] == $room_type) {
                array_splice($this->roomList, $i, 1);
                return $room;
            }
        }

        // 找不到，强制升降级
        if ($force == false) {
            if ($room_type == 1) {
                // 找 单人间没有， 升级独享双人间
                $room_type = 2;
            } else if ($room_type == 2) {
                // 找 双人间没有， 降级独享单人间
                $room_type = 1;
            }

            return $this->getRoom($room_type, true);
        }
        // 实在找不到了
        return null;
    }
}
