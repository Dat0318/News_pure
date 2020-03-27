<div class="container">
	<div class="row">
		<div class="col-md-6">
			<p>Vui long dang nhap de tiep tuc.</p>
			<form method="POST" id="formSignin" onsubmit="return false;">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon-user glyphicon"></span></span>
						<input type="text" class="form-control" placeholder="ten dang nhap" id="user_signin">
					</div><!-- div.input-group -->
				</div><!-- div.form-group -->
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon-lock glyphicon"></span></span>
						<input type="password" class="form-control" placeholder="Mat khau" id="pass_signin">
					</div><!-- div.input-group -->
				</div><!-- div.form-group -->
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Dang nhap</button>
				</div><!-- div.form-group -->
				<div class="alert alert-danger hidden"></div>
			</form><!-- form#formSignin -->
		</div><!-- div.col-md-6 -->
	</div><!-- div.row -->
</div><!-- div.container -->
