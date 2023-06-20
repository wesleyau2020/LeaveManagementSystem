<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveType Model
 *
 * @property \App\Model\Table\LeaveTypesTable&\Cake\ORM\Association\BelongsTo $LeaveType
 * @property \App\Model\Table\LeaveRequestsTable&\Cake\ORM\Association\HasMany $LeaveRequests
 * @property \App\Model\Table\LeaveTypesTable&\Cake\ORM\Association\HasMany $LeaveType
 *
 * @method \App\Model\Entity\LeaveType newEmptyEntity()
 * @method \App\Model\Entity\LeaveType newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveType get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LeaveType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeaveType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LeaveTypesTable extends Table
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

        $this->setTable('leave_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('LeaveTypes', [
            'foreignKey' => 'leave_type_id',
        ]);
        $this->hasMany('LeaveRequests', [
            'foreignKey' => 'leave_type_id',
        ]);
        $this->hasMany('LeaveTypes', [
            'foreignKey' => 'leave_type_id',
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
            ->scalar('name')
            ->maxLength('name', 20)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('type')
            ->maxLength('type', 10)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->integer('leave_type_id')
            ->allowEmptyString('leave_type_id');

        $validator
            ->numeric('cost')
            ->requirePresence('cost', 'create')
            ->notEmptyString('cost');

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
        $rules->add($rules->existsIn('leave_type_id', 'LeaveType'), ['errorField' => 'leave_type_id']);

        return $rules;
    }
}
