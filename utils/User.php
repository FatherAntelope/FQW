<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/curl.php";
require $_SERVER['DOCUMENT_ROOT'] . "/utils/variables.php";
class User {
    private $user_data = null;
    private $user_role = null;
    private $user_token = null;
    public function __construct($user_token) {
        $this->user_token = $user_token;
        $url = "https://".domain_name_api."/api/med/user";
        $method = "GET";
        $auth_token = 'Authorization: Bearer '.$this->user_token;
        $this->user_data = utils_call_api($method, $url, null, [$auth_token]);
        $this->user_role = $this->user_data->data['user']['role'];
    }

    public function isUserRole($check_name_role) {
        return $this->user_role === $check_name_role;
    }

    public function getUserData() {
        return $this->user_data->data['user'];
    }

    public function getUserStatusCode() {
        return $this->user_data->status_code;
    }
}
