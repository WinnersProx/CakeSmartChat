<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * CommunityMembers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CommunityMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommunityMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CommunityMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommunityMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommunityMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommunityMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommunityMember findOrCreate($search, callable $callback = null, $options = [])
 */
class CommunityMembersTable extends Table
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

        $this->setTable('community_members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'member_id'
        ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('id_community')
            ->allowEmpty('id_community');

        $validator
            ->allowEmpty('member_role');

        return $validator;
    }
    
    public function connectTocake(){
        $dbb = ConnectionManager::get('default');
        //Tests//
        //$this->set(compact($user));
        return $dbb;
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
        $rules->add($rules->existsIn(['member_id'], 'Users'));

        return $rules;
    }
}
