# NAPVatChecker
Проверете идентификационен номер на фирма регистрирана в България, директно в системата на НАП

# Какво е NAPVatChecker
NAPVatChecker използва php код, за да провери идентификационен номер или казано още БУЛСТАТ на фирма регистрирана в България. Базирана е на тази форма: https://inetdec.nra.bg/pls/pub/home.html#/selectService:6,8,rep.Vatquery.home 

# Как да използвам NAPVatChecker
 1. Свалете файла и го сложете на сървъра си.
 2. Изпатете GET заявка до файла с номера, който желаете да проверите. Формат: NAPVatChecker.php?code=[кода]. Пример: NAPVatChecker.php?code=000413974
 3. Заредете страницата. Ще Ви излязат 3 полета, ако кода е валиден: Име на притежателя на кода, кода и адрес на регистрация. Ако кода е невалиден ще се появи следният текст: 'Няма намерена регистрирана фирма с този идентификационен номер'
 
# Повече информация
Може да модифицирате кода както желаете и да откоментирате коментарите, за да видите по-подробно какво се случва. Това, което прави кода е да изпрати 2 GET и 1 POST заявки. Заявките са както следва: 
 1. С първата GET заявка се взима Session token-a
 2. Регистрира token-a в системата на НАП. Без тази заявка, няма да работи кода
 3. Проверява кода в системата на нап и извежда данни за фирмата
 

Ако имате въпроси или коменти можете да се свържете с мен. bulgaria_mitko @ yahoo . com
