<?php
namespace app\index\controller;

use app\index\model\Article;
use app\index\model\Banner;
use app\index\model\Comment;
use app\index\model\TagList;
use app\index\model\User;

class Index
{
    protected      $status=200;
    protected      $response=['access-control-allow-origin:*','access-control-max-age:3600'];
    public function index()
    {
        return '55';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function article($num=0){
        $result=[];

        $article=Article::limit($num,2)->select();

        foreach($article as $val){
            $result[]=[
                    'img'=>$val->art_img_url,
                    'title'=>$val->art_title,
                    'more'=>$val->art_more,
                    'content'=>$val->art_content,
                    'auther'=>$val->art_auther,
                    'profile'=>$val->art_profile,
                    'date'=>$val->update_time,
                    'concern'=>$val->art_hot,
                    'comment'=>$val->art_comment
                ];
        }

        return json($result);
    }
    /*
     * @params $typedata
     * side的文章卡片
     */
    public function cart($typeData='latest_article'){
        $data=[
            'latest_article'=>[], 'hot_article'=>[], 'comment_article'=>[],
        ];
        $result=[];

        if(!isset($data[$typeData])){
//            header('status:404');
//            return json(null,404);
            return ;
        }

        $latest_article=Article::limit(0,8)->select();
        $hot_article=Article::order('art_hot asc')->limit(1)->select();
        $comment_article=Article::order('art_comment asc')->limit(1)->select();

        $data=[
            'latest_article'=>$latest_article, 'hot_article'=>$hot_article, 'comment_article'=>$comment_article,
        ];

        foreach($data as $index=>$vals){
            foreach($vals as $val){
                $result[$index]=[                'img'=>$val->art_img_url,
                    'title'=>$val->art_title,
                    'more'=>$val->art_more,
                    'content'=>$val->art_content,
                    'auther'=>$val->art_auther,
                    'profile'=>$val->art_profile,
                    'date'=>$val->update_time,
                    'concern'=>$val->art_hot,
                    'comment'=>$val->art_comment];
//                dump($result[$index]);
            }

        }

        return json($result,$this->status,$this->response);
    }

    /*
     *
     * 标签卡片
     */
    public function tag_list(){
        $result=[];
        $tagList=TagList::limit(20)->select();
        foreach($tagList as $val){
            $result[]=[
                'name'=>$val['tag_name'],
                'num'=>$val['tag_num'],
                'tagurl'=>$val['tag_url'],
                'color'=>$val['tag_color']
            ];
        }
        return json($result,$this->status,$this->response);
    }

    public function comment(){
        $result=[];

        $comment=Comment::limit(10)->select();
//        dump($comment);
        foreach($comment as $index=>$val){
//            echo $val['com_img_url'];
            $result[]=[
                'img'=>$val['com_img_url'],
                'title'=>$val['com_title'],
                'content'=>$val['com_content']
            ];
        }
        return json($result,$this->status,$this->response);
    }

    public function user(){
        $user=User::limit(null,1)->select();
        return json($user);
    }

    public function banner(){
        $result=[];
    $banner=Banner::limit(10)->select();
    foreach ($banner as $val){
        $result[]=[
            'img'=>$val->ban_img,
            'title'=>$val->ban_title,
            'content'=>$val->ban_content,
            'url'=>$val->ban_url,
            'more'=>$val->ban_more
        ];
    }
    return json($result,$this->status,$this->response);
    }

}
