{{-- table start --}}
	
	<div class="child1">
		<table class="tableDesign">
			<tr>
				<td> Full Name </td>
				<td colspan="2">
					{{ $child1['full_name']}} 
				</td>
			</tr>

			<tr>
				<td colspan="2">Referrar ID: </td>
				<td> {{ ReferralTableValues::referrarId( $child1['referrar_id'] )}} </td>
			</tr>
			<tr>
				<td colspan="2"> Upline ID: </td>
				<td> {{ ReferralTableValues::uplineId( $child1['upline_id'] )}} </td>
			</tr>
			<tr>
				<td></td>
				<td>Left Position</td>
				<td>Right Position</td>
			</tr>

			<tr>
				<td> Members: </td>
				<td> {!! ReferralTableValues::leftMemOne($child1['id']) !!} </td>
				<td> {!! ReferralTableValues::rightMemOne($child1['id']) !!} </td>
			</tr>

			<tr>
				<td>Carry: </td>
				<td> {{ ReferralTableValues::getCarryLeft( $child1['id'] ) }} </td>
				<td> {{ ReferralTableValues::getCarryRight( $child1['id'] ) }}</td>
			</tr>
			<tr>
				<td colspan="3">Joining Date: &nbsp; {{ date('Y-m-d', strtotime( $child1['signup_date'] ))}} </td>
				<td></td>
			</tr>
		</table>
	</div>
{{-- table end --}}