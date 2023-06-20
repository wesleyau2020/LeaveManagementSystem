<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LeaveRequests Controller
 *
 * @property \App\Model\Table\LeaveRequestsTable $LeaveRequests
 * @method \App\Model\Entity\LeaveRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveRequestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->checkAuthorization();
        // fetches a paginated set of leaveRequests from DB
        $this->paginate = [
            'contain' => ['Users', 'LeaveType'],
        ];
        $leaveRequests = $this->paginate($this->LeaveRequests);

        // pass to template
        $this->set(compact('leaveRequests')); 
    }

    /**
     * View method
     *
     * @param string|null $id Leave Request id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAuthorization();
        $leaveRequest = $this->LeaveRequests->get($id, [
            'contain' => ['Users', 'LeaveType'],
        ]);

        $this->set(compact('leaveRequest'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->checkAuthorization();
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();
        if ($this->request->is('post')) {
            $leaveRequest = $this->LeaveRequests->patchEntity($leaveRequest, $this->request->getData());

            // set user_id
            $result = $this->Authentication->getResult();
            $id  = $result->getData()->id??0;
            $leaveRequest->user_id = $id;

            // set num_days
            $start = $leaveRequest->start_of_leave;
            $end = $leaveRequest->end_of_leave;
            $leaveRequest->days = $end->diff($start)->format("%a");

            if ($this->LeaveRequests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
        $users = $this->LeaveRequests->Users->find('list', ['limit' => 200])->all();
        $leaveType = $this->LeaveRequests->LeaveType->find('list', ['limit' => 200])->all();
        $this->set(compact('leaveRequest', 'users', 'leaveType'));

        // Show user's current requests
        $result = $this->Authentication->getResult();
        $userID  = $result->getData()->id??0;
        $userLeaveRequests = [];

        $this->paginate = [
            'contain' => ['Users', 'LeaveType'],
        ];
        $leaveRequests = $this->paginate($this->LeaveRequests);

        foreach ($leaveRequests as $leaveRequest) {
            if ($leaveRequest->user_id === $userID) {
                array_push($userLeaveRequests, $leaveRequest);
            }
        }

        $this->set(compact('userLeaveRequests')); 
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Request id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $leaveRequest = $this->LeaveRequests->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($leaveRequest);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->LeaveRequests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->LeaveRequests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }
        $users = $this->LeaveRequests->Users->find('list', ['limit' => 200])->all();
        $leaveType = $this->LeaveRequests->LeaveType->find('list', ['limit' => 200])->all();
        $this->set(compact('leaveRequest', 'users', 'leaveType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Request id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $leaveRequest = $this->LeaveRequests->get($id);
        if ($this->LeaveRequests->delete($leaveRequest)) {
            $this->Flash->success(__('The leave request has been deleted.'));
        } else {
            $this->Flash->error(__('The leave request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function checkAuthorization() {
        $result = $this->Authentication->getResult();
        $userID  = $result->getData()->id;
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);

        try {
            $this->Authorization->authorize($user);
        } catch (\Exception $e) {
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }
    }
}
