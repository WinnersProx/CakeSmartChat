<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Chronos\Chronos;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    //For my plugin
   // public $helpers = ['Media'];


    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        // $this->request->allowMethod('ajax');
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
            'authenticate' => [
                    'Form' => [
                        'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                        ]
                    ]
                ],
                'authError' => 'To access this page please login first!',
                'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
                ],
                'storage' => 'Session',
            // Si pas autorisé, on renvoit sur la page précédente
            'unauthorizedRedirect' => $this->referer(),
        ]);
        
        //Update the status of my users while logged in
        //change the status of live users
        $reloaded = $this->request->env('HTTP_CACHE_CONTROL');
        if(isset($reloaded) && $reloaded == 'max-age=0'){
            $userId = $this->Auth->user('id');
            $this->loadModel('Users');
            $dB = $this->Users->connectTocake();
            $checkUser = $dB->newQuery()
            ->select('*')
            ->from('live_users')
            ->where(['user_id' => $userId])
            ->execute();

            $count = boolval($checkUser->rowCount());
            if($count){
                $curTime = Chronos::parse('- 7 hours');
                $update = $dB->newQuery()
                ->update('live_users')
                ->set(['created_at' => $curTime, 'live_status' => 1])
                ->where(['user_id' => $userId])
                ->execute();

            }
        }
        //Updating the status of my users while logged in
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function getCurrentDate(){
        $now = Chronos::parse('- 7 hours');
        return $now;
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        $this->set('LoggedUser', $this->request->session()->read('Auth'));
        $this->set('curDate', $this->getCurrentDate());
    }
    /*public function beforeFilter(Event $event){
        if($this->RequestHandler->isAjax()){
            $this->layout = null;
        }

    }*/

}
