@extends('admin.layout')
	@section('body')
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-globe"></i>Contact Management
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
									<th> NAME</th>
									<th> EMAIL</th>
									<th> SUBJECT</th>
									<th> MESSAGE</th>
									<th>PHONE</th>
									<th>CREATED AT</th>
									<th class= "sorting_disabled">ACTION</th>
								</tr>
							</thead>
							<tbody>
								 @foreach ($client as $key => $value)
					                    <tr>
					                        <td><input type="checkbox" class="checkboxes" value="{{$value->id}}" id="chkClientID"></td>
					                        <td>{{ $value->name }}</td>
					                        <td>{{ $value->email }}</td>
					                        <td>{{ $value->subject }}</td>
					                        <td>{{ $value->message }}</td>
					                          <td>{{ $value->phone }}</td>
					                     	<td>{{ $value->created_at }}</td>
					                        <td>
					                            <a href="{{ URL::route('admin.contact.delete',$value->id) }}" class="btn btn-xs red" id="js-a-delete">
					                                <i class='fa fa-trash-o'></i> Delete
					                            </a>
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
		</script>
	@stop