<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Messages Model
 *
 * @property \App\Model\Table\MsTable|\Cake\ORM\Association\BelongsTo $Ms
 *
 * @method \App\Model\Entity\Message get($primaryKey, $options = [])
 * @method \App\Model\Entity\Message newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Message[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Message|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Message patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Message[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Message findOrCreate($search, callable $callback = null, $options = [])
 */
class MessagesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('messages');
        $this->setDisplayField('m_id');
        $this->setPrimaryKey('m_id');

        $this->belongsTo('Ms', [
            'foreignKey' => 'm_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function connectTocake(){
        $dbb = ConnectionManager::get('default');
        //Tests//
        //$this->set(compact($user));
        return $dbb;
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('m_sender')
            ->requirePresence('m_sender', 'create')
            ->notEmpty('m_sender');

        $validator
            ->integer('m_receiver')
            ->requirePresence('m_receiver', 'create')
            ->notEmpty('m_receiver');

        $validator
            ->requirePresence('m_content', 'create')
            ->notEmpty('m_content');

        $validator
            ->dateTime('m_created')
            ->requirePresence('m_created', 'create')
            ->notEmpty('m_created');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['m_id'], 'Ms'));

        return $rules;
    }
}
