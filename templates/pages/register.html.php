<!-- templates/pages/register.html.php -->


    <div class="body">
        <h2>Регистрация</h2>
        <div style="text-align:center;" class="p2">
            <img src="/images/rasporyaditel_310.jpg" width="310" height="103">
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" style="margin-top: 20px;">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST">
            <!-- Шаг 1: Имя персонажа -->
            <div id="step1" class="step">
                <h3>Шаг 1: Имя персонажа</h3>
                <p>Выберите уникальное имя для вашего персонажа. Это имя будет отображаться в игре и должно быть легко запоминающимся.</p>
                <label for="char_name" class="green">Имя персонажа:</label><br>
                <input type="text" id="char_name" name="char_name" required><br>
                <button type="button" onclick="nextStep(1)">Продолжить</button>
            </div>

            <!-- Шаг 2: Выбор стороны -->
            <div id="step2" class="step" style="display: none;">
                <h3>Шаг 2: Выбор стороны</h3>
                <p>Выберите сторону, за которую будете сражаться. Светлая сторона стремится к справедливости и порядку, а тёмная сторона — к власти и свободе.</p>
                <label for="side" class="green">Сторона:</label><br>
                <select id="side" name="side" required>
                    <option value="Light">Светлая сторона</option>
                    <option value="Dark">Тёмная сторона</option>
                </select><br>
                <button type="button" onclick="nextStep(2)">Продолжить</button>
            </div>

            <!-- Шаг 3: Выбор класса -->
            <div id="step3" class="step" style="display: none;">
                <h3>Шаг 3: Выбор класса</h3>
                <p>Выберите класс вашего персонажа. Каждый класс имеет свои уникальные способности и характеристики.</p>
                <label for="class" class="green">Класс:</label><br>
                <select id="class" name="class" required>
                    <option value="Monk">Монах</option>
                    <option value="Warrior">Воин</option>
                    <option value="Mage">Маг</option>
                </select><br>
                <button type="button" onclick="nextStep(3)">Продолжить</button>
            </div>

            <!-- Шаг 4: Выбор пола -->
            <div id="step4" class="step" style="display: none;">
                <h3>Шаг 4: Выбор пола</h3>
                <p>Выберите пол вашего персонажа. Это повлияет на внешний вид и некоторые игровые аспекты.</p>
                <label for="gender" class="green">Пол:</label><br>
                <select id="gender" name="gender" required>
                    <option value="Male">Мужской</option>
                    <option value="Female">Женский</option>
                </select><br>
                <button type="button" onclick="nextStep(4)">Продолжить</button>
            </div>

            <!-- Шаг 5: Ввод пароля -->
            <div id="step5" class="step" style="display: none;">
                <h3>Шаг 5: Ввод пароля</h3>
                <p>Создайте надёжный пароль для защиты вашего аккаунта. Убедитесь, что пароль легко запомнить, но сложно угадать.</p>
                <label for="password" class="green">Пароль:</label><br>
                <input type="password" id="password" name="password" required><br>
                <button type="button" onclick="nextStep(5)">Продолжить</button>
            </div>

            <!-- Шаг 6: Ввод электронной почты -->
            <div id="step6" class="step" style="display: none;">
                <h3>Шаг 6: Ввод электронной почты</h3>
                <p>Введите вашу электронную почту для восстановления доступа к аккаунту в случае необходимости.</p>
                <label for="email" class="green">Электронная почта:</label><br>
                <input type="email" id="email" name="email" required><br>
                <button type="submit">Завершить регистрацию</button>
            </div>
        </form>


</div>


<script>
    function nextStep(step) {
        document.getElementById('step' + step).style.display = 'none';
        document.getElementById('step' + (step + 1)).style.display = 'block';
    }
</script>

<div class="footer nav block-border-top">
    <ol>
        <li>
            <img class="i12img" src="/images/icons/home.png" alt="." width="12px" height="12px"> <a href="/">На главную</a>
        </li>
        <li>
            <img class="i12img" src="/images/icons/question_blue.png" alt="." width="12px" height="12px"> <a href="#">Первая помощь</a>
        </li>
    </ol>
</div>