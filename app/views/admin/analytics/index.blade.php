@extends('admin.layout')
	@section('body')
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i> Anlytics Management
						</div>
					</div>
					<div class="portlet-body">
						<?php if (isset($alert)) { ?>
							<div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
							    <button type="button" class="close" data-dismiss="alert">
							        <span aria-hidden="true">&times;</span>
							        <span class="sr-only">Close</span>
							    </button>
							    <p>
							        <?php echo $alert['msg'];?>
							    </p>
							</div>
						<?php } ?>
						<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
								<tr>	
									<th> USER NAME</th>
									<th> USER TYPE</th>
									<th> ACESS AMOUNT</th>
									<th class= "sorting_disabled">GO TO PAGE</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($analytics as $key => $value)
									<tr>
										<td>{{ $value->UserName }}</td>
										<td><?php if($value->UserType == "s") {echo "Single";}else{echo "Company";}?></td>
										<td>{{$value->usernumber}}</td>
										<td><a href="<?php  echo  HTTP_PATH.'/company/profile-view/'.$value->user_id?>" target="_blank">Go Page</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	@stop
@stop