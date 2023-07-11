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
        $this->checkAdminAuthorization();

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
        $leaveDetail = $this->LeaveDetails->get($id, [
            'contain' => ['Users'],
        ]);

        $leaveDetailUserID = $leaveDetail->user_id;
        if ($this->Authentication->getResult()->getData()->id == $leaveDetailUserID) {
            // skip authorization if user is viewing his own leave requests
            $this->Authorization->skipAuthorization();
        } else {
            $this->checkAdminAuthorization();
        }

        $this->set(compact('leaveDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->checkAdminAuthorization();

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
        $this->checkAdminAuthorization();

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
        $this->checkAdminAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $leaveDetail = $this->LeaveDetails->get($id);

        if ($this->LeaveDetails->delete($leaveDetail)) {
            $this->Flash->success(__('The leave detail has been deleted.'));
        } else {
            $this->Flash->error(__('The leave detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // Update leave balance every month (in current year)
    public function update() {
        $this->checkAdminAuthorization();

        $currYear = FrozenTime::now()->year;
        $leaveDetails = $this->LeaveDetails->find()->where(['year' => $currYear], ['leave_type_id' => 1])->toArray();
        $usersController = new \App\Controller\UsersController();

        foreach ($leaveDetails as $leaveDetail) {
            // Update $leaveBalance
            $user = $usersController->Users->get($leaveDetail->user_id);
            $monthsWorked = FrozenTime::now()->month - $user->start_date->month + 1;
            $leaveBalance = min($monthsWorked * 1.5 + $leaveDetail->carried_over, $leaveDetail->entitled); 
            $leaveBalance = ceil($leaveBalance * 2) / 2; // round up to the nearest 0.5
            $leaveDetail->balance = $leaveBalance;
            $this->LeaveDetails->save($leaveDetail);
        }

        $this->Flash->success(__('All leave balances have been updated for current month.'));
        return $this->redirect(['action' => 'index']);
    }

    public function checkAdminAuthorization() {
        $userID = $this->Authentication->getResult()->getData()->id??0;
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);

        try {
            $this->Authorization->authorize($user);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to perform this action.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }
    }
}
