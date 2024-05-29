<?php
if(!isset($conn)){
	include 'library/dbh.php' ;
}
?>
<div class="col-lg-12">
	<div class="card card-secondary">
		<div class="card-header">
			 <h3 class="card-title">Add Payment</h3>
		</div>
		<div class="card-body">
			<form action="" id="manage_payment">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="form-group">
						<label for="" class="control-label">Loan ID</label>
						<input type="text" name="loan_id" class="form-control" required value="<?php echo isset($loan_id) ? $loan_id : '' ?>">
						</div>
                  <div class="form-group">
						<label for="" class="control-label">Payment Amount</label>
						<input type="text"  rows="10" name="amount" class="form-control" required value="<?php echo isset($amount) ? $amount : '' ?>">
							
		
						</div>
				</div>

				<div class="card-footer">
				<button class="btn btn-primary btn-flat btn-block">Add Payment</button>
			<button class="btn btn-secondary btn-flat btn-block" type="button" onclick="location.href = 'index.php?page=payment_list'">Cancel</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#manage_payment').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_payment',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Payment successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=payment_list')
					},1500)
				}
			}
		})
	})
</script>