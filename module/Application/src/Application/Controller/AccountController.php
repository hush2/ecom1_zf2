<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel,
    Zend\Authentication\Adapter\DbTable as AuthAdapter,
    Zend\Mvc\Controller\AbstractActionController;

use Application\Form,
    Application\Filter,
    Application\Controller\Exception\MyException;
    
class AccountController extends AbstractActionController
{
    //--------------------------------------------------------------------------
    // Process user login.
    //--------------------------------------------------------------------------
    public function loginAction()
    {
        $dbAdapter = $this->getService('dbAdapter');
        $form = new Form\Login();
        $form->setInputFilter(new Filter\Login($dbAdapter));
        if ($this->isFormValid($form)) {
            $email = $form->get('login_email')->getValue();
            $password = $form->get('login_password')->getValue();
            if ($this->authAttempt($email, $password)) {
                return $this->redirect()->toRoute('home');
            }
            $form->failed = true;
        }
        $this->layout()->form = $form;
        return $this->forward()->dispatch('home', array('action' => 'index'));
    }

    //--------------------------------------------------------------------------
    // Logout current user.
    //--------------------------------------------------------------------------
    public function logoutAction()
    {
        $this->getService('Auth')->clearIdentity();
        return $this->redirect()->toRoute('home');
    }

    //--------------------------------------------------------------------------
    // Show/process registration form.
    //--------------------------------------------------------------------------
    public function registerAction()
    {
        $dbAdapter = $this->getService('dbAdapter');
        $form = new Form\Register();
        $form->setInputFilter(new Filter\Register($dbAdapter));
        if ($this->isFormValid($form)) {
            $user = $this->getService('Model\User');
            if ($user->add($form->getData())) {
                $this->setFlash(true, 'success');
                return $this->redirect()->toUrl('register');
            }
            throw new MyException('You could not be registered due to a system error. We apologize for any inconvenience.');
        }
        return array('form' => $form);
    }

    //--------------------------------------------------------------------------
    // Show/process forgot password form.
    //--------------------------------------------------------------------------
    public function forgotpasswordAction()
    {
        $dbAdapter = $this->getService('dbAdapter');
        $form = new Form\ForgotPassword();
        $form->setInputFilter(new Filter\ForgotPassword($dbAdapter));
        if ($this->isFormValid($form)) {
            $user = $this->getService('Model\User');
            $email = $form->get('email')->getValue();
            $newPassword = $user->createNewPassword($email);
            if ($newPassword) {
                //$message = "Your password to log into <whatever site> has been temporarily changed to '$newPassword'. Please log in using that password and this email address. Then you may change your password to something more familiar.";
                //mail($email, 'Your temporary password.', $message, 'From: admin@example.com');
                $this->setFlash(true, 'success');
                return $this->redirect()->toUrl('forgot_password');
            }
            throw new MyException('Your password could not be changed due to a system error. We apologize for any inconvenience.');
        }
        return array('form' => $form);
    }

    //--------------------------------------------------------------------------
    // Show/process change password form.
    //--------------------------------------------------------------------------
    public function changepasswordAction()
    {
        $form = new Form\ChangePassword();
        $form->setInputFilter($this->getService('Filter\ChangePassword'));
        if ($this->isFormValid($form)) {
            $user = $this->getService('Model\User');
            $userId = $this->getService('Auth')->getIdentity()->id;
            $password = $form->get('new_password')->getValue();
            if ($user->changePassword($userId, $password)) {
                $this->setFlash(true, 'success');
                return $this->redirect()->toUrl('change_password');
            }
            throw new MyException('Your password could not be changed due to a system error. We apologize for any inconvenience.');
        }
        return array('form' => $form);
    }

    //--------------------------------------------------------------------------
    // Authenticate user.
    //--------------------------------------------------------------------------
    protected function authAttempt($email, $password)
    {
        $dbAdapter = $this->getService('dbAdapter');
        $authAdapter = new AuthAdapter($dbAdapter);
        $authAdapter->setTableName('users')
                    ->setIdentityColumn('email')
                    ->setCredentialColumn('pass')
                    ->setCredentialTreatment('MD5(?)')
                    ->setIdentity($email)
                    ->setCredential($password);

        $auth = $this->getService('Auth');
        $result = $auth->authenticate($authAdapter);
        if ($result->isValid()) {
            $user = $authAdapter->getResultRowObject();
            $user->isExpired = time() > strtotime($user->date_expires);
            $auth->getStorage()->write($user);
            return true;
        }
    }

    //--------------------------------------------------------------------------
    // Show account renewal form.
    //--------------------------------------------------------------------------
    public function renewAction() { }

}
