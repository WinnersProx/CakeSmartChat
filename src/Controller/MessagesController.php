<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 *
 * @method \App\Model\Entity\Message[] paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{

   

    public function l($idReceiver = null){
        //setup messages status
        //$idReceiver = intval($idReceiver);
        $connection = $this->Messages->connectTocake();
        $connected = $this->Auth->user('id');
        $newStatus = $connection->newQuery()
        ->update('messages')
        ->set(['m_status' => 1])
        ->where(['m_receiver' => $connected, 'm_status !=' => 2])
        ->execute();


        if($idReceiver != null){
            $receiverId = intval($idReceiver);
            $connected = $this->Auth->user('id');
            $updateStatus = $connection->newQuery()
            ->update('messages')
            ->set(['m_status' => 2])
            ->where(['m_sender' => $receiverId, 'm_receiver' => $connected,'m_status !=' => 2])
            ->execute();
           
            
            
        }
        if($idReceiver == null){
            $receiverId = $this->Messages->find()->where(['m_sender' => $connected])->last()['m_receiver'];
        }
        $this->set(compact('receiverId'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
            $this->Flash->success(__('The message has been deleted.'));
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'l']);
    }
    public function sendMessage($msgReceiver = null){
        $datas = $this->request->getData();

        $dB = $this->Messages->connectTocake();
        $currentUser = $this->request->session()->read('Auth')['User']['id'];
        $msgContent = $datas['msgSender'];
        if($msgReceiver != null){
            if(strlen($msgContent) >= 2 && strlen($msgContent) <= 255){
                $this->loadModel('Users');
                $found = $this->Users->findById($msgReceiver)->first();
                $found = boolval($found);
                if($found){
                    $newMsg = $dB->newQuery()
                    ->insert(['m_sender', 'm_receiver', 'm_content'])
                    ->into('messages')
                    ->values(['m_sender' => $currentUser, 
                        'm_receiver' => $msgReceiver, 
                        'm_content' => $msgContent
                    ])
                    ->execute();
                }
            }
            else{
                die('The message length must be between 2 and 255');
            }
            
        }
        else{
            die('Page Not found : Wrong parameters!!!');
        }
        if(!($this->request->is('ajax'))){
            if(isset($msgReceiver)){
                $this->redirect(['controller' => 'messages', 'action' => 'l', $msgReceiver]);
            }
            else{
                $this->Flash->success('Please Choose the one to Chat with');
                $this->redirect(['controller' => 'messages', 'action' => 'l']);
            }
            
        }

        
    }
    public function listMessages($tFriend){
        
        $tFriend = intval($tFriend);
        $connectedId = $this->request->session()->read('Auth')['User']['id'];
        $connect = $this->Messages->connectTocake();
        // $messages = $this->Messages->find()
        // ->where(['Messages.m_sender' => $connectedId,'Messages.m_receiver' => $tFriend])
        // ->orwhere(['Messages.m_receiver' => $connectedId, 'Messages.m_sender' => $tFriend]);
         $messages = $connect->newQuery()
         ->select('*')
         ->from('messages')
         ->join([
            'table' => 'users',
            'alias' => 'u',
            'type'  => 'LEFT',
            'conditions' => 'u.id = m_sender'
         ])
         ->where(['m_sender' => $connectedId,'m_receiver' => $tFriend])
         ->orwhere(['m_receiver' => $connectedId,'m_sender' => $tFriend])
         ->execute()
         ->fetchAll('assoc');
         $this->set(compact('messages'));
         $this->set(compact('connectedId'));
        
        
    }
}
