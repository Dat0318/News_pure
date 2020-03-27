		<div class="modal fade" id="boxSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Time kiem</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo $_DOMAIN; ?>" method="GET">
							<div class="input-group">
								<input type="text" class="form-control" name="s" placeholder="Ban muon tim gi ...">
								<span class="input-group-btn">
											<a href="'.$_DOMAIN.'category/'.$data_menu_1['url'].'">'.$data_menu_1['label'].''.$sub_menu.'
									<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script src="<?php echo $_DOMAIN; ?>admin/js/jquery.min.js"></script>
		<script src="<?php echo $_DOMAIN; ?>admin/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>