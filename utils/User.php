<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
/**
 * Class User
 * Хранит основную информацию пользователя и HTTP-код в результате обращения к точке API
 * Необходим в использовании практически в каждом модуле пользователя
 */
class User {
    /**
     * @var $user_data array хранит полученные данные с сервера БД
     * @var $user_role string хранит роль пользователя
     * @var $user_token string хранит токен пользователя
     */
    private $user_data = null;
    private $user_role = null;
    private $user_token = null;

    /**
     * User constructor.
     * @param $user_token string токен пользователя
     * Записывает токен пользователя.
     * @api Подключается к серверу БД и достает основную информацию из поля таблицы пользователей, либо ошибку, если произошла ошибка.
     * @example Ошибка может произойти из-за истечения срока действия токена, то есть токен уже недействителен - неверный.
     */
    public function __construct(string $user_token) {
        $this->user_token = $user_token;
        $url = "https://".domain_name_api."/api/med/user";
        $config = [
            "method" => "GET",
            "token" => $this->user_token
        ];
        /**
         * @var CurlHttpResponse используется для вызова функции
         * Принимает данные API
         */
        $this->user_data = utils_call_api($url, $config);
        $this->user_role = $this->user_data->data['user']['role'];
    }

    /**
     * @param $check_name_role string проверяет, имеет ли пользователь указанную роль
     * @return boolean
     */
    public function isUserRole(string $check_name_role) : bool {
        return $this->user_role === $check_name_role;
    }

    /**
     * @return array получение данных пользователя
     */
    public function getUserData() : array {
        return $this->user_data->data['user'];
    }

    /**
     * @return int HTTP код (статус) обработки запроса, например 200 - успех, 400 - неверный запрос и так далее
     */
    public function getUserStatusCode() : int {
        return $this->user_data->status_code;
    }
}

