<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;

/**
 * LeaveDetails Controller
 *
 * @property \App\Model\Table\LeaveDetailsTable $LeaveDetails
 * @method \App\Model\Entity\LeaveDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $leaveDetails = $this->paginate($this->LeaveDetails);

        $this->set(compact('leaveDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Leave Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $leaveDetail = $this->LeaveDetails->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('leaveDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $leaveDetail = $this->LeaveDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $leaveDetail = $this->LeaveDetails->patchEntity($leaveDetail, $this->request->getData());
            if ($this->LeaveDetails->save($leaveDetail)) {
                $this->Flash->success(__('The leave detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave detail could not be saved. Please, try again.'));
        }
        $users = $this->LeaveDetails->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('leaveDetail', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();
        $leaveDetail = $this->LeaveDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveDetail = $this->LeaveDetails->patchEntity($leaveDetail, $this->request->getData());
            if ($this->LeaveDetails->save($leaveDetail)) {
                $this->Flash->success(__('The leave detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave detail could not be saved. Please, try again.'));
        }
        $users = $this->LeaveDetails->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('leaveDetail', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $leaveDetail = $this->LeaveDetails->get($id);
        if ($this->LeaveDetails->delete($leaveDetail)) {
            $this->Flash->success(__('The leave detail has been deleted.'));
        } else {
            $this->Flash->error(__('The leave detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // For all leave details in current year, update leave balance every month
    // At the start of a new year, add carry_over to leave balance
    public function update() {
        $this->Authorization->skipAuthorization();
        $currYear = FrozenTime::now()->year;

        $entries = $this->LeaveDetails->find()->count();
        for ($id = 1; $id < $entries + 1; $id++) {
            try {
                $leaveDetail = $this->LeaveDetails->get($id);
            } catch (\Exception $e) {
                continue;
            }

            if ($leaveDetail->year === $currYear) {
                // Calculate $leaveBalance
                $monthsWorked = FrozenTime::now()->month - $user->start_date->month + 1;
                $leaveBalance = $monthsWorked * 1.5; 
                $leaveBalance = ceil($leaveBalance * 2) / 2; // round up to the nearest 0.5
                // Update $leaveDetail->balance
                $leaveDetail->balance = $leaveBalance;
            }

            // debug($leaveDetail);
        }

        // Check if month == 1 (Jan), year == latestLeaveDetail->year + 1
        return $this->redirect(['action' => 'index']);
    }
}
