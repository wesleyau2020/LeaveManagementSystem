<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveDetails Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\LeaveDetail newEmptyEntity()
 * @method \App\Model\Entity\LeaveDetail newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveDetail findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LeaveDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveDetail[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveDetail|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveDetail saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveDetail[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveDetail[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveDetail[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveDetail[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LeaveDetailsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('leave_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('leave_type_id')
            ->requirePresence('leave_type_id', 'create')
            ->notEmptyString('leave_type_id');

        $validator
            ->scalar('year')
            ->requirePresence('year', 'create')
            ->notEmptyString('year');

        $validator
            ->numeric('carried_over')
            ->requirePresence('carried_over', 'create')
            ->notEmptyString('carried_over');

        $validator
            ->numeric('max_carry_over')
            ->requirePresence('max_carry_over', 'create')
            ->notEmptyString('max_carry_over');

        $validator
            ->numeric('entitled')
            ->requirePresence('entitled', 'create')
            ->notEmptyString('entitled');

        $validator
            ->numeric('balance')
            ->requirePresence('balance', 'create')
            ->notEmptyString('balance');

        $validator
            ->numeric('earned')
            ->requirePresence('earned', 'create')
            ->notEmptyString('earned');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
