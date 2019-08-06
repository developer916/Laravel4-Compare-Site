@extends('admin.layout')
	@section('body')
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i> User Management
						</div>
						<div class="actions">
							<a id="sample_editable_1_new" class="btn btn-default btn-sm" href='{{ URL::route('admin.user.create')}}' style="margin-right:10px">
									Add New <i class="fa fa-plus"></i>
							</a>
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
									<th class="table-checkbox">
										<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
									</th>
									<th>NAME</th>
									<th>EMAIL</th>
									<th>PHONE</th>
									<th>REGISTER DATE</th>
									<th>USER TYPE</th>
									<th>PROFILE PAGE</th>
									<th>STATES</th>
									<th class= "sorting_disabled">ACTION</th>
								</tr>
							</thead>
							<tbody>
									@foreach ($user as $key => $value)
				                    <tr>
				                        <td><input type="checkbox" class="checkboxes" value="{{$value->id}}" id="chkClientID"></td>
				                         <td>{{ $value->UserName }}</td>
				                        <td>{{ $value->UserEmail }}</td>
				                        <td>{{ $value->UserPhoneNumber }}</td>
				                     	<td><?php echo substr($value->created_at, 0,10)?>  </td>
				                     	<td><?php if($value->UserType == "c") {echo "Company";} elseif($value->UserType == "s") {echo "Single";}?></td>
				                     	<td><a href="<?php  echo  HTTP_PATH.'/company/profile-view/'.$value->id?>" target="_blank">Go Page</a></td>
				                     	<td>
				                     		<form  class="form-horizontal" id="addCategoryFiledForm" method="POST" action="{{URL::route('admin.user.status')}}">
				                     			<input type="hidden" name="user_id" value="{{$value->id}}">
				                     			<input type="hidden" name="status" value ="<?php if($value->UserStatus == "InActive"){echo "0";}
				                     					else if($value->UserStatus=="Active"){echo "1";}?>"> 
				                     		<?php 
				                     			if($value->UserStatus == "InActive"){
													echo '<button type="submit"><i class="fa fa-times-circle fontSize16" style="color:red;font-size:16px;"></i></button>';
				                     			}else if($value->UserStatus=="Active"){
				                     				echo '<button type="submit"><i class="fa fa-check-circle fontSize16" style="color:#35aa47;font-size:16px;"></i></button>';
				                     			}
				                     		?>
				                     		</form>
				                     	</td>
				                        <td>
				                            <a href="{{ URL::route('admin.user.edit',$value->id)}}"  class='btn btn-xs blue'>
				                                <i class='fa fa-edit'></i>Edit
				                            </a>
				                           <form action="{{ URL::route('admin.user.delete' , $value->id) }}" id="formTest" onsubmit = "return onDelteConfirm(this)" style="display:inline-block">
				                            	<button type="submit" class="btn btn-xs red" id="js-a-delete" >
				                                <i class='fa fa-trash-o'></i> Delete</button>
				                            </form>
				                        </td>
				                    </tr>
				                @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	@stop
	@section('custom-scripts')
		<script type="text/javascript">
			jQuery(document).ready(function() {
				 initTable1(); 
			});   
			function onDelteConfirm( obj){
				bootbox.confirm("Are you sure?", function(result) {

					if ( result ) {

						obj.submit();

					}
				
				});
				
				return false;
			}
		</script>
	@stop
@stop