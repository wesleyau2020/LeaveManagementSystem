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
        $this->checkAdminAuthorization();
        $this->checkResourceAccessAuth($id);

        $user = $this->Users->get($id, [
            'contain' => ['LeaveDetails', 'LeaveRequests'],
        ]);

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
        $this->checkAdminAuthorization();
        $user = $this->Users->newEmptyEntity();

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
                $leaveBalance = ceil($leaveBalance * 2) / 2; // round up to the nearest 0.5
    
                // Auto-create leaveDetail for each user
                $leaveDetailsController = new \App\Controller\LeaveDetailsController();
                for ($i = 0; $i < 3; $i++) {
                    $leaveDetail = $leaveDetailsController->LeaveDetails->newEmptyEntity();
                    $leaveDetail->user_id = $result->id;
                    $leaveDetail->leave_type_id = $i + 1;
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
        $this->checkAdminAuthorization();
        $this->checkResourceAccessAuth($id);
        
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
        $id = $result->getData()->id??0;
        $is_admin = $result->getData()->is_admin??false;
        if ($result && $result->isValid()) {
            if ($is_admin == true) {
                // redirect to /Users/index after login success
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'index'
                ]);
            } 
            
            else {
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

    private function checkResourceAccessAuth(String $resourceID) {
        $result = $this->Authentication->getResult();
        $userID  = $result->getData()->id;

        // Admin has all permissions
        if ($this->Users->get($userID)->is_admin === true) {
            // debug($this->Users->get($userID)->is_admin);
            return;
        }

        // User can only edit his own resources
        if ($resourceID != $userID) {
            $this->Flash->error("You don't have permission.");
        
            throw new \Cake\Http\Exception\RedirectException(
                \Cake\Routing\Router::url([
                    'controller' => 'Users',
                    'action' => 'view',
                    $userID
                ])
            );
        }
    }

    // At the start of a new year, add leftover balance from last year to this year's balance
    // Check if month == 1 (Jan), latestLeaveDetail->year == currYear - 1
    public function update() {
        $this->Authorization->skipAuthorization();
        if (FrozenTime::now()->month === 6) {
            // $prevYear = FrozenTime::now()->year - 1;
            $prevYear = FrozenTime::now()->year; // for testing, set to current year

            // get latest $latestLeaveDetail
            $leaveDetailsController = new \App\Controller\LeaveDetailsController();
            $latestLeaveDetail = $leaveDetailsController->LeaveDetails->find()->last();
            debug($latestLeaveDetail);
            debug($latestLeaveDetail->year);

            if ($latestLeaveDetail->year == $prevYear) {
                $mapUsersPrevYearALBalance = getUsersPrevYearsALBalance();
                debug($mapUsersPrevYearALBalance);
            }
        }
    }

    public function getUsersPrevYearsALBalance() {
        $leaveDetailsController = new \App\Controller\LeaveDetailsController();
        $leaveDetailsController->paginate = [
            'contain' => ['Users'],
        ];
        $leaveDetails = $leaveDetailsController->paginate($leaveDetailsController->LeaveDetails);
        $mapUsersPrevYearALBalance = array();
        foreach ($leaveDetails as $leaveDetail) {
            // $prevYear = FrozenTime::now()->year - 1;
            $prevYear = FrozenTime::now()->year; // for testing, set to current year
            if ($leaveDetail->year == $prevYear
            && $leaveDetail->leave_type_id === 1 ) {
                $mapUsersPrevYearALBalance[$leaveDetail->user_id] = $leaveDetail->balance;
            }
        }
        return $mapUsersPrevYearALBalance;
    }
}
