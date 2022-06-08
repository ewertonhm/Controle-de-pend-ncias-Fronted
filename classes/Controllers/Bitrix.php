<?php

namespace Controller;

class Bitrix
{
    public static function close_taks($taskId)
    {
        $request = \WpOrg\Requests\Requests::get("https://tarefas.redeunifique.com.br/rest/3193/ibmuy2znlh429csn/tasks.task.complete.json?taskId=$taskId");
        return $request->status_code;
    }

    public static function add_comment($taskId, $msg)
    {
        $data = array("fields" => array("POST_MESSAGE" => $msg));
        $request = \WpOrg\Requests\Requests::post("https://tarefas.redeunifique.com.br/rest/3193/ibmuy2znlh429csn/task.commentitem.add?taskId=$taskId", array(), $data);
        return $request->status_code;
    }
}
