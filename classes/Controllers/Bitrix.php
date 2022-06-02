<?php

namespace Controller;

class Bitrix
{
    public static function close_taks($taskId)
    {
        $request = \WpOrg\Requests\Requests::get("https://tarefas.redeunifique.com.br/rest/2831/axbu0ga5vl835623/tasks.task.complete.json?taskId=$taskId");
        return $request->status_code;
    }

    public static function add_comment($taskId, $msg)
    {
        $data = array("fields" => array("POST_MESSAGE" => $msg));
        $request = \WpOrg\Requests\Requests::post("https://tarefas.redeunifique.com.br/rest/2831/axbu0ga5vl835623/task.commentitem.add?taskId=$taskId", array(), $data);
        return $request->status_code;
    }
}
