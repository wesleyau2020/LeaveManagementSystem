<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Holidays Controller
 *
 * @property \App\Model\Table\HolidaysTable $Holidays
 * @method \App\Model\Entity\Holiday[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HolidaysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->checkAdminAuthorization();

        $holidays = $this->paginate($this->Holidays);

        $this->set(compact('holidays'));
    }

    /**
     * View method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->checkAdminAuthorization();

        $holiday = $this->Holidays->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('holiday'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->checkAdminAuthorization();

        $holiday = $this->Holidays->newEmptyEntity();

        if ($this->request->is('post')) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->getData());
            $holiday->is_holiday = TRUE;
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));

                return $this->redirect(['action' => 'display']);
            }
            $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
        }

        $this->set(compact('holiday'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->checkAdminAuthorization();

        $holiday = $this->Holidays->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $holiday = $this->Holidays->patchEntity($holiday, $this->request->getData());
            if ($this->Holidays->save($holiday)) {
                $this->Flash->success(__('The holiday has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The holiday could not be saved. Please, try again.'));
        }

        $this->set(compact('holiday'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Holiday id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->checkAdminAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $holiday = $this->Holidays->get($id);
        
        if ($this->Holidays->delete($holiday)) {
            $this->Flash->success(__('The holiday has been deleted.'));
        } else {
            $this->Flash->error(__('The holiday could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'delete_index']);
    }

    public function display() {
        $this->Authorization->skipAuthorization();

        $holidays = $this->paginate($this->Holidays);

        $this->set(compact('holidays'));
    }

    public function deleteIndex()
    {
        $this->checkAdminAuthorization();

        $holidays = $this->paginate($this->Holidays);

        $this->set(compact('holidays'));
    }

    public function checkAdminAuthorization() {
        $userID = $this->Authentication->getResult()->getData()->id;
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
