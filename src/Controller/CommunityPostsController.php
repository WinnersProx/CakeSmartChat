<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\FileSystem\Folder;
use Cake\Chronos\Chronos;
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

    public function newPostShare($postId = null){
        //inserts
        //share-privacy, $related_cpost,share_content
        //checks whether the given post exist
        $curTime = Chronos::parse('- 7 hours');
        $PostId = intval($postId);

        $currentMember = $this->Auth->user('id');
        $connect = $this->CommunityPosts->connect();
        $datas = $this->request->getData();
        $checkPost = $this->CommunityPosts->findById($postId);
        
        if($checkPost->count() > 0){
            $checkPost = $checkPost->first();
            if($this->request->is('post')){
                if(isset($datas['sharePostContent']) && $datas['sharePostContent'] != null){
                    $shareContent = $datas['sharePostContent'];
                    if(mb_strlen($shareContent) > 5){
                        $newShare = $connect->insert(['related_cpost','share_content','privacy', 'member_sharing','dated'])
                        ->into('community_post_shares')->values(['related_cpost' => $postId, 'share_content' => $shareContent, 'privacy' => $datas['sharePrivacy'], 'member_sharing' => $currentMember, 'dated' => $curTime])->execute();
                        if($newShare){
                            $this->Flash->success('You have shared a post from this community');
                            return $this->redirect(['controller' => 'communities', 'action' => 'view', $checkPost['target_community']]);

                        }
                        else{

                            $this->Flash->error('Unable Try again!!!');
                            return $this->redirect(['controller' => 'communities', 'action' => 'view', $checkPost['target_community']]);
                        }
                    }
                    else{
                        $this->Flash->error('Please the length must be  at least 5');
                        return $this->redirect(['controller' => 'communities', 'action' => 'view', $checkPost['target_community']]);
                    }
                }
                


            }

        }
        else{
            $this->Flash->error('Please the specified community does not exist!');
            return $this->redirect($this->referer());
        }
        


    }
    public function ratePost($postId = null){
        $postId = intval($postId);
        $curTime = Chronos::parse('- 7 hours');
        $curUser = $this->Auth->user('id');
        $connect = $this->CommunityPosts->connect();
         $checkPost = $this->CommunityPosts->findById($postId);
         if($checkPost->count() > 0){
        
                $checksIfrated = $connect->select('*')->from('community_post_rates')->where(['user_rate' => $curUser, 'related_post' => $postId])->execute()->count();
                $checksIfrated = boolval($checksIfrated);
                if(!$checksIfrated){
                    $newRate = $connect->insert(['user_rate', 'related_post'])->into('community_post_rates')->values(['user_rate' => $curUser, 'related_post' => $postId])->execute();
                    if($newRate){
                        $this->Flash->success('post rated successfully');
                        return $this->redirect($this->referer());
                    }
                    else{
                        $this->Flash->success('unable to rate this post!');
                        return $this->redirect($this->referer());

                    }
                }
                else{
                    //dd($checksIfrated);
                    $removeRate = $connect->delete()
                    ->where(['user_rate' => $curUser , 'related_post' => $postId])
                    ->execute();
                    if($removeRate){
                        $this->Flash->success('rate removed successfully');
                        return $this->redirect($this->referer());
                    }
                    else{
                        $this->Flash->success('unable to remove rate');
                        return $this->redirect($this->referer());
                    }

                }
         }
         
    }
}
