<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LeaveDetails Controller
 *
 * @property \App\Model\Table\LeaveDetailsTable $LeaveDetails
 * @method \App\Model\Entity\LeaveDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeaveDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $leaveDetails = $this->paginate($this->LeaveDetails);

        $this->set(compact('leaveDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Leave Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leaveDetail = $this->LeaveDetails->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('leaveDetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $leaveDetail = $this->LeaveDetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $leaveDetail = $this->LeaveDetails->patchEntity($leaveDetail, $this->request->getData());
            if ($this->LeaveDetails->save($leaveDetail)) {
                $this->Flash->success(__('The leave detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave detail could not be saved. Please, try again.'));
        }
        $users = $this->LeaveDetails->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('leaveDetail', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Leave Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $leaveDetail = $this->LeaveDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leaveDetail = $this->LeaveDetails->patchEntity($leaveDetail, $this->request->getData());
            if ($this->LeaveDetails->save($leaveDetail)) {
                $this->Flash->success(__('The leave detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The leave detail could not be saved. Please, try again.'));
        }
        $users = $this->LeaveDetails->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('leaveDetail', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Leave Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leaveDetail = $this->LeaveDetails->get($id);
        if ($this->LeaveDetails->delete($leaveDetail)) {
            $this->Flash->success(__('The leave detail has been deleted.'));
        } else {
            $this->Flash->error(__('The leave detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
