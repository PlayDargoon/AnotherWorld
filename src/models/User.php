<?php
// src/models/User.php
class User
{
    private $pdo; // Объект PDO для работы с базой данных

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Получает пользователя по идентификатору
     *
     * @param int $id
     * @return array|null
     */
    public function findById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Регистрирует нового пользователя
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        // Подготавливаем данные для сохранения
        $hashPass = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (char_name, password_hash, email, class, side, gender, level, exp, health, strength, defense, reg_date) 
             VALUES (:char_name, :password_hash, :email, :class, :side, :gender, :level, :exp, :health, :strength, :defense, :reg_date)"
        );

        return $stmt->execute([
            ':char_name' => $data['char_name'],
            ':password_hash' => $hashPass,
            ':email' => $data['email'],
            ':class' => $data['class'],
            ':side' => $data['side'],
            ':gender' => $data['gender'],
            ':level' => $data['level'],
            ':exp' => $data['exp'],
            ':health' => $data['health'],
            ':strength' => $data['strength'],
            ':defense' => $data['defense'],
            ':reg_date' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Метод проверки правильности введённых данных пользователя
     *
     * @param array $data
     * @return bool
     */
    public function validateUserData(array $data)
    {
        return !empty($data['char_name'])
            && filter_var($data['email'], FILTER_VALIDATE_EMAIL)
            && strlen($data['password']) >= 6
            && in_array($data['class'], ['Warrior', 'Mage', 'Monk'])
            && in_array($data['side'], ['Light', 'Dark'])
            && in_array($data['gender'], ['Male', 'Female'])
            && is_numeric($data['level'])
            && is_numeric($data['exp'])
            && is_numeric($data['health'])
            && is_numeric($data['strength'])
            && is_numeric($data['defense']);
    }

    /**
     * Обновляет информацию о пользователе
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE users SET char_name=:char_name, email=:email, class=:class, side=:side, gender=:gender, level=:level, exp=:exp, health=:health, strength=:strength, defense=:defense WHERE id=:id"
        );

        return $stmt->execute([
            ':id' => $id,
            ':char_name' => $data['char_name'],
            ':email' => $data['email'],
            ':class' => $data['class'],
            ':side' => $data['side'],
            ':gender' => $data['gender'],
            ':level' => $data['level'],
            ':exp' => $data['exp'],
            ':health' => $data['health'],
            ':strength' => $data['strength'],
            ':defense' => $data['defense']
        ]);
    }

    /**
     * Обновляет живучесть персонажа
     *
     * @param int $id
     * @param int $health
     * @return bool
     */
    public function updateVitality(int $id, int $health)
    {
        $vitality = $health * 10;
        $stmt = $this->pdo->prepare("UPDATE users SET vitality = :vitality WHERE id = :id");
        return $stmt->execute(['id' => $id, 'vitality' => $vitality]);
    }

    /**
     * Удаляет пользователя по идентификатору
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Проверяет пользователя на предмет совпадения имени персонажа или почтового адреса
     *
     * @param string $charName
     * @param string $email
     * @return bool
     */
    public function checkIfExists(string $charName, string $email)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE char_name = :charName OR email = :email");
        $stmt->execute(['charName' => $charName, 'email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Производит авторизацию пользователя
     *
     * @param string $charName
     * @param string $password
     * @return array|bool
     */
    public function login(string $charName, string $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE char_name = :charName");
        $stmt->execute(['charName' => $charName]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }

    /**
     * Возвращает последний вставленный ID
     *
     * @return int
     */
    public function getLastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Получает количество зарегистрированных пользователей
     *
     * @return int
     */
    public function getUserCount()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

}
