<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\FileSystem\Folder;

/**
 * Communities Controller
 *
 * @property \App\Model\Table\CommunitiesTable $Communities
 *
 * @method \App\Model\Entity\Community[] paginate($object = null, array $settings = [])
 */
class CommunityPostsController extends AppController
{
    public function commentPost($PostId = null){
        $PostId = intval($PostId);
        $memberId = $this->Auth->user('id');
        $checkPost = $this->CommunityPosts->findById($PostId)->count();
        $checkPost = boolval($checkPost);
        $connect = $this->CommunityPosts->connect();
        $datas = $this->request->getData();
        if($checkPost){
            if(isset($datas['mPostComment']) && $datas['mPostComment'] != null){
                $content = $datas['mPostComment'];
                if(mb_strlen($content) >= 3 && mb_strlen($content) <= 255){
                    $relatedPost = $PostId;
                    $newComment = $connect->insert(['member_id', 'content','related_post'])->into('community_post_comments')->values(['member_id' => $memberId, 'content' => $content, 'related_post' => $relatedPost])->execute();

                    if($newComment){
                        $this->Flash->success('Comment added successfully');
                        return $this->redirect($this->referer());
                    }
                    else{
                        $this->Flash->success('Sorry an error has occured try again!!');
                        return $this->redirect($this->referer());
                    }

                }
                else{
                    $this->Flash->success('The length must be between 3 and 255');
                    return $this->redirect($this->referer());
                }
            }
            else{
                $this->Flash->error('Please fill out required fields');
                return $this->redirect($this->referer());
            }
        }
        else{

            $this->Flash->error('Please try again');
            return $this->redirect($this->referer());
        }

    }
    public function shareCommunityPost($postId){
        //fetch the asked community to be shared
        $connect = $this->CommunityPosts->connect();
        $forwardCommunity = $connect
        ->select('*')
        ->from('community_posts cp')
        ->where(['cp.id' => $postId])
        //join is not the good way // use of another way customly in the case it is taking only one picture in all published pictures 
        ->execute();

        if($forwardCommunity->count() > 0){
            $postToShare = $forwardCommunity->fetch('obj');
            //related pictures posted for this post
            
            $this->set(compact('postToShare'));

        }
        else{
            $this->Flash->error('The specified post does not exist');
            return $this->redirect($this->referer());
        }
        


    }
}
