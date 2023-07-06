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
        $this->checkAdminAuthorization();
        $users = $this->paginate($this->Users);
        $userWithLeaveDetails = $this->Users->find()->contain(['LeaveDetails'])->toArray();

        $this->set(compact('users'));
        $this->set(compact('userWithLeaveDetails'));
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
        if ($this->Authentication->getResult()->getData()->id === $id) {
            $this->Authorization->skipAuthorization();
        } else {
            $this->checkAdminAuthorization();
        }

        $user = $this->Users->get($id, [
            'contain' => ['LeaveDetails', 'LeaveRequests'],
        ]);

        $leaveTypesController = new \App\Controller\LeaveTypesController();
        $leaveTypeNames = array();
        for ($i = 0; $i < 3; $i++) {
            $LeaveTypeName = $leaveTypesController->LeaveTypes->get($i + 1)->name;
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
        // $this->Authorization->skipAuthorization(); // uncomment to add Admins
        $this->checkAdminAuthorization();
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->is_active = TRUE;
            $result = $this->Users->save($user);

            if ($result) {
                // Calculate $leaveEntitled
                $monthsWorked = 12 - $user->start_date->month + 1;
                $leaveEntitled = (14 / 12) * $monthsWorked; 
                $leaveEntitled = ceil($leaveEntitled * 2) / 2; // round up to the nearest 0.5

                // Calculate $leaveBalance
                $monthsWorked = FrozenTime::now()->month - $user->start_date->month + 1;
                $leaveBalance = $monthsWorked * 1.5; 
                $leaveBalance = ceil($leaveBalance * 2) / 2; // round up to the nearest 0.5
    
                // Auto-create leaveDetail for each user
                $leaveDetailsController = new \App\Controller\LeaveDetailsController();
                for ($i = 1; $i < 4; $i++) {
                    $leaveDetail = null;
                    if ($i === 1) {
                        $leaveDetail = $this->createLeaveDetail($result->id, $i, 7, 0);
                        $leaveDetail->entitled = $leaveEntitled;
                        $leaveDetail->balance = $leaveBalance;
                    } else if ($i === 2) {
                        $leaveDetail = $this->createLeaveDetail($result->id, $i, 0, 0);
                    } else if ($i === 3) {
                        $leaveDetail = $this->createLeaveDetail($result->id, $i, 0, 0);
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
        if ($this->Authentication->getResult()->getData()->id === $id) {
            $this->Authorization->skipAuthorization();
        } else {
            $this->checkAdminAuthorization();
        }
        
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

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
        $this->checkAdminAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
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
        // Configure the login action to not require authentication, 
        // preventing the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        
        // regardless of POST or GET, redirect if user is logged in
        $id = $result->getData()->id??0;
        $is_admin = $result->getData()->is_admin??false;

        if ($result && $result->isValid()) {
            if ($is_admin == true) {
                // redirect to /Users/index after login success
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'index'
                ]);
            } else {
                // redirect to /Users/view/{$id} after login success
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'view',
                    $id
                ]);
            }
            return $this->redirect($redirect);
        }

        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }

        $this->Flash->error(__('An error has occurred'));
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

    // At the start of a new year, create new leave details
    public function update() {
        $this->Authorization->skipAuthorization();
        if (FrozenTime::now()->month === 1) { // for testing, set to current month
            $prevYear = FrozenTime::now()->year - 1; // for testing, set to current year 

            // get latest $latestLeaveDetail
            $leaveDetailsController = new \App\Controller\LeaveDetailsController();
            $latestLeaveDetail = $leaveDetailsController->LeaveDetails->find()->last();

            if ($latestLeaveDetail->year == $prevYear) {
                $mapUsersPrevYearALBalance = $this->getMapUsersPrevYearsALBalance();

                foreach ($mapUsersPrevYearALBalance as $k => $v) {  
                    // auto-create new leaveDetail for each user
                    for ($i = 1; $i < 4; $i++) {
                        $leaveDetail = null;
                        if ($i === 1) {
                            $leaveDetail = $this->createLeaveDetail($k, $i, 7, min($v, 7));
                            $leaveDetail->balance = min($v, 7);
                        } else if ($i === 2) {
                            $leaveDetail = $this->createLeaveDetail($k, $i, 0, 0);
                        } else if ($i === 3) {
                            $leaveDetail = $this->createLeaveDetail($k, $i, 0, 0);
                        }
                        $leaveDetailsController->LeaveDetails->save($leaveDetail);
                    }
                }  
            }
        }

        $userID = $this->Authentication->getResult()->getData()->id;
        $this->Flash->success(__('New leave balances have been created for current year.'));
        return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
    }

    public function deactivate($id = null)
    {
        $this->checkAdminAuthorization();
        $user = $this->Users->get($id);
        $user->is_active = FALSE;

        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been deactivated.'));
        } else {
            $this->Flash->error(__('The user could not be deactivated. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function displayActiveUsers() {
        // $this->checkAdminAuthorization();
        $this->Authorization->skipAuthorization();

        $activeUsers = $this->Users->find()->where(['is_active' => TRUE])->toArray();

        $this->set(compact('activeUsers'));
    }

    public function displayInactiveUsers() {
        // $this->checkAdminAuthorization();
        $this->Authorization->skipAuthorization();

        $inactiveUsers = $this->Users->find()->where(['is_active' => FALSE])->toArray();

        $this->set(compact('inactiveUsers'));
    }

    private function checkAdminAuthorization() {
        $result = $this->Authentication->getResult();
        $userID  = $result->getData()->id;
        $user = $this->Users->get($userID);

        try {
            $this->Authorization->authorize($user);
        } catch (\Exception $e) {
            return $this->redirect(['controller' => 'Users', 'action' => 'view', $userID]);
        }
    }

    // Map user's ID to their previous year AL balance
    // e.g. ['ID: 1' => 'AL Balance: 7', 'ID: 2' => 'AL Balance: 5']
    // TODO: Refactor to use query instead
    // i.e $leaveDetailsController->LeaveDetails->find()
    // ->where(['year' => $prevYear], ['leave_type_id' => 1])->toArray();
    public function getMapUsersPrevYearsALBalance() {
        $leaveDetailsController = new \App\Controller\LeaveDetailsController();
        $leaveDetailsController->paginate = [
            'contain' => ['Users'],
        ];
        $leaveDetails = $leaveDetailsController->paginate($leaveDetailsController->LeaveDetails);
        $mapUsersPrevYearALBalance = array();

        foreach ($leaveDetails as $leaveDetail) {
            $prevYear = FrozenTime::now()->year - 1; // for testing, set to current year
            if ($leaveDetail->year == $prevYear
            && $leaveDetail->leave_type_id === 1) {
                $mapUsersPrevYearALBalance[$leaveDetail->user_id] = $leaveDetail->balance;
            }
        }

        return $mapUsersPrevYearALBalance;
    }

    public function createLeaveDetail(int $userID, int $leaveTypeID, int $maxCarryOver, float $carriedOver) {
        $leaveDetailsController = new \App\Controller\LeaveDetailsController();
        $leaveDetail = $leaveDetailsController->LeaveDetails->newEmptyEntity();
        $leaveDetail->user_id = $userID;
        $leaveDetail->leave_type_id = $leaveTypeID;
        $leaveDetail->max_carry_over = $maxCarryOver;
        $leaveDetail->carried_over = $carriedOver;

        $leaveTypesController = new \App\Controller\LeaveTypesController();
        $leaveType = $leaveTypesController->LeaveTypes->get($leaveTypeID);
        $leaveDetail->entitled = $leaveType->entitled;
        $leaveDetail->balance = $leaveType->entitled;
        $leaveDetail->earned = $leaveType->earned;

        return $leaveDetail;
    }
}
