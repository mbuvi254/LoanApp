<?php
if(!isset($conn)){
	include './library/dbh.php' ;
}
?>
<div class="col-lg-12">
	<div class="card card-secondary">
		<div class="card-header">
			 <h3 class="card-title">Add Loan Plan</h3>
		</div>
		<div class="card-body">
			<form action="" id="manage_plan">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="form-group">
						<label for="" class="control-label">Loan Months</label>
						<input type="text" name="months" class="form-control" required value="<?php echo isset($months) ? $months : '' ?>">
						</div>
						<div class="form-group">
						<label for="" class="control-label">Loan Percentage</label>
						<input type="text" name="interest_percentage" class="form-control" required value="<?php echo isset($interest_percentage) ? $interest_percentage : '' ?>">
						</div>
							<div class="form-group">
						<label for="" class="control-label">Loan Penalty</label>
						<input type="text" name="penalty_rate" class="form-control" required value="<?php echo isset($penalty_rate) ? $penalty_rate : '' ?>">
						</div>
              
              
				</div>

				<div class="card-footer">
				<button class="btn btn-primary btn-flat btn-block">Add Loan Plan</button>
			<button class="btn btn-secondary btn-flat btn-block" type="button" onclick="location.href = 'index.php?page=loan_plans'">Cancel</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#manage_plan').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_loan_plan',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Loan Plan successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=loan_plans')
					},1500)
				}
			}
		})
	})
</script>