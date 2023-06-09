<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveRequests Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LeaveTypeTable&\Cake\ORM\Association\BelongsTo $LeaveType
 *
 * @method \App\Model\Entity\LeaveRequest newEmptyEntity()
 * @method \App\Model\Entity\LeaveRequest newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveRequest findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LeaveRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRequest[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveRequest[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveRequest[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveRequest[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveRequest[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LeaveRequestsTable extends Table
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

        $this->setTable('leave_requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('LeaveType', [
            'foreignKey' => 'leave_type_id',
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
            ->notEmptyString('leave_type_id');

        $validator
            ->date('start_of_leave')
            ->requirePresence('start_of_leave', 'create')
            ->notEmptyDate('start_of_leave');

        $validator
            ->date('end_of_leave')
            ->requirePresence('end_of_leave', 'create')
            ->notEmptyDate('end_of_leave');

        $validator
            ->integer('num_days')
            ->requirePresence('num_days', 'create')
            ->notEmptyString('num_days');

        $validator
            ->scalar('year')
            ->requirePresence('year', 'create')
            ->notEmptyString('year');

        $validator
            ->scalar('description')
            ->maxLength('description', 200)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('status')
            ->maxLength('status', 10)
            ->allowEmptyString('status');

        $validator
            ->scalar('remark')
            ->maxLength('remark', 200)
            ->allowEmptyString('remark');

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
        $rules->add($rules->existsIn('leave_type_id', 'LeaveType'), ['errorField' => 'leave_type_id']);

        return $rules;
    }
}
