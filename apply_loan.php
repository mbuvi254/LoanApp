<?php
if(!isset($conn)){
	include 'lib/dbh.php' ;
}
?>
<div class="col-lg-12" style="padding-top:2rem;">
	<h1 class="text-center"><?php echo $title;?></h1>
	<div class="card card-success">
		<div class="card-header">
			 <h3 class="card-title">Apply Loan </h3>
		</div>
		<div class="card-body">
			<form action="" id="manage_loan">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<input type="hidden" name="loan_client" value="<?php echo $_SESSION['user_id'] ?>">
				<div class="form-group">
				<label class="control-label">Loan Type</label>
	            <select name="loan_type" id="loan_type" class="form-control" required>
					<option value="<?php echo isset($loan_type) ? $loan_type : '' ?>">Loan Type:<?php echo isset($loan_type) ? $loan_type : '' ?></option>
					<?php $qry = $conn->query("SELECT * FROM loan_types");
                     while($row= $qry->fetch_assoc()):?>
                     	<option value="<?php echo $row['id'] ?>"><?php echo $row['loanName'] ?></option>
                          <?php endwhile?>
                      </select>
						</div>
						<div class="form-group">
				<label class="control-label">Loan Plan</label>
				
				<select name="loan_plan" id="loan_plan" class="custom-select browser-default select2">
					<option value="<?php echo isset($loan_plan) ? $loan_plan : '' ?>">Loan Plan:<?php echo isset($loan_plan) ? $loan_plan : '' ?></option>
					<?php
				$plan = $conn->query("SELECT * FROM loan_plan order by `months` desc ");?>	
					<?php while($row = $plan->fetch_assoc()): ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($plan_id) && $plan_id == $row['id'] ? "selected" : '' ?> data-months="<?php echo $row['months'] ?>" data-interest_percentage="<?php echo $row['interest_percentage'] ?>" data-penalty_rate="<?php echo $row['penalty_rate'] ?>"><?php echo $row['months'] . ' month/s [ '.$row['interest_percentage'].'%, '.$row['penalty_rate'].'% ]' ?></option>
						<?php endwhile; ?>
				</select>
				<small>months [ interest%,penalty% ]</small>
						
						</div>

						<div class="form-group">
							<label for="" class="control-label">Loan Amount</label>
						<input type="number" name="loan_amount" id="loan_amount" class="form-control" required value="<?php echo isset($loan_amount) ? $loan_amount : '' ?>">
						</div>

						 <div class="form-group">
						<label for="" class="control-label">Loan Purpose</label>
						<textarea type="text" class="form-control" rows="3" id="loan_purpose" name="loan_purpose"  required value="<?php echo isset($loan_purpose) ? $loan_purpose : '' ?>">
							<?php echo $loan_purpose  ?>
						</textarea>
						</div>
          
				</div>

				<div class="card-footer">
				<button class="btn btn-primary btn-flat btn-block">Apply Loan</button>
			<button class="btn btn-secondary btn-flat btn-block" type="button" onclick="location.href = 'index.php?page=loans'">Cancel</button>
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
			url:'ajax.php?action=save_loan',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Loan successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=loan_applications')
					},1500)
				}
			}
		})
	})
</script>