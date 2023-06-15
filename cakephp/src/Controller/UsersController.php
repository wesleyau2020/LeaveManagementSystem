<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        // Authorization check
        $result = $this->Authentication->getResult();
        $id = $result->getData()->id??0;
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);

        // Pass annualLeaveDetails to templates/Users/index.php
        $leaveDetailsController = new \App\Controller\LeaveDetailsController();
        $leaveDetailsController->paginate = [
            'contain' => ['Users'],
        ];
        $leaveDetails = $leaveDetailsController->paginate($leaveDetailsController->LeaveDetails);

        $annualLeaveDetails = array();
        foreach ($leaveDetails as $leaveDetail) {
            if ($leaveDetail->leave_type_id == 1) {
                $k = $leaveDetail->user_id.", ".$leaveDetail->year;
                $annualLeaveDetails[$k] = $leaveDetail;
            }
        }

        // foreach($userLeaveDetails as $k => $v) {  
        // debug("Key: ".$k." Value: ".$v."");
        // }  

        $this->set(compact('users'));
        $this->set(compact('annualLeaveDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['LeaveDetails', 'LeaveRequests'],
        ]);
        $this->Authorization->authorize($user);

        // Pass leaveTypeNames to templates/Users/view.php
        $leaveTypeController = new \App\Controller\LeaveTypeController();
        $leaveTypeNames = array();

        for ($i = 0; $i < 3; $i++) {
            $LeaveTypeName = $leaveTypeController->LeaveType->get($i + 1)->name;
            array_push($leaveTypeNames, $LeaveTypeName);
        }

        $this->set(compact('user'));
        $this->set(compact('leaveTypeNames'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // $this->Authorization->skipAuthorization(); // skip if you need to add admins
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $result = $this->Users->save($user);

            if ($result) {
                // Calculate $leaveEntitled
                $monthsWorked = 12 - $user->start_date->month + 1;
                $leaveEntitled = (14 / 12) * $monthsWorked; 
                $leaveEntitled = ceil($leaveEntitled * 2) / 2; // round up to the nearest 0.5

                // Calculate $leaveBalance
                $monthsWorked = FrozenTime::now()->month - $user->start_date->month + 1;
                $leaveBalance = $monthsWorked * 1.5; 
                $leaveEntitled = ceil($leaveEntitled * 2) / 2; // round up to the nearest 0.5
    
                // Auto-create leaveDetail for each user
                $leaveDetailsController = new \App\Controller\LeaveDetailsController();
                for ($i = 0; $i < 3; $i++) {
                    $leaveDetail = $leaveDetailsController->LeaveDetails->newEmptyEntity();
                    $leaveDetail->user_id = $result->id;
                    $leaveDetail->leave_type_id = $i + 1;
                    // $leaveDetail->year = FrozenTime::now()->year;
                    if ($leaveDetail->leave_type_id == 1) {
                        $leaveDetail->entitled = $leaveEntitled;
                        $leaveDetail->balance = $leaveBalance;
                    }
                    $leaveDetailsController->LeaveDetails->save($leaveDetail);
                }

                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        $id  = $result->getData()->id??0;
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'view',
                $id
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
}
