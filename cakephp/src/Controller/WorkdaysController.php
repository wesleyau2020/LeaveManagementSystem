<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Form\Form;

use Cake\Error\Debugger;

/**
 * Workdays Controller
 *
 * @property \App\Model\Table\WorkdaysTable $Workdays
 * @method \App\Model\Entity\Workday[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WorkdaysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->checkAdminAuthorization();

        $workdays = $this->paginate($this->Workdays);

        $this->set(compact('workdays'));
    }

    /**
     * View method
     *
     * @param string|null $id Workday id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAdminAuthorization();

        $workday = $this->Workdays->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('workday'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->checkAdminAuthorization();

        $workday = $this->Workdays->newEmptyEntity();

        if ($this->request->is('post')) {
            $workday = $this->Workdays->patchEntity($workday, $this->request->getData());
            if ($this->Workdays->save($workday)) {
                $this->Flash->success(__('The workday has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The workday could not be saved. Please, try again.'));
        }

        $this->set(compact('workday'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Workday id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAdminAuthorization();

        $workday = $this->Workdays->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $workday = $this->Workdays->patchEntity($workday, $this->request->getData());
            if ($this->Workdays->save($workday)) {
                $this->Flash->success(__('The workday has been saved.'));

                // return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The workday could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('workday'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Workday id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAdminAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $workday = $this->Workdays->get($id);

        if ($this->Workdays->delete($workday)) {
            $this->Flash->success(__('The workday has been deleted.'));
        } else {
            $this->Flash->error(__('The workday could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // Function to update workday->is_workday as TRUE or FALSE
    // e.g Monday -> is_workday = TRUE, Saturday -> is_workday = FALSE 
    public function update()
    {
        $this->checkAdminAuthorization();

        $workdays = $this->paginate($this->Workdays);
        $this->set(compact('workdays'));
      
        // If the page has a PATCH/POST/PUT request.
        if ($this->request->is(['patch', 'post', 'put'])) {
            $results = $this->request->getData();   // Get the result of the PATCH/POST/PUT.

            // $this->set(compact('results')); // Debug

            $workdaysTable = $this->Workdays;       // The Workdays Database Table object.
            $flag = true;                           // Error flag, no error TRUE.

            // Loops through the results to get ID and IS_WORKDAY.
            foreach($results as $id => $is_workday) {
                $workday = $workdaysTable->get($id);
                $workday->is_workday = $is_workday;

                // Saves and checks if ERROR.
                if(!($workdaysTable->save($workday))) {
                    $this->Flash->error(__('The workday(s) could not be saved. Please, try again.'));
                    $flag = false;
                    break;
                }
            }
            
            // Success notification.
            if($flag) {
                $this->Flash->success(__('The workday(s) have successfully been saved.'));
            }
        }
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
