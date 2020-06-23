<?php

namespace App\Controllers;
use App\Models\User;


class AdminPanelController extends BaseController
{
    public function index()
    {
        if (!in_array($this->auth->user()['id'], ADMIN_ID)) {
            return 0;
        }
        $userModel = new User();
        $result = $userModel->getAll();
        if ($_GET) {
            $userModel->delete(key($_GET));
            return $this->redirect('admin/panel');
        }
        if ($_POST['id_change']) {
            $userModel->edit($_POST);
            return $this->redirect('admin/panel');
        }
        $isValid = $this->validation->gumpAction($_POST);
        $error = [];
        if ($isValid !== true) {
            $error = $isValid;
            foreach ($error as $key => $value) {
                $error[$key] = strip_tags($value);
            }
            $this->view->render('front/adminPanel', ['list' => $result,'error' => $error, 'result' => 'Add failed']);
            return 0;
        }
        $user = $userModel->getByEmail($_POST['email']);
        if (!empty($user)) {
            $this->view->render('front/adminPanel', ['list' => $result, 'error' => $error, 'result' => 'Add failed, user already exist']);
            return 0;
        }
        $userModel->add($_POST);
        $this->view->render('front/adminPanel', ['list' => $result, 'error' => $error, 'result' => 'Add success']);
    }


}
