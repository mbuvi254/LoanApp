<?php
if(!isset($conn)){
	include './library/dbh.php' ;
}
?>
<div class="col-lg-12">
	<div class="card card-secondary">
		<div class="card-header">
			 <h3 class="card-title">Add Loan Type</h3>
		</div>
		<div class="card-body">
			<form action="" id="manage_loan">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="form-group">
						<label for="" class="control-label">Loan Name</label>
						<input type="text" name="loanName" class="form-control" required value="<?php echo isset($loanName) ? $loanName : '' ?>">
						</div>
                  <div class="form-group">
						<label for="" class="control-label">Loan Description</label>
						<textarea type="text" id="summernote" rows="10" name="loanDesc" class="form-control" required value="<?php echo isset($loanDesc) ? $loanDesc : '' ?>">
							<?php echo $loanDesc  ?>
						</textarea>
						</div>
				</div>

				<div class="card-footer">
				<button class="btn btn-primary btn-flat btn-block">Add Loan Type</button>
			<button class="btn btn-secondary btn-flat btn-block" type="button" onclick="location.href = 'index.php?page=loanTypes'">Cancel</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#manage_loan').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_loan_type',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Loan Type successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=loan_types')
					},1500)
				}
			}
		})
	})
</script>