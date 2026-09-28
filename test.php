root@sb1geo:/usr/local/NetSapiens/netsapiens-api/webroot/apidoc# sed -n '240,300p' /usr/local/NetSapiens/netsapiens-portals/controllers/login_controller.php
    }

    // landing for multifactor auth
    public function mfa()
    {
        $this->set('username', $_SESSION['username']);
        $this->set('mfa_vendor', $_SESSION['mfa_vendor']);
        $this->set('mfa_type', $_SESSION['mfa_type']);
        $this->render('mfa');
    }

    // action to submit MFA login attempt
    public function mfaSubmit()
    {
        if (!$loginForm = $this->data['Login'])
            return $this->__redirectToLanding('badresult');

        if (!isset($loginForm['ns_id']))
            return $this->__redirectToLanding('badresult');
        if (!isset($loginForm['passcode']))
            return $this->__redirectToLanding('badresult');
        if (!isset($loginForm['mfa_vendor']))
            return $this->__redirectToLanding('badresult');
        if (!isset($loginForm['mfa_type']))
            return $this->__redirectToLanding('badresult');

        $username   = $loginForm['ns_id'];
        $passcode   = $loginForm['passcode'];
        $mfa_vendor = $loginForm['mfa_vendor'];
        $mfa_type   = $loginForm['mfa_type'];

        $this->nslog('debug', '('.$this->name.'.enroll) MFA passcode for login ' . $username . ' on vendor ' . $mfa_vendor . ' of type ' . $mfa_type);

        App::import('Vendor', 'sbus');
        $nsApi = new SBus();

        if ($nsApi->validateMfaPasscode($username, $passcode, $mfa_vendor, $mfa_type) == null) {
            $this->nslog('debug', '('.$this->name.".mfaSubmit fail)");

            $this->set('username', $username);
            $this->set('mfa_vendor', $mfa_vendor);
            $this->set('mfa_type', $mfa_type);
            $this->set('submit_error', __('Authentication failed.', true));
            return $this->render('mfa');
        }

        $this->nslog('debug', '('.$this->name.".mfaSubmit pass)");

        $this->__setUserSession($username);
        $this->getAllUiConfig(true);

        $this->setLongCache($_SERVER['REMOTE_ADDR'], null);

        $this->nslog('debug', '('.$this->name.".login) session='".print_r($_SESSION, true));

        $this->nslog('debug', '('.$this->name.".login) sub_name='".$this->Session->read('sub_name')."'  sub_user='".$this->Session->read('sub_user')."' sub_domain='".$this->Session->read('sub_domain')."'");

        // LOCALIZATION LOGIN LOGIC -> START
        $this->loadModel('Localization');
        $this->setLoginLanguage();
        $this->setSessionLanguage();
root@sb1geo:/usr/local/NetSapiens/netsapiens-api/webroot/apidoc# sed -n '245,285p' /usr/local/NetSapiens/netsapiens-portals/app_controller.php
        }


        if (isset($_REQUEST['uiconfig']) && ($_REQUEST['uiconfig'] == 'reset' || $_REQUEST['uiconfig'] == 'flush')) {
            $this->getAllUiConfig(true);
        }

        if (isset($_REQUEST['cache']) && ($_REQUEST['cache'] == 'reset' || $_REQUEST['cache'] == 'flush')) {
            $this->__flushCache();
        }

        if (!$this->Session->check('access_token')) {

            if (strpos($_SERVER['REQUEST_URI'], '/portal/uiconfigs/listing') !== false) {
                $this->nslog('debug', '('.$this->name.'.beforeFilter) uiconfigs/listing bypass');
                return true;
            }

            if (isset($_SESSION)) {
                if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/portal/login/ssoEnroll/') !== false)
                    $isOkSecondary = true;
                else if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/portal/login/mfaSubmit/') !== false)
                    $isOkSecondary = true;
                else
                    $this->nslog('debug', '('.$this->name.'.beforeFilter) access_token fail '.print_r($_SERVER['REQUEST_URI'], true));
            }

            if (isset($_SERVER['REQUEST_URI'])) {
                if (strpos($_SERVER['REQUEST_URI'], '/portal/home/checkSession/') !== false ||
                    strpos($_SERVER['REQUEST_URI'], '/portal/home/checkSession') !== false
                ) {
                    header('Access-Control-Allow-Origin: *');
                    $this->redirect(null, 401);
                }

                if (strpos($_SERVER['REQUEST_URI'], '/portal/?url=video') !== false) {
                    $this->Session->write('isVideo', true);

                    return true;
                } elseif (strpos($_SERVER['REQUEST_URI'], '/portal/home/index/') !== false) {
                    $secondPass = explode('/', str_replace('/portal/home/index/', '', $_SERVER['REQUEST_URI']));