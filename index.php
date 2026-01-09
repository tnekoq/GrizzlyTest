<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <title>GrizzlyTest</title>
</head>

<body>
    <?php
    session_start();
    $formData = [];
    $errorContainer = [];

    if (isset($_SESSION['formData'])) {
        $formData = $_SESSION['formData'];
        $errorContainer = $_SESSION['errors'];
        unset($_SESSION['formData']);
        unset($_SESSION['errors']);
    }
    require "includes/header.php"

    ?>
    <section class="hero">
        <div class="hero__companies">
            <h1 class="hero__title">Nasi kurierzy</h1>
            <div class="hero__cards">
                <div class="hero__card"></div>
                <div class="hero__card"></div>
                <div class="hero__card"></div>
                <div class="hero__card"></div>
                <div class="hero__card"></div>
                <div class="hero__card"></div>
                <div class="hero__card"></div>
                <div class="hero__card hero__card--posta"></div>
                <div class="hero__card"></div>
            </div>
        </div>
        <div class="hero__image"></div>
    </section>

    <section class="contact-form">
        <div class="contact-form__container">
            <h2 class="contact-form__title">Szukasz najlepszej oferty?</h2>
            <p class="contact-form__text">
                Zostaw aplikację, a nasz menedżer skontaktuje się z Tobą w celu konsultacji
            </p>
            <form method="post" action="/assets/php/dbRegistration.php" class="contact-form__form">
                <div class="contact-form__name">
                    <div class="contact-name__errors">
                        <input class="contact-form__input" type="text" name="name" placeholder="Twoje imię" required value="<?php echo isset($formData['name']) ? $formData['name'] : ''; ?>">
                        <label id="name_error" class="error"><?php echo isset($errorContainer['name']) ? $errorContainer['name'] : "" ?></label>
                    </div>

                    <div class="contact-name__errors">
                        <input class="contact-form__input" type="text" placeholder="Twoje nazwisko" name="surname" required value="<?php echo isset($formData['surname']) ? $formData['surname'] : ''; ?>">
                        <label id="surname_error" class="error"><?php echo isset($errorContainer['surname']) ? $errorContainer['surname'] : "" ?></label>
                    </div>

                    <div class="contact-name__errors">
                        <input class="contact-form__input" type="text" name="patronymic" placeholder="Twoje drugie imię" value="<?php echo isset($formData['patronymic']) ? $formData['patronymic'] : ''; ?>">
                        <label id="patronymic_error" class="error"><?php echo isset($errorContainer['patronymic']) ? $errorContainer['patronymic'] : "" ?></label>
                    </div>
                </div>
                <div class="contact-name__errors">
                    <input
                        placeholder="Twoja data urodzenia" class="contact-form__input" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date" value="<?php echo isset($formData['name']) ? $formData['date'] : ''; ?>">
                    <label id="date_error" class="error"><?php echo isset($errorContainer['date']) ? $errorContainer['date'] : "" ?></label>
                </div>

                <div class="contact-name__errors">
                    <input class="contact-form__input" type="email" name="email" placeholder="E-mail" value="<?php echo isset($formData['email']) ? $formData['email'] : ''; ?>">
                    <label id="email_error" class="error"><?php echo isset($errorContainer['email']) ? $errorContainer['email'] : "" ?></label>
                    <label id="phoneNotEmail_error" class="error"><?php echo isset($errorContainer['phoneNotEmail']) ? $errorContainer['phoneNotEmail'] : "" ?></label>
                </div>

                <div class="contact-form__phone">
                    <select name="phoneCode" id="phoneCode" class="contact-form__phoneSelect">
                        <option value="+375" class="contact-form__option">+375</option>
                        <option value="+7" class="contact-form__option">+7</option>
                    </select>
                    <div class="contact-name__errors">
                        <input class="contact-form__input" type="tel" name="phone" placeholder="Telefon" value="<?php echo isset($formData['phone']) ? $formData['phone'] : ''; ?>">
                        <label id="phone_error" class="error"><?php echo isset($errorContainer['phone']) ? $errorContainer['phone'] : "" ?></label>
                    </div>
                </div>

                <select name="maritalStatus" id="maritalStatus" class="contact-form__maritalStatus">
                    <option value="" selected hidden>Stan cywilny</option>
                    <option value="single" class="contact-form__option">Kawaler / Panna</option>
                    <option value="married" class="contact-form__option">Żonaty / Zamężna</option>
                    <option value="divorced" class="contact-form__option">Rozwiedziony / Rozwiedziona</option>
                    <option value="widowed" class="contact-form__option">Wdowiec / Wdowa</option>
                </select>

                <textarea name="about" id="about" placeholder="O mnie" maxlength="1000" class="contact-form__textarea" rows="3"></textarea>

                <div class="contact-form__submit">
                    <div class="contact-form__agreement">
                        <input type="checkbox" name="agreement" id="agreement" class="contact-form__checkbox" required>
                        <label for="agreement" class="contact-form__label">Przeczytałem(am) zasady</label>
                    </div>

                    <input type="submit" name="submit" id="submit" class="contact-form__button" value="Отправить" disabled>
                </div>


            </form>
        </div>
    </section>
    <?php require "includes/footer.php" ?>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const burger = document.querySelector('.header__burger');
        const nav = document.querySelector('.header__list');

        burger.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
    });

    $('input, textarea, select').on('blur change', function(e) {
        const controlName = e.target.name;
        const requestData = {
            [controlName]: $(e.target).val(),
            'phone': $('input[name="phone"]').val(),
            'phoneCode': $('#phoneCode').val(),
            'email': $('input[name="email"]').val(),
            'name': $('input[name="name"]').val(),
            'surname': $('input[name="surname"]').val()
        };

        $.ajax({
            type: "POST",
            url: "/assets/php/response.php",
            data: requestData,
            dataType: "json",
            success: function(data) {
                $('#phoneNotEmail_error').hide();
                $('input[name="phone"], input[name="email"]').removeClass('error_input');

                $('#' + controlName + '_error').hide();
                $('input[name="' + controlName + '"]').removeClass('error_input');

                if (data.result == 'error') {
                    $('#submit').prop('disabled', true);

                    for (var field in data.text_error) {
                        var errorText = data.text_error[field];
                        if (field === 'phoneNotEmail') {
                            $('#phoneNotEmail_error').html(errorText).show();
                            if (!$('input[name="phone"]').val() && !$('input[name="email"]').val()) {
                                $('input[name="phone"], input[name="email"]').addClass('error_input');
                            }
                        } else {
                            $('#' + field + '_error').html(errorText).show();
                            $('input[name="' + field + '"]').addClass('error_input');
                        }
                    }
                } else {
                    const nameVal = $('input[name="name"]').val();
                    const contactVal = $('input[name="phone"]').val() || $('input[name="email"]').val();
                    const hasErrors = $('.error_input:visible').length > 0;
                    if (nameVal.length >= 2 && contactVal && !hasErrors) {
                        $('#submit').prop('disabled', false);
                    }
                }
            }
        });
    });
</script>

</html>