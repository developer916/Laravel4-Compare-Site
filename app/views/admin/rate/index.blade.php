@extends('admin.layout')
	@section('body')
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i> Rate Management
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
									<th> PRODUCT NAME</th>
									<th> SERVICE NAME</th>
									<th> RECEIVE USER</th>
									<th> SENDER USER</th>
									<th> RATING MESSAGE</th>
									<th> RATING</th>
									<th class= "sorting_disabled">ACTION</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($rate as $key => $value)
									 <tr>
				                        <td><input type="checkbox" class="checkboxes" value="{{$value->id}}" id="chkClientID"></td>
				                        <td>{{ $value->ProductName }}</td>
				                        <td>{{ $value->ServiceName }}</td>
				                        <td>{{ $value->ReceiveName }}</td>
				                        <td>{{ $value->SenderName }}</td>
				                        <td>{{ $value->review }}</td>
				                        <td>{{ $value->rate }}%</td>
				                         <td>
				                         	<form action="{{ URL::route('admin.rate.confirm' , $value->id) }}" id="formTest" onsubmit = "return onDelteConfirm(this)" style="display:inline-block">
				                            	<button type="submit" class='btn btn-xs blue' id="js-a-delete" >
				                                 @if($value->Confirm == "1")
				                                 	<i class='fa fa-edit'></i>Not Confirm
				                                 @else
				                                 	<i class='fa fa-edit'></i>Confirm
				                                 @endif
				                                 </button>
				                            </form>
				                            
				                         	<form action="{{ URL::route('admin.rate.delete' , $value->id) }}" id="formTest" onsubmit = "return onDelteConfirm(this)" style="display:inline-block">
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
