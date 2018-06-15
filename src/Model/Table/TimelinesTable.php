<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * Timelines Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Timeline get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timeline newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Timeline[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timeline|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timeline patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timeline[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timeline findOrCreate($search, callable $callback = null, $options = [])
 */
class TimelinesTable extends Table
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

        $this->setTable('timelines');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'poster_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'target_id'
        ]);
        $this->hasMany('TimelinesImages')->setForeignKey('related_tmn');
        $this->hasMany('TimelineStars')->setForeignKey('r_timeline');
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
            ->allowEmpty('contents');

        $validator
            ->dateTime('created_at')
            ->allowEmpty('created_at');

        return $validator;
    }
    public function dbConnect(){
        $dbb = ConnectionManager::get('default');
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
        $rules->add($rules->existsIn(['poster_id'], 'Users'));
        $rules->add($rules->existsIn(['target_id'], 'Users'));

        return $rules;
    }
}
