<?php
/**
 * 点击榜Model
 * User: huangfuhui
 * Date: 2017/9/17
 * Email: huangfuhui@outlook.com
 */

namespace Home\Model;

use Think\Model;

class StoryTopClickModel extends Model
{
    /**
     * 获取点击榜信息
     * @param int $start
     * @param int $limit
     * @return mixed
     */
    public function getTopClick($start = 0, $limit = 20)
    {
        $res = $this->order('id asc')->limit($start, $limit)->select();
        foreach ($res as $k => $v) {
            $res[$k]['md5'] = md5($v['story_name'] . '|' . $v['author']);
        }
        return $res;
    }

    /**
     * 批量更新点击榜
     * note:当前策略是删除旧榜单，维持表中数据的新鲜度
     * @param $data
     */
    public function updateTopClick($data)
    {
        $this->addAll($data);
    }

    /**
     * 清除点击榜数据
     */
    public function cleanTopClick()
    {
        // 删除旧数据
        $this->where(array('id' => array('gt', 0)))->delete();
    }
}