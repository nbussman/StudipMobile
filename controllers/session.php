<?php
// Copyright (C) 2013  Nils Bussmann

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program. If not, see <http://www.gnu.org/licenses/>.

require "StudipMobileController.php";

/**
 *    create, destroy (...) sessions
 *    login process
 *    @author Marcus Lunzenauer - mlunzena@uos.de
 *    @author André Klaßen - aklassen@uos.de
 *    @author Nils Bussmann - nbussman@uos.de
 */
class SessionController extends StudipMobileController
{

    function before($action)
    {
        if ($action === "destroy")
            $this->requireUser();

        $this->set_layout("layouts/login_page");
    }

    function new_action()
    {
    }

    function create_action()
    {

        $username = strtolower( Request::get("username") );
        $password = Request::get("password");

        if (isset($username) && isset($password)) {
            $result = StudipAuthAbstract::CheckAuthentication($username, $password);
        }

        if (!isset($result) || $result['uid'] === false) {
            $this->flash["notice"] = "login unsuccessful!";
            $this->redirect("session/new");
            return;
        }

        $user_id = get_userid($username);

        if (isset($user_id)) {
            $this->start_session($user_id);
        }

        $this->flash["notice"] = "login successful!";
        $this->redirect("quickdial");
    }

    function destroy_action()
    {
        global $perm, $user, $auth, $sess, $forced_language, $_language;
        $perm = null;
        $user = null;
        $auth->logout();
        $forced_language = null;
        $_language = null;
        $sess->delete();
        $this->redirect("activities");
    }

    protected function start_session($user_id)
    {
        global $perm, $user, $auth, $sess, $forced_language, $_language;


        $user = new Seminar_User();
        $user->start($user_id);

        foreach (array(
                     "uid" => $user_id,
                     "perm" => $user->perms,
                     "uname" => $user->username,
                     "auth_plugin" => $user->auth_plugin,
                     "exp" => time() + 60 * 15,
                     "refresh" => time()
                 ) as $k => $v) {
            $auth->auth[$k] = $v;
        }

        $auth->nobody = false;


        $sess->regenerate_session_id(array('auth', 'forced_language','_language'));
        $sess->freeze();
    }
}
