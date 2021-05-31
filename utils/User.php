<?php
require $_SERVER['DOCUMENT_ROOT'] . "/utils/CurlHttpResponse.php";
/**
 * Class User
 * Хранит основную информацию пользователя и HTTP-код в результате обращения к точке API
 * Необходим в использовании практически в каждом модуле пользователя
 */
class User {
    /**
     * @var $api object хранит полученные данные с сервера БД
     * @var $role string хранит роль пользователя
     * @var $token string хранит токен пользователя
     */
    private $json = null;
    private $role = null;
    private $token = null;

    /**
     * User constructor.
     * @param $user_token string токен пользователя
     * Записывает токен пользователя.
     * @api Подключается к серверу БД и достает основную информацию из поля таблицы пользователей, либо ошибку, если произошла ошибка.
     * @example Ошибка может произойти из-за истечения срока действия токена, то есть токен уже недействителен - неверный.
     */
    public function __construct(string $user_token) {
        $this->token = $user_token;
        $url = protocol."://".domain_name_api."/api/med/user";
        $config = [
            "method" => "GET",
            "token" => $this->token
        ];
        /**
         * @var CurlHttpResponse используется для вызова функции
         * Принимает данные API
         */
        $this->json = utils_call_api($url, $config);
        $this->role = $this->json->data['user']['role'];
    }

    /**
     * @param $check_name_role string проверяет, имеет ли пользователь указанную роль
     * @return boolean
     */
    public function isUserRole(string $check_name_role) : bool {
        return $this->role === $check_name_role;
    }

    /**
     * @return array получение данных пользователя
     */
    public function getData() : array {
        return $this->json->data['user'];
    }

    /**
     * @return int HTTP код (статус) обработки запроса, например 200 - успех, 400 - неверный запрос и так далее
     */
    public function getStatusCode() : int {
        return $this->json->status_code;
    }
}

