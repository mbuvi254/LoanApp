<?php
if(!isset($conn)){
	include './library/dbh.php' ;
}
?>
<div class="col-lg-12">
	<div class="card card-secondary">
		<div class="card-header">
			 <h3 class="card-title">Add Loan Application</h3>
		</div>
		<div class="card-body">
			<form action="" id="manage_loan">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				
				<div class="form-group">
				<label class="control-label">Client</label>
	            <select name="loan_client" id="loan_client" class="form-control" required>
					<option value="<?php echo isset($loan_client) ? $loan_client : '' ?>">Client:<?php echo isset($loan_client) ? $loan_client  : '' ?></option>
					<?php $qry = $conn->query("SELECT  * ,concat(lastname,', ',firstname,' ',middlename) as name FROM clients");
                     while($row= $qry->fetch_assoc()):?>
                     	<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?> |Tax ID: <?php echo $row['tax_id'] ?></option>
                          <?php endwhile?>
                      </select>
						</div>
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
						<input type="text" name="loan_amount" id="loan_amount" class="form-control" required value="<?php echo isset($loan_amount) ? $loan_amount : '' ?>">
						</div>


                    <?php if(isset($loan_status)): ?>          	
			<div class="form-group ">
				<label class="control-label">&nbsp;</label>
				<select class="custom-select browser-default" name="loan_status" id="loan_staus">
					<option value="0" <?php echo $loan_status == 0 ? "selected" : '' ?>>For Approval</option>
					<option value="1" <?php echo $loan_status == 1 ? "selected" : '' ?>>Approved</option>
					<option value="4" <?php echo $loan_status == 4 ? "selected" : '' ?>>Denied</option>
				</select>
			</div>
				<?php endif ?>
		


						 <div class="form-group">
						<label for="" class="control-label">Loan Purpose</label>
						<textarea type="text" class="summernote " rows="" id="loan_purpose" name="loan_purpose"  required value="<?php echo isset($loan_purpose) ? $loan_purpose : '' ?>">
							<?php echo $loan_purpose  ?>
						</textarea>
						</div>
                 

				</div>

				<div class="card-footer">
				<button class="btn btn-primary btn-flat btn-block">Add Loan Application</button>
			<button class="btn btn-secondary btn-flat btn-block" type="button" onclick="location.href = 'index.php?page=loan_list'">Cancel</button>
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
						location.replace('index.php?page=loan_list')
					},1500)
				}
			}
		})
	})
</script>