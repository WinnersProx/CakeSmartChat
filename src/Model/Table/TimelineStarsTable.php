<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TimelineStars Model
 *
 * @property \App\Model\Table\STable|\Cake\ORM\Association\BelongsTo $S
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\TimelineStar get($primaryKey, $options = [])
 * @method \App\Model\Entity\TimelineStar newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TimelineStar[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TimelineStar|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TimelineStar patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TimelineStar[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TimelineStar findOrCreate($search, callable $callback = null, $options = [])
 */
class TimelineStarsTable extends Table
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

        $this->setTable('timeline_stars');
        $this->setDisplayField('s_id');
        $this->setPrimaryKey('s_id');

        $this->belongsTo('S', [
            'foreignKey' => 's_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->integer('r_timeline')
            ->allowEmpty('r_timeline');

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
        $rules->add($rules->existsIn(['s_id'], 'S'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
