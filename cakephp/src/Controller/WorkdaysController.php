<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Form\Form;

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
        $this->Authorization->skipAuthorization();
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
        $this->Authorization->skipAuthorization();
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
        $this->Authorization->skipAuthorization();
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
        $this->Authorization->skipAuthorization();
        $workday = $this->Workdays->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
     * Delete method
     *
     * @param string|null $id Workday id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post', 'delete']);
        $workday = $this->Workdays->get($id);
        if ($this->Workdays->delete($workday)) {
            $this->Flash->success(__('The workday has been deleted.'));
        } else {
            $this->Flash->error(__('The workday could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function update()
    {
        $this->Authorization->skipAuthorization();
        // $workdays = $this->paginate($this->Workdays);
        // $this->set(compact('workdays'));

        $workdays = $this->Workdays->find('all');

        $form = new Form();

        foreach ($workdays as $workday) {
            $form->add('id', ['type' => 'text', 'value' => $workday->id]);
            $form->add('is_workday', ['type' => 'checkbox', 'value' => $workday->is_workday]);
        }

        $form->add('submit', ['type' => 'submit', 'value' => 'Change']);

        return $this->render('update', ['form' => $form]);
    }
}
