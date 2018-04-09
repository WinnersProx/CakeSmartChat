<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * Communities Model
 *
 * @property \App\Model\Table\CommunitiesTable|\Cake\ORM\Association\BelongsTo $Communities
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Community get($primaryKey, $options = [])
 * @method \App\Model\Entity\Community newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Community[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Community|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Community patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Community[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Community findOrCreate($search, callable $callback = null, $options = [])
 */
class CommunitiesTable extends Table
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

        $this->setTable('communities');
        $this->setDisplayField('community_id');
        $this->setPrimaryKey('community_id');

        
        $this->belongsTo('Users', [
            'foreignKey' => 'creater_id',
            'joinType' => 'INNER'
        ]);
    }
    public function connectTocake(){
        $dbb = ConnectionManager::get('default');
        //Tests//
        //$this->set(compact($user));
        return $dbb;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('community_name', 'create')
            ->notEmpty('community_name');

        $validator
            ->dateTime('created_time')
            ->notEmpty('created_time');

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
        $rules->add($rules->existsIn(['creater_id'], 'Users'));

        return $rules;
    }
}
