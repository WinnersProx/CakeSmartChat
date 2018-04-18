<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Communities Controller
 *
 * @property \App\Model\Table\CommunitiesTable $Communities
 *
 * @method \App\Model\Entity\Community[] paginate($object = null, array $settings = [])
 */
class CommunitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $communities = $this->paginate($this->Communities);

        $this->set(compact('communities'));
        $this->set('_serialize', ['communities']);
    }


    /**
     * View method
     *
     * @param string|null $id Community id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($communityName)
    {
        $targetCommunity = $this->Communities->find()->where(['community_name' => $communityName])->first();
        if($targetCommunity){
            
            $this->set(compact('targetCommunity'));
        }
        else{
            $this->Flash->error('Please the specified community does not exist');
            return $this->redirect(['action' => 'index']);
        }
       
        //$this->set('community', $community);
        //$this->set('_serialize', ['community']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $community = $this->Communities->newEntity();
        if ($this->request->is('post')) {
            $community = $this->Communities->patchEntity($community, $this->request->getData());
            if ($this->Communities->save($community)) {
                $this->Flash->success(__('The community has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The community could not be saved. Please, try again.'));
        }
        $communities = $this->Communities->find('list', ['limit' => 200]);
        $users = $this->Communities->Users->find('list', ['limit' => 200]);
        $this->set(compact('community', 'communities', 'users'));
        $this->set('_serialize', ['community']);
    }
    public function newCommunity(){
        $connection = $this->Communities->connectTocake();
        $creater = $this->Auth->user('id');
        $newCommunity = $this->Communities->newEntity();

        $communityDatas = $this->request->getData();

        $existIn = $this->Communities->find()->where(['community_name' => $communityDatas['community_name']])->first();

        if($existIn){
            $this->Flash->error('Already exist please use a different name');
            return $this->redirect(['action' => 'create']);
        }
        

        $communityDatas['creater_id'] != $creater 
        ? $communityDatas['creater_id'] = $creater 
        : $communityDatas['creater_id'] = $communityDatas['creater_id'];

        if($this->request->is('post')){
            //$newCommunity = $this->Communities->patchEntity($newCommunity, $communityDatas);

            $c_name = $communityDatas['community_name'];
            $c_id = $communityDatas['creater_id'];
            $c_description = $communityDatas['description'];

            $newComm = $connection->newQuery()
            ->insert(['creater_id', 'community_name', 'com_description'])
            ->into('communities')
            ->values(['creater_id' => $c_id, 'community_name' => $c_name, 'com_description' => $c_description])
            ->execute();

            if($newComm){
                $idCommunity = $this->Communities->find()->last()['id'];
                
                if(isset($communityDatas['addMember'])){
                    $members = $communityDatas['addMember'];
                    foreach ($members as $member){
                        $member_role = 0;

                        $member == $creater ? $member_role = 1 : $member_role = 0;
                        //
                        $newMembers = $connection->newQuery()
                        ->insert(['id_community','member_id', 'member_role'])
                        ->into('community_members')
                        ->values([
                            'id_community' => $idCommunity,
                            'member_id'    => $member,
                            'member_role'  => $member_role

                        ])
                        ->execute(); 
                    }
                }
                $this->Flash->success('Congratulation You have created a new community!!!');
                return $this->redirect(['action' => 'index']);

            }
            else{
                $this->Flash->success('The new Community could not be saved!!!');
                return $this->redirect(['action' => 'create']);
            }
        }
        else{
            $this->Flash->success('Please post something!!!');
            return $this->redirect(['action' => 'create']);

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Community id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $community = $this->Communities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $community = $this->Communities->patchEntity($community, $this->request->getData());
            if ($this->Communities->save($community)) {
                $this->Flash->success(__('The community has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The community could not be saved. Please, try again.'));
        }
        $communities = $this->Communities->Communities->find('list', ['limit' => 200]);
        $users = $this->Communities->Users->find('list', ['limit' => 200]);
        $this->set(compact('community', 'communities', 'users'));
        $this->set('_serialize', ['community']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Community id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $community = $this->Communities->get($id);
        if ($this->Communities->delete($community)) {
            $this->Flash->success(__('The community has been deleted.'));
        } else {
            $this->Flash->error(__('The community could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function joinCommunity($communityId = null){
        $communityId = intval($communityId);
        
        $connected = $this->Auth->user('id');
        $this->loadModel('CommunityMembers');
        $connect = $this->Communities->connectTocake();

        $memberExist = $this->CommunityMembers->find()->
        where(['id_community' => $communityId, 'member_id' => $connected])
        ->first();
        if(!$memberExist){
            $newMember = $connect->newQuery()
            ->insert(['id_community', 'member_id'])
            ->into('community_members')
            ->values(['id_community' => $communityId, 'member_id' => $connected])
            ->execute();
            if($newMember){
                $this->Flash->success('Community joined successfully');
                return $this->redirect(['action' => 'view', $communityId]);
            }
            else{
                $this->Flash->success('Please the community could not be joined');
                return $this->redirect(['action' => 'view', $communityId]);
            }
        }
        
    }
    public function create(){

    }
    public function newPost($currentCommunity = null){
        $sessionUser = $this->Auth->user('id');
        $connect = $this->Communities->connectTocake();
        if($this->request->is('post')){
            if($currentCommunity != null){
                //$previous = $this->referer();
                //$toArray = split('/', $previous);
                $datas = $this->request->getData();
                $postContent = $datas['community-post-content'];
                $postPictures = $datas['post-pictures'];
                $postPrivacy = $datas['post-privacy'];

                if(isset($postContent) && $postContent != null){
                    if(mb_strlen($postContent > 5) || mb_strlen($postContent < 500)){
                        $checkCommunity = $this->Communities->find()->where(['community_name' => $currentCommunity])->count();
                        if($checkCommunity){

                            $newPost = $connect->newQuery()->insert(['member_poster', 'post_content', 'privacy', 'target_community'])->into('community_posts')->values(['member_poster' => $sessionUser, 'post_content' => $postContent, 'privacy' => $postPrivacy, 'target_community' => $currentCommunity])
                            ->execute();
                            if($newPost){
                                $this->Flash->success("Post added successfully!!");
                                //for files upload depending on our communities post
                                $lastId = $connect->newQuery()->select('id')->from('community_posts')->order(['id' =>'DESC'])->limit(1)->execute()->fetch('assoc')['id'];
                                
                                if(isset($postPictures) && $postPictures != null){
                        
                                    //Now to download my avatar
                                    foreach ($postPictures as $file) {
                                    //$file = $postPictures;
                                        $fileName = $file['name'];
                                        $targetFolder= 'img/communities/pictures/'.$sessionUser;
                                        $fileExt = strrchr($fileName,'.');
                                        $tmp_name = $file['tmp_name'];
                                        $randomFileName = md5(uniqid(rand())).''.$fileExt;
                                        $filePath = $_SERVER['DOCUMENT_ROOT'].'/'.$targetFolder;
                                        $userFile = $filePath . '/' .$randomFileName;
                                        if(!file_exists($filePath)){
                                            mkdir($filePath, 0755, true);
                                        }
                                        $allowedExt = ['.png', '.jpeg','.jpg','.PNG','.JPG','.JPEG'];
                                        if(in_array($fileExt, $allowedExt)){
                                            if(move_uploaded_file($tmp_name, $userFile)){
                                                $avatar_url = 'communities/pictures/'.$sessionUser. '/'.$randomFileName;
                                                $postImgs = $connect
                                                ->newQuery()
                                                ->insert(['picture_url', 'target_post'])
                                                ->into('community_pictures')
                                                ->values(['picture_url' => $avatar_url, 'target_post' => $lastId])
                                                ->execute();
                                            }
                                            else{
                                                $this->Flash->warning(__('The file could not be uploaded'));
                                            }
                                        }
                                    }
                                }
                                //for files upload depending on our communities post
                                return $this->redirect($this->referer());
                            }
                            else{
                                $this->Flash->error('Unable to post try again!!!');
                                return $this->redirect($this->referer());
                            }

                        }
                        else{
                            $this->Flash->error('The specified community does not exist');
                            return $this->redirect($this->referer());
                        }
                    }
                    else{
                        $this->Flash->error('Please the length must be between 5 and 500');
                        return $this->redirect($this->referer());
                    }
                }
                else{
                    $this->Flash->error('Please fill out required fields');
                    return $this->redirect($this->referer());
                }

                

            }
            else{
                $this->Flash->error('No specified community');
                return $this->redirect(['action' => 'index']);
            }
        }
        else{
            $this->Flash->error('Please Try again!!');
            return $this->redirect($this->referer());
        }
        
    }
}
