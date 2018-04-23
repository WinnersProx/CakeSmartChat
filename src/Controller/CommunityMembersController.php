<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CommunityMembers Controller
 *
 * @property \App\Model\Table\CommunityMembersTable $CommunityMembers
 *
 * @method \App\Model\Entity\CommunityMember[] paginate($object = null, array $settings = [])
 */
class CommunityMembersController extends AppController
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
        $communityMembers = $this->paginate($this->CommunityMembers);

        $this->set(compact('communityMembers'));
        $this->set('_serialize', ['communityMembers']);
    }

    /**
     * View method
     *
     * @param string|null $id Community Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $communityMember = $this->CommunityMembers->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('communityMember', $communityMember);
        $this->set('_serialize', ['communityMember']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $communityMember = $this->CommunityMembers->newEntity();
        if ($this->request->is('post')) {
            $communityMember = $this->CommunityMembers->patchEntity($communityMember, $this->request->getData());
            if ($this->CommunityMembers->save($communityMember)) {
                $this->Flash->success(__('The community member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The community member could not be saved. Please, try again.'));
        }
        $users = $this->CommunityMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('communityMember', 'users'));
        $this->set('_serialize', ['communityMember']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Community Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $communityMember = $this->CommunityMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $communityMember = $this->CommunityMembers->patchEntity($communityMember, $this->request->getData());
            if ($this->CommunityMembers->save($communityMember)) {
                $this->Flash->success(__('The community member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The community member could not be saved. Please, try again.'));
        }
        $users = $this->CommunityMembers->Users->find('list', ['limit' => 200]);
        $this->set(compact('communityMember', 'users'));
        $this->set('_serialize', ['communityMember']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Community Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function addCommunityAdmin($communityId = null, $memberId = null){
        $communityId = intval($communityId);
        $memberId = intval($memberId);
        $dB = $this->CommunityMembers->connectTocake();
        $checkMember = $this->CommunityMembers->find()->where(['id_community' => $communityId, 'member_id' => $memberId])->count();
        if($checkMember > 0){
            $newAdmin = $dB->newQuery()->update('community_members')->set(['member_role' => 1])->where(['id_community' => $communityId, 'member_id' => $memberId])->execute();
            if($newAdmin){
                $this->Flash->success('Admin added successfully!');
                return $this->redirect($this->referer());
            }
            else{
                $this->Flash->success('Unable to add admin!');
                return $this->redirect($this->referer());
            }
        }
        else{
            $this->Flash->success('The specified member does not exist!');
            return $this->redirect($this->referer());
        }

    }

    public function removeMember($memberId = null, $communityId = null)
    {
        $this->loadModel('CommunityMembers');
        $this->loadModel('Communities');
        $memberId = intval($memberId) ; $communityId = intval($communityId);
        $connected = $this->Auth->user('id');
        $connect = $this->CommunityMembers->connectTocake();
        $checkAdmin = $this->CommunityMembers->find()->where(['id_community' => $communityId, 'member_id' => $connected, 'member_role' => 1])->count();
        
        //for the current user
        $isCreater = $this->Communities->find()->where(['creater_id' => $connected])->count();$isCreater = boolval($isCreater);

        if($checkAdmin > 0 || $isCreater){
            //for the given user
            $isCreater = $this->Communities->find()->where(['creater_id' => $memberId])->count();$isCreater = boolval($isCreater); 

            if(!$isCreater){
                $deleteMember = $connect->newQuery()->delete()->from('community_members')->where(['member_id' => $memberId, 'id_community' => $communityId])->execute();

                if($deleteMember){
                    $this->Flash->success(__('The member was removed successfully!'));
                }
                else{
                    $this->Flash->error(__('Unable to remove member!')); 

                }
            }
            else{
                $this->Flash->error(__('You do not fulfill permissions to remove the prime Admin'));
            }
            
        }
        else{
            $this->Flash->error(__('You are not allowed to remove a member!'));

        }
        
        return $this->redirect($this->referer());
        
    }


}
