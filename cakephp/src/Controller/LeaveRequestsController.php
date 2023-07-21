<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\Helper\ExcelHelper;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * LeaveRequests Controller
 *
 * @property \App\Model\Table\LeaveRequestsTable $LeaveRequests
 * @method \App\Model\Entity\LeaveRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveRequestsController extends AppController
{

    // Global variable $resultSet
    private $resultSet = array();

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->checkAdminAuthorization();
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();

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
        $this->checkAdminAuthorization();
        $leaveRequest = $this->LeaveRequests->get($id, [
            'contain' => ['Users', 'LeaveTypes'],
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
        $this->checkAdminAuthorization();
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();

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
        $this->checkAdminAuthorization();
        $leaveRequest = $this->LeaveRequests->get($id, [
            'contain' => [],
        ]);

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
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();
        $this->set(compact('leaveRequest'));
        
        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to perform this action.'));
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
            if (!empty($search['start_of_leave'])) {
                $query->where(['start_of_leave' => $search['start_of_leave']]);
            }
            if (!empty($search['end_of_leave'])) {
                $query->where(['end_of_leave' => $search['end_of_leave']]);
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

        debug($this->resultSet);
        $this->resultSet = $leaveRequestsContains;
        debug($this->resultSet);
        $this->set(compact('leaveRequestsContains'));
    }

    public function export()
    {
        $this->Authorization->skipAuthorization();

        // why is this empty?
        debug($this->resultSet);

        // $resultSet = $this->LeaveRequests->find('all')->toArray();
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header row
        $headerRow = array_keys($this->resultSet[0]->toArray());
        $sheet->fromArray($headerRow, null, 'A1');

        // Data rows
        $dataRows = array_map(function ($row) {
            return array_values($row->toArray());
        }, $this->resultSet);
        $sheet->fromArray($dataRows, null, 'A2');

        // Export the spreadsheet to Excel file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'exported_data.xlsx';
        try {
            $writer->save($filename);
        } catch(\Exception $e) {
            $this->Flash->error(__('Export was unsuccessful. Please, try again.'));
        }
        $this->Flash->success(__('Export was successful.'));
        $this->redirect(['controller' => 'LeaveRequests', 'action' => 'search']);
    }

    public function displayApprovedRequests() {
        $leaveRequest = $this->LeaveRequests->newEmptyEntity();

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to perform this action.'));
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

        try {
            $this->Authorization->authorize($leaveRequest);
        } catch (\Exception $e) {
            $this->Flash->error(__('You are not authorised to perform this action.'));
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
