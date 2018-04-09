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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $communityMember = $this->CommunityMembers->get($id);
        if ($this->CommunityMembers->delete($communityMember)) {
            $this->Flash->success(__('The community member has been deleted.'));
        } else {
            $this->Flash->error(__('The community member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
