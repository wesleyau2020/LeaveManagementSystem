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
        $this->checkAdminAuthorization();
        
        $this->paginate = [
            'contain' => ['Users', 'LeaveTypes'],
        ];
        $leaveRequests = $this->paginate($this->LeaveRequests);

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
        $leaveRequest = $this->LeaveRequests->get($id, [
            'contain' => ['Users', 'LeaveTypes'],
        ]);

        $leaveRequestUserID = $leaveRequest->user_id;
        if ($this->Authentication->getResult()->getData()->id == $leaveRequestUserID) {
            // skip authorization if user is viewing his own leave requests
            $this->Authorization->skipAuthorization();
        } else {
            $this->checkAdminAuthorization();
        }

        $this->set(compact('leaveRequest'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        // Create new leave request
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();
        if ($this->request->is('post')) {
            $leaveRequest = $this->LeaveRequests->patchEntity($leaveRequest,
            $this->request->getData());

            // set user_id
            $result = $this->Authentication->getResult();
            $id  = $result->getData()->id??0;
            $leaveRequest->user_id = $id;

            // set num_days
            $start = $leaveRequest->start_of_leave;
            $end = $leaveRequest->end_of_leave;
            $leaveRequest->days = $end->diff($start)->format("%a");

            // set status
            $leaveRequest->status = "Awaiting Level 1";

            // save new leave request
            if ($this->LeaveRequests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }

        // pass leaveRequest, users, leaveType to template
        $users = $this->LeaveRequests->Users->find('list', ['limit' => 200])->all();
        $leaveType = $this->LeaveRequests->LeaveTypes->find('list', ['limit' => 200])->all();
        $this->set(compact('leaveRequest', 'users', 'leaveType'));

        // pass user's requests to template (don't display other users)
        $userID  = $this->Authentication->getResult()->getData()->id??0;
        $userLeaveRequests = $this->LeaveRequests->find()->where(['user_id' => $userID])->contain(['LeaveTypes'])->toArray();
        $this->set(compact('userLeaveRequests'));

        // pass user to the template
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);
        $this->set(compact('user')); 
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

        $leaveRequestUserID = $leaveRequest->user_id;
        if ($this->Authentication->getResult()->getData()->id == $leaveRequestUserID) {
            // skip authorization if edit his own leave requests
            $this->Authorization->skipAuthorization();
        } else {
            $this->checkAdminAuthorization();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveRequest = $this->LeaveRequests->patchEntity($leaveRequest, $this->request->getData());
            if ($this->LeaveRequests->save($leaveRequest)) {
                $this->Flash->success(__('The leave request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave request could not be saved. Please, try again.'));
        }

        $users = $this->LeaveRequests->Users->find('list', ['limit' => 200])->all();
        $leaveType = $this->LeaveRequests->LeaveTypes->find('list', ['limit' => 200])->all();
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
        $this->checkAdminAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $leaveRequest = $this->LeaveRequests->get($id);

        if ($this->LeaveRequests->delete($leaveRequest)) {
            $this->Flash->success(__('The leave request has been deleted.'));
        } else {
            $this->Flash->error(__('The leave request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }

    // Takes in certain parameters and display leave requests
    public function search() {
        $this->Authorization->skipAuthorization();
        // $leaveRequest = $this->LeaveRequests->newEmptyEntity();
        // $this->set(compact('leaveRequest'));
        
        $query = $this->LeaveRequests->find();

        if ($this->request->is('get')) {
            $search = $this->request->getQueryParams();
            debug("hello");
            debug($search);
    
            if (!empty($search['id'])) {
                $query->where(['id' => $search['id']]);
            }
        }
    
        $leaveRequests = $this->paginate($query);
        // debug($leaveRequests);
        $this->set(compact('leaveRequests'));
    }

    public function displayApprovedRequests() {
        $this->Authorization->skipAuthorization();
        $userID = $this->Authentication->getResult()->getData()->id??0;

        $approvedLeaveRequests = $this->LeaveRequests->find()->where(['user_id' => $userID], ['status' => "Approved"])->contain(['Users','LeaveTypes'])->toArray();
        $pendingLeaveRequests = $this->LeaveRequests->find()->where(['user_id' => $userID], ['status' => "Awaiting Level 2"])->contain(['Users', 'LeaveTypes'])->toArray();

        $this->set(compact('approvedLeaveRequests'));
        $this->set(compact('pendingLeaveRequests'));
    }

    public function displayRejectedRequests() {
        $this->Authorization->skipAuthorization();
        $userID = $this->Authentication->getResult()->getData()->id??0;

        $rejectedLeaveRequests = $this->LeaveRequests->find()->where(['user_id' => $userID], ['status' => "Rejected"])->contain(['Users', 'LeaveTypes'])->toArray();
        $pendingLeaveRequests = $this->LeaveRequests->find()->where(['user_id' => $userID], ['status' => "Awaiting Level 2"])->contain(['Users', 'LeaveTypes'])->toArray();

        $this->set(compact('rejectedLeaveRequests'));
        $this->set(compact('pendingLeaveRequests'));
    }

    public function approve($id = null) {
        $this->checkAdminAuthorization();
        $leaveRequest = $this->LeaveRequests->get($id);

        $userID = $this->Authentication->getResult()->getData()->id??0;
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);

        if ($user->admin_level === 1 && $leaveRequest->status == "Awaiting Level 1") {
            $leaveRequest->status = "Awaiting Level 2";
        } else if ($user->admin_level === 2 && $leaveRequest->status == "Awaiting Level 2") {
            $leaveRequest->status = "Approved";
        } else {
            $this->Flash->error(__('The leave request could needs to be approved by a same-level admin'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->LeaveRequests->save($leaveRequest)) {
            $this->Flash->success(__('The leave request has been approved.'));
        } else {
            $this->Flash->error(__('The leave request could not be approved. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function reject($id = null) {
        $this->checkAdminAuthorization();
        $leaveRequest = $this->LeaveRequests->get($id);

        $userID = $this->Authentication->getResult()->getData()->id??0;
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);

        if ($user->admin_level === 2 && $leaveRequest->status != "Approved") {
            $leaveRequest->status = "Rejected";
        } else {
            $this->Flash->error(__('The leave request could not be rejected. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->LeaveRequests->save($leaveRequest)) {
            $this->Flash->success(__('The leave request has been rejected.'));
        } else {
            $this->Flash->error(__('The leave request could not be rejected. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function checkAdminAuthorization() {
        $userID = $this->Authentication->getResult()->getData()->id??0;
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);

        try {
            $this->Authorization->authorize($user);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }
    }
}
