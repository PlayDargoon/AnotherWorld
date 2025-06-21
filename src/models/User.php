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

    /**
     * Находит пользователя по токену для сброса пароля
     *
     * @param string $token
     * @return array|null
     */
    public function findByPasswordResetToken(string $token)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE password_reset_token = :token");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Обновляет пароль пользователя
     *
     * @param int $id
     * @param string $password
     * @return bool
     */
    public function updatePassword(int $id, string $password)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET password_hash = :password WHERE id = :id");
        return $stmt->execute(['id' => $id, 'password' => $password]);
    }

    /**
     * Удаляет токен для сброса пароля
     *
     * @param int $id
     * @return bool
     */
    public function clearPasswordResetToken(int $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET password_reset_token = NULL WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // ...
    // ...

    /**
     * Получает дату регистрации персонажа по идентификатору
     *
     * @param int $id
     * @return string|null
     */
    public function getRegistrationDate(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT reg_date FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['reg_date'] : null;
    }

    // ...
    // ...

    /**
     * Обновляет время входа пользователя
     *
     * @param int $id
     * @return bool
     */
    public function updateLoginTime(int $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET login_time = :login_time WHERE id = :id");
        return $stmt->execute(['id' => $id, 'login_time' => date('Y-m-d H:i:s')]);
    }

    /**
     * Обновляет время выхода пользователя
     *
     * @param int $id
     * @return bool
     */
    public function updateLogoutTime(int $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET logout_time = :logout_time WHERE id = :id");
        return $stmt->execute(['id' => $id, 'logout_time' => date('Y-m-d H:i:s')]);
    }

    // ...
    // ...

    /**
     * Обновляет общее игровое время пользователя
     *
     * @param int $id
     * @param int $gameTime
     * @return bool
     */
    public function updateTotalGameTime(int $id, int $gameTime)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET total_game_time = total_game_time + :gameTime WHERE id = :id");
        return $stmt->execute(['id' => $id, 'gameTime' => $gameTime]);
    }

    // ...

    /**
     * Получает общее игровое время пользователя
     *
     * @param int $id
     * @return int|null
     */
    public function getTotalGameTime(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT total_game_time FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['total_game_time'] : null;
    }
    // ...

    /**
     * Получает время входа пользователя
     *
     * @param int $id
     * @return string|null
     */
    public function getLoginTime(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT login_time FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['login_time'] : null;
    }

    // ...
    // ...

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

    // ...
    // ...

    /**
     * Обновляет урон персонажа
     *
     * @param int $id
     * @param int $strength
     * @return bool
     */
    public function updateDamage(int $id, int $strength)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET damage = :damage WHERE id = :id");
        return $stmt->execute(['id' => $id, 'damage' => $strength]);
    }

    // ...
    // ...

    /**
     * Получает урон персонажа
     *
     * @param int $id
     * @return int|null
     */
    public function getDamage(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT damage FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['damage'] : null;
    }

    // ...
    // ...

    /**
     * Получает золото персонажа
     *
     * @param int $id
     * @return int|null
     */
    public function getGold(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT gold FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['gold'] : null;
    }

    /**
     * Получает серебро персонажа
     *
     * @param int $id
     * @return int|null
     */
    public function getSilver(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT silver FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['silver'] : null;
    }

    /**
     * Обновляет золото персонажа
     *
     * @param int $id
     * @param int $gold
     * @return bool
     */
    public function updateGold(int $id, int $gold)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET gold = :gold WHERE id = :id");
        return $stmt->execute(['id' => $id, 'gold' => $gold]);
    }

    /**
     * Обновляет серебро персонажа
     *
     * @param int $id
     * @param int $silver
     * @return bool
     */
    public function updateSilver(int $id, int $silver)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET silver = :silver WHERE id = :id");
        return $stmt->execute(['id' => $id, 'silver' => $silver]);
    }

    // ...
    // ...

    /**
     * Изменяет золото персонажа
     *
     * @param int $id
     * @param int $amount
     * @return bool
     */
    public function changeGold(int $id, int $amount)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET gold = gold + :amount WHERE id = :id");
        return $stmt->execute(['id' => $id, 'amount' => $amount]);
    }

    /**
     * Изменяет серебро персонажа
     *
     * @param int $id
     * @param int $amount
     * @return bool
     */
    public function changeSilver(int $id, int $amount)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET silver = silver + :amount WHERE id = :id");
        return $stmt->execute(['id' => $id, 'amount' => $amount]);
    }

    // ...
    // ...

    /**
     * Изменяет валюту персонажа
     *
     * @param int $id
     * @param int $goldAmount
     * @param int $silverAmount
     * @return bool
     */
    public function changeCurrency(int $id, int $goldAmount, int $silverAmount)
    {
        // Получаем текущее количество золота и серебра
        $stmt = $this->pdo->prepare("SELECT gold, silver FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentGold = $result['gold'];
        $currentSilver = $result['silver'];

        // Обновляем количество серебра
        $newSilver = $currentSilver + $silverAmount;
        $goldFromSilver = floor($newSilver / 100);
        $newSilver %= 100;

        // Обновляем количество золота
        $newGold = $currentGold + $goldAmount + $goldFromSilver;

        // Обновляем валюту в базе данных
        $stmt = $this->pdo->prepare("UPDATE users SET gold = :gold, silver = :silver WHERE id = :id");
        return $stmt->execute(['id' => $id, 'gold' => $newGold, 'silver' => $newSilver]);
    }

    // ...
    // ... (остальные методы)

    /**
     * Получает процент критического урона персонажа
     *
     * @param int $id
     * @return int|null
     */
    public function getCritChance(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT crit_chance FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['crit_chance'] : null;
    }

    /**
     * Обновляет процент критического урона персонажа
     *
     * @param int $id
     * @param int $critChance
     * @return bool
     */
    public function updateCritChance(int $id, int $critChance)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET crit_chance = :critChance WHERE id = :id");
        return $stmt->execute(['id' => $id, 'critChance' => $critChance]);
    }

    // ... (остальные методы)



}
