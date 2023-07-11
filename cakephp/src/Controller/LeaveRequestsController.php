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
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }

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

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
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
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }

        if ($this->request->is('post')) {
            $leaveRequest = $this->LeaveRequests->patchEntity($leaveRequest,
            $this->request->getData());

            // set user_id
            $result = $this->Authentication->getResult();
            $id = $result->getData()->id;
            $leaveRequest->user_id = $id;

            // set num_days
            $start = $leaveRequest->start_of_leave;
            $end = $leaveRequest->end_of_leave;
            $leaveRequest->days = $end->diff($start)->format("%a");

            // set status
            $leaveRequest->status = "Awaiting Level 2";

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
        $userID  = $this->Authentication->getResult()->getData()->id;
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

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
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
        $this->request->allowMethod(['post', 'delete']);
        $leaveRequest = $this->LeaveRequests->get($id);

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }

        if ($this->LeaveRequests->delete($leaveRequest)) {
            $this->Flash->success(__('The leave request has been deleted.'));
        } else {
            $this->Flash->error(__('The leave request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }

    // Takes in certain parameters and display leave requests
    public function search() {
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();
        $this->set(compact('leaveRequest'));
        
        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }
        
        $query = $this->LeaveRequests->find();

        if ($this->request->is('get')) {
            $search = $this->request->getQueryParams();
            if (!empty($search['userID'])) {
                // $query->where(['<entity attribute>' => $search['<input variable>]]);
                $query->where(['user_id' => $search['userID']]);
            }
            if (!empty($search['leaveTypeID'])) {
                $query->where(['leave_type_id' => $search['leaveTypeID']]);
            }
            if (!empty($search['start_date'])) {
                $query->where(['start_of_leave' => $search['start_date']]);
            }
            if (!empty($search['end_date'])) {
                $query->where(['end_of_leave' => $search['end_date']]);
            }
            if (!empty($search['year'])) {
                $query->where(['year' => $search['year']]);
            }
            if (!empty($search['status'])) {
                $query->where(['status' => $search['status']]);
            }
        }

        $leaveRequests = $this->paginate($query);
        $leaveRequestsContains = array();
        foreach ($leaveRequests as $leaveRequest) {
            $leaveRequestID = $leaveRequest->id;
            $tmpLeaveRequest = $this->LeaveRequests->get($leaveRequestID, [
                'contain' => ['Users', 'LeaveTypes'],
            ]);
            array_push($leaveRequestsContains, $tmpLeaveRequest);
        }
        
        $this->set(compact('leaveRequestsContains'));
    }

    public function displayApprovedRequests() {
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();
        $this->set(compact('leaveRequest'));

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }

        $userID = $this->Authentication->getResult()->getData()->id;

        $approvedLeaveRequests = $this->LeaveRequests->find()->where(['user_id' => $userID, 'status' => "Approved"])->contain(['Users','LeaveTypes'])->toArray();

        $tmp1 = $this->LeaveRequests->find()->where(['user_id' => $userID, 'status' => "Awaiting Level 1"])->contain(['Users', 'LeaveTypes'])->toArray();
        $tmp2 = $this->LeaveRequests->find()->where(['user_id' => $userID, 'status' => "Awaiting Level 2"])->contain(['Users', 'LeaveTypes'])->toArray();
        $pendingLeaveRequests = array_merge($tmp1, $tmp2);

        $this->set(compact('approvedLeaveRequests'));
        $this->set(compact('pendingLeaveRequests'));
    }

    public function displayRejectedRequests() {
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();
        $this->set(compact('leaveRequest'));

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to view this page.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }

        $userID = $this->Authentication->getResult()->getData()->id;

        $rejectedLeaveRequests = $this->LeaveRequests->find()->where(['user_id' => $userID, 'status' => "Rejected"])->contain(['Users', 'LeaveTypes'])->toArray();

        $tmp1 = $this->LeaveRequests->find()->where(['user_id' => $userID, 'status' => "Awaiting Level 1"])->contain(['Users', 'LeaveTypes'])->toArray();
        $tmp2 = $this->LeaveRequests->find()->where(['user_id' => $userID, 'status' => "Awaiting Level 2"])->contain(['Users', 'LeaveTypes'])->toArray();
        $pendingLeaveRequests = array_merge($tmp1, $tmp2);

        $this->set(compact('rejectedLeaveRequests'));
        $this->set(compact('pendingLeaveRequests'));
    }

    public function approve($id = null) {
        $leaveRequest = $this->LeaveRequests->get($id);

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to perform this action.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }

        $userID = $this->Authentication->getResult()->getData()->id;
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);

        if ($user->admin_level === 2 && $leaveRequest->status == "Awaiting Level 2") {
            $leaveRequest->status = "Awaiting Level 1";
        } else if ($user->admin_level === 1 && $leaveRequest->status == "Awaiting Level 1") {
            $leaveRequest->status = "Approved";
        } else {
            $this->Flash->error(__('The leave request could needs to be approved by a higher-level admin'));
            return $this->redirect(['action' => 'displayApprovedRequests']);
        }

        if ($this->LeaveRequests->save($leaveRequest)) {
            $this->Flash->success(__('The leave request has been approved.'));
        } else {
            $this->Flash->error(__('The leave request could not be approved. Please, try again.'));
        }

        return $this->redirect(['action' => 'displayApprovedRequests']);
    }

    public function reject($id = null) {
        $leaveRequest = $this->LeaveRequests->get($id);

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to perform this action.'));
            $userID = $this->Authentication->getResult()->getData()->id;
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }

        $userID = $this->Authentication->getResult()->getData()->id;
        $usersController = new \App\Controller\UsersController();
        $user = $usersController->Users->get($userID);

        if ($leaveRequest->status != "Approved") {
            $leaveRequest->status = "Rejected";
        } else {
            $this->Flash->error(__('The leave request could not be rejected. Please, try again.'));
            return $this->redirect(['action' => 'displayRejectedRequests']);
        }

        if ($this->LeaveRequests->save($leaveRequest)) {
            $this->Flash->success(__('The leave request has been rejected.'));
        } else {
            $this->Flash->error(__('The leave request could not be rejected. Please, try again.'));
        }

        return $this->redirect(['action' => 'displayRejectedRequests']);
    }

    // public function checkAdminAuthorization(LeaveRequest $leaveRequest) {
    //     try {
    //         $this->Authorization->authorize($leaveRequest);
    //     } catch (\Exception $e) {
    //         $this->Flash->error(__('You are not authorised to view this page.'));
    //         $userID = $this->Authentication->getResult()->getData()->id;
    //         return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
    //     }
    // }
}
