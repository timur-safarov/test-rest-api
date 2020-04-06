
<?php if (!isset($user_fields->error)): ?>


<?php if ($user_fields) :?>

	<div class="col-lg-10 offset-lg-1">
	    <form class="intro-newslatter" action="main/add-new-user" method="post">

	    	<fieldset>

	    			<input 
		    			pattern="<?=$user_fields->countryCode->pattern;?>" 
		    				mes="<?=$user_fields->countryCode->mes;?>" class="last-s"
		    				flags="<?=$user_fields->countryCode->flags;?>"
		    					type="hidden" name="<?=$user_fields->countryCode->name;?>" 
		    						 value="<?=$user_fields->countryCode->example;?>">


		    	<?php if (isset($user_fields->country)) : ?>

		    		<input 
		    			pattern="<?=$user_fields->country->pattern;?>" 
		    				mes="<?=$user_fields->country->mes;?>" class="last-s"
		    				flags="<?=$user_fields->country->flags;?>"
		    					type="text" name="<?=$user_fields->country->name;?>" 
		    						placeholder="Страна" value="<?=$user_fields->country->example;?>">

		    	<?php endif; ?>

		    	<?php if (isset($user_fields->region)) : ?>

		    		<input 
		    			pattern="<?=$user_fields->region->pattern;?>" 
		    				mes="<?=$user_fields->region->mes;?>" class="last-s"
		    				flags="<?=$user_fields->region->flags;?>"
		    					type="text" name="<?=$user_fields->region->name;?>" 
		    						placeholder="Регион" value="<?=$user_fields->region->example;?>">

		    	<?php endif; ?>


		    	<?php if (isset($user_fields->city)) : ?>

		    		<input 
		    			pattern="<?=$user_fields->city->pattern;?>" 
		    				mes="<?=$user_fields->city->mes;?>" class="last-s"
		    				flags="<?=$user_fields->city->flags;?>"
		    					type="text" name="<?=$user_fields->city->name;?>" 
		    						placeholder="Город" value="<?=$user_fields->city->example;?>">

		    	<?php endif; ?>


		    	<?php if (isset($user_fields->zip)) : ?>

		    		<input 
		    			pattern="<?=$user_fields->zip->pattern;?>" 
		    				mes="<?=$user_fields->zip->mes;?>" class="last-s"
		    				flags="<?=$user_fields->zip->flags;?>"
		    					type="text" name="<?=$user_fields->zip->name;?>" 
		    						placeholder="Индекс" value="<?=$user_fields->zip->example;?>">

		    	<?php endif; ?>

		    	<?php if (isset($user_fields->company)) : ?>

		    		<input 
		    			pattern="<?=$user_fields->company->pattern;?>" 
		    				mes="<?=$user_fields->company->mes;?>" class="last-s"
		    				flags="<?=$user_fields->company->flags;?>"
		    					type="text" name="<?=$user_fields->company->name;?>" 
		    						placeholder="Название компании" value="<?=$user_fields->company->example;?>">

		    	<?php endif; ?>

		    	<?php if (isset($user_fields->address)) : ?>

		    		<input 
		    			pattern="<?=$user_fields->address->pattern;?>" 
		    				mes="<?=$user_fields->address->mes;?>" class="last-s"
		    				flags="<?=$user_fields->address->flags;?>"
		    					type="text" name="<?=$user_fields->address->name;?>" 
		    						placeholder="Адресс" value="<?=$user_fields->address->example;?>">

		    	<?php endif; ?>

		    	<?php if (isset($user_fields->district)) : ?>

		    		<input 
		    			pattern="<?=$user_fields->district->pattern;?>" 
		    				mes="<?=$user_fields->district->mes;?>" class="last-s"
		    				flags="<?=$user_fields->district->flags;?>"
		    					type="text" name="<?=$user_fields->district->name;?>" 
		    						placeholder="Район" value="<?=$user_fields->district->example;?>">

		    	<?php endif; ?>

		        	<input pattern="[0-9a-z_]+@[0-9a-z_]+\.[a-z]{2,5}" 
		        			mes="Формат E-mail не верный" 
		        			flags="i" type="email" name="email" 
		    					placeholder="E-mail" value="user@test.ru" class="last-s">

		    		<input pattern="^[a-zA-Z0-9-_]{4,120}$" 
			    			mes="Имя пользвателя указано не правильно" 
			        		flags="" type="text" name="username" 
			    				placeholder="Имя пользователя" value="pupkin" class="last-s">


		    		<input pattern="^[a-zA-Z0-9-_]{8,8}$" 
		    			mes="Пароль указан не правильно" 
		        		flags="" type="password" name="password" 
		    				placeholder="Пароль" value="34536566" class="last-s">

	        </fieldset>

	        <fieldset>

	        	<button type="button" class="site-btn">Зарегистрироваться</button>

	        </fieldset>

	    </form>
	</div>

<?php endif; ?>



<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="err-message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>


<?php else: ?>

	<h3 class="hero-text text-white">
		<?=$user_fields->error;?>
	</h3>

<?php endif; ?>