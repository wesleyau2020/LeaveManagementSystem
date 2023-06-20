<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LeaveType Controller
 *
 * @property \App\Model\Table\LeaveTypeTable $LeaveType
 * @method \App\Model\Entity\LeaveType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveTypeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $leaveType = $this->paginate($this->LeaveType);

        $this->set(compact('leaveType'));
    }

    /**
     * View method
     *
     * @param string|null $id Leave Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $leaveType = $this->LeaveType->get($id, [
            'contain' => ['LeaveType', 'LeaveRequests'],
        ]);

        $this->set(compact('leaveType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $leaveType = $this->LeaveType->newEmptyEntity();
        if ($this->request->is('post')) {
            $leaveType = $this->LeaveType->patchEntity($leaveType, $this->request->getData());
            if ($this->LeaveType->save($leaveType)) {
                $this->Flash->success(__('The leave type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave type could not be saved. Please, try again.'));
        }
        $this->set(compact('leaveType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();
        $leaveType = $this->LeaveType->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveType = $this->LeaveType->patchEntity($leaveType, $this->request->getData());
            if ($this->LeaveType->save($leaveType)) {
                $this->Flash->success(__('The leave type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave type could not be saved. Please, try again.'));
        }
        $this->set(compact('leaveType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $leaveType = $this->LeaveType->get($id);
        if ($this->LeaveType->delete($leaveType)) {
            $this->Flash->success(__('The leave type has been deleted.'));
        } else {
            $this->Flash->error(__('The leave type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
