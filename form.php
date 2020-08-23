<html>
  <head>
  <title> Задание 6 </title>
  <link href="style.css" rel="stylesheet">
    <style>
.error {
  border: 2px solid red;
  border-radius: 3px;
}
    </style>
  </head>
  <body>
  <div class="mas">
<?php
if (!empty($messages)) {
  print('<div id="messages">'); 
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
?>
</div>

 <div class="formphp">
	<form action="" method="POST"> 
            <h2> Форма </h2>
            
            <p><a href="http://u17446.kubsu-dev.ru/job_directory_6/admin.php">Войти с правами администратора</a></p>
            
            <p><label>
              <p>Введите имя:</p>
              <input type="text" name="fio" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>">
            </label><br></p>
    
            <label> 
             <p> <a class="uptext">Введите ваш email:</a> </p>
              <input name="email"
              type="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"/> 
            </label><br>
            <p><label>
             <p> Введите вашу дату рождения:</p>
              <select name="year" <?php if ($errors['year']) {print 'class="error"';} ?> value="<?php print $values['year']; ?>">
    			<?php for($i = 1900; $i < 2020; $i++) { ?>
    			<option value="<?php print $i; ?>"><?= $i; ?></option>
    			<?php } ?>
  				</select>
            </label> </p>
             <p> Выберете пол: </p>
              <label>
                <input type="radio" value="муж" name="sex" <?php if ($errors['sex']) {print 'class="error"';} $checked = $values['sex']=="муж" ? '' :  'checked = " checked"'; ?> >Мужской
              </label>
              <label>
                <input type="radio" value="жен" name="sex" <?php if ($errors['sex']) {print 'class="error"';} $checked = $values['sex']=="жен" ? '' :  'checked = " checked"'; ?>>Женский
              </label> 
              <label>
                <input type="radio" value="иначе" name="sex"<?php if ($errors['sex']) {print 'class="error"';} $checked = !$values['sex']=="иначе" ? '' :  'checked = "checked"'; ?>>Иначе
              </label>
              <p>Количество конечностей:</p>
              <label>
                <input type="radio" value="0" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==0 ? '' :  'checked = " checked"'; ?> > 0
              </label>
              <label>
                <input type="radio" value="1" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==1 ? '' :  'checked = " checked"'; ?> > 1
              </label>
              <label>
                <input type="radio" value="2" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==2 ? '' :  'checked = " checked"'; ?> > 2
              </label>
              <label>
                <input type="radio" value="3" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==3 ? '' :  'checked = " checked"'; ?> > 3
              </label>
              <label>
                <input type="radio" value="4" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==4 ? '' :  'checked = " checked"'; ?> > 4
              </label>
              <br>
      		<p> <label>
            <p>Выберете способности:</p>
             <select multiple="multiple" name="abilities[]" <?php if ($errors['abilities']) {print 'class="error"';} ?>>
    			<option value="breakdown" >Расщепление материи</option>
    			<option value="regeneration">Регенерация</option>
    			<option value="reaction">Высокая скорость реакции</option>
    			<option value="resistance">Сопротивление токсинам</option>
   			 </select>
  				</label> </p>
      
           <p> <label>
             <p> Биография: </p>
              <textarea name="field-name-2" <?php if ($errors['field-name-2']) {print 'class="error"';} ?> value="<?php print $values['field-name-2']; ?>"></textarea>
            </label></p>
      
            <p><label>
              <input type="checkbox" name="acquainted" value="yes" <?php if ($errors['acquainted']) {print 'class="error"';} ?> value="<?php print $values['acquainted']; ?>">
              С контрактом ознакомлен
            </label> </p>
      
           <p class = "submit"> <input type="submit" value="Отправить"></p>
      
          </form>
  </body>
</html>