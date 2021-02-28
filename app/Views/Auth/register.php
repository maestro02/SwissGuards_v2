<?= view('/Templates/Default_View') ?>
<?= $this->section('main') ?>

<div class="container" >
	<div class="row" >
		<div class="col-sm-6 offset-sm-3" >

			<div class="card" >
				<h2 class="card-header" ><?= lang('Auth.register') ?></h2 >
				<div class="card-body" >

					<?= view('Myth\Auth\Views\_message_block') ?>

					<form action="<?= route_to('register') ?>" method="post" >
						<?= csrf_field() ?>

						<div class="form-group" >
							<label for="email" ><?= lang('Auth.email') ?>
								<input type="email"
								       class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
								       name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>"
								       value="<?= old('email') ?>" />
							</label >
							<small id="emailHelp"
							       class="form-text text-muted" ><?= lang('Auth.weNeverShare') ?></small >
						</div >

						<div class="form-group" >
							<label for="username" ><?= lang('Auth.username') ?>
								<input type="text"
								       class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>"
								       name="username" placeholder="<?= lang('Auth.username') ?>"
								       value="<?= old('username') ?>" />
							</label >
						</div >

						<div class="form-group" >
							<label for="allyCode" ><?= lang('Auth.allyCode') ?>
								<input type="number"
								       class="form-control <?php if (session('errors.allyCode')) : ?>is-invalid<?php endif ?>"
								       name="allyCode" placeholder="123456789"
								       value="<?= old('allyCode') ?>" />
							</label >
						</div >

						<div class="form-group" >
							<label for="discordId" ><?= lang('Auth.discordId') ?>
								<input type="text"
								       class="form-control <?php if (session('errors.discordId')) : ?>is-invalid<?php endif ?>"
								       name="discordId" placeholder="name#1234"
								       value="<?= old('discordId') ?>" />
							</label >
						</div >

						<div class="form-group" >
							<label for="password" ><?= lang('Auth.password') ?>
								<input type="password" name="password"
								       class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
								       placeholder="<?= lang('Auth.password') ?>" autocomplete="off" />
							</label >
						</div >

						<div class="form-group" >
							<label for="pass_confirm" ><?= lang('Auth.repeatPassword') ?>
								<input type="password" name="pass_confirm"
								       class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
								       placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" />
							</label >
						</div >

						<br >

						<button type="submit" class="btn btn-primary btn-block" ><?= lang('Auth.register') ?></button >
					</form >


					<hr >

					<p ><?= lang('Auth.alreadyRegistered') ?> <a
								href="<?= route_to('login') ?>" ><?= lang('Auth.signIn') ?></a ></p >
				</div >
			</div >

		</div >
	</div >
</div >

<?= $this->endSection() ?>
